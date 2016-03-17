<?php
    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_buy_form.php", ["title" => "QuoteBuyForm"]);
    }

    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if ($_POST["shares"]== NULL) 
        {
            apologize("Empty symbol field, retry");
        }
        
       
        if (preg_match("/^\d+$/", $_POST["shares"]) == NULL)
        {
            apologize("You must enter a positive integer.");
        }
        
        $cost = $stock["price"] * $_POST["shares"];
        $cash =	CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
        $cash= $cash[0]["cash"];
        $type='Buy';
        if ($cash < $cost)
        {
            apologize("You can't afford this purchase.");
        }         
        
        else
        {
            CS50::query("INSERT INTO Portfolios (user_id, symbol, shares) VALUES(?, ?, ?) 
                ON DUPLICATE KEY UPDATE shares = shares + VALUES(shares)", $_SESSION["id"], $_POST["symbol"], $_POST["shares"]);
            CS50::query("UPDATE users SET cash = cash - ? WHERE id = ?", $cost, $_SESSION["id"]);
            CS50::query("INSERT INTO history (id, type, symbol, shares, price) VALUES (?, ?, ?, ?, ?)", $_SESSION["id"], $type, $_POST["symbol"], $_POST["shares"], $stock["price"]);

            redirect("/");    
        }
    }