<?php

    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("portfolio.php", ["title" => "intro"]);
    }

    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
       if ($_POST["intro"] == NULL)
        {
            apologize("Please introduce an integer");
        }
        
        if (preg_match("/^\d+$/", $_POST["intro"]) == NULL)
        {
            apologize("You must enter an integer.");
        }
        
        else{
            CS50::query("UPDATE users SET cash = cash + ? WHERE id = ?", $_POST["intro"], $_SESSION["id"]);
        }
        redirect("/"); 
    }
        