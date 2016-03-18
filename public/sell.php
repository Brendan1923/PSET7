<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        $symbols =CS50::query("SELECT symbol FROM Portfolios WHERE user_id=?", $_SESSION["id"]);
        render("sell_form.php", ["title" => "Sell", "symbols"=>$symbols]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["symbol"]=='Symbol')
        {
            apologize("Please enter the stock symbol.");
        }
        else if ($_POST["shares"]==NULL)
        {
            apologize("Please enter a number of shares to sell.");
        }
        else if (preg_match("/^\d+$/", $_POST["shares"]) == NULL)
        {
            apologize("You must enter a positive integer.");
        }
        else if ($_POST["shares"] == 0)
        {
            apologize("You must enter a valid number of shares.");
        }
        $shares =CS50::query("SELECT shares FROM Portfolios WHERE symbol= ? AND user_id= ? ", $_POST["symbol"], $_SESSION["id"]);
        $shares = $shares[0]["shares"];
        if ($_POST["shares"] > $shares)
        {
            apologize("Not enough shares to sell");
        }
        
        $stock = lookup($_POST["symbol"]);
        $earn = $stock["price"] * $_POST["shares"];
        $type = 'Sell';
        if($_POST["shares"] < $shares)
        {
            CS50::query("INSERT INTO Portfolios (user_id, symbol, shares) VALUES(?, ?, ?) 
            ON DUPLICATE KEY UPDATE shares = shares - VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"]); 
        }
        else if ($_POST["shares"]== $shares)
        {
            CS50::query("DELETE FROM Portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        }
        CS50::query("INSERT INTO history (id, type, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $type, $_POST["symbol"], $_POST["shares"], $stock["price"]);
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $earn, $_SESSION["id"]);
        
        redirect("/");
    }

?>