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
        
        $stock = lookup($_POST["symbol"]);
        $shares = CS50::query("SELECT shares FROM Portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);
        $earn = $stock["price"] * $shares[0]["shares"];
        $type = 'Sell';
        CS50::query("INSERT INTO history (id, type, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $type, $_POST["symbol"], $shares[0]["shares"], $stock["price"]);
        CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $earn, $_SESSION["id"]);
        CS50::query("DELETE FROM Portfolios WHERE user_id = ? AND symbol = ?", $_SESSION["id"], $_POST["symbol"]);        
        
        redirect("/");
    }

?>