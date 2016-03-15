<?php

    require("../includes/config.php"); 
    
    $rows = CS50::query("SELECT symbol, shares, id FROM Portfolios WHERE user_id=?", $_SESSION["id"]);
    $cash = CS50::query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $cash=$cash[0]["cash"];
    
    $positions = [];
    foreach ($rows as $row)
    {
        $stock = lookup($row["symbol"]);
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $row["shares"],
                "symbol" => $row["symbol"],
                "total" => sprintf("%.2f", $row["shares"]*$stock["price"])
            ];
        }
    }

    render("portfolio.php", ["title" => "Portfolio", "positions" => $positions, "cash" => $cash]);

?>
