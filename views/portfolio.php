<h1>
    <?php
    print("Cash: $". number_format($cash, 2));
    ?>
</h1>
<h4>
    <?php
    print("Add money to your account");
    ?>
</h4>
<table class="table table-striped">
    <thead>
        
        <tr>
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
        <form action="intro.php" method="post">
            <fieldset>
            <div class="form-group">
                <input class="form-control" name="intro" placeholder="Cash to be introduced" type="text"/>
            </div>
            </fieldset>
        </form>
        
    </tbody>
</table>
