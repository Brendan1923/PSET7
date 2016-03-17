<body style="background-color:#bfbfbf">
<div>
<h1>
    <?php
    $name= CS50::query("SELECT name FROM users WHERE id = ?", $_SESSION["id"]);
    $name=$name[0]["name"];
    print("Hi, ". ($name));
    ?>
</h1>
<h2>
    <?php
    print("Your cash is: $". number_format($cash, 2));
    ?>
</h2>

<h4>
    <?php
    print("Add money to your account");
    ?>
</h4>
</div>
<div>
<table class="table table-hover" style="background-color: #ffcccc">
    <thead>
        
        <tr style="background-color: #ff9999">
            <th>Symbol</th>
            <th>Name</th>
            <th>Shares</th>
            <th>Price</th>
            <th>TOTAL</th>
        </tr>
    </thead>

    <tbody>
        <?php
        foreach ($positions as $position)
        {
            print("<tr>");
            print("<tr>");
			print("<td>" . $position["symbol"] . "</td>");
			print("<td>" . $position["name"] . "</td>");
			print("<td>" . $position["shares"] . "</td>");
			print("<td>$" . $position["price"] . "</td>");
			print("<td>$" . $position["total"] . "</td>");
			print("</tr>");
        }
        ?>
</div>

        <form action="intro.php" method="post">
            <fieldset>
            <div class="form-group">
                <input class="btn-danger" name="intro" placeholder="Introduce the cash to add" type="text"/>
            </div>
            </fieldset>
        </form>
        
    </tbody>
</table>
</body>