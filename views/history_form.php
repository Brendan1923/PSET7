<table class="table table-hover" style="background-color: #ffcccc">
<body style="background-color:#bfbfbf">
    <thead>
        <tr style="background-color: #ff9999">
            <th>Type</th>
            <th>Date and Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>


    <tbody>
    <?php
	    foreach ($table as $row)	
        {   
            echo("<tr>");
            echo("<td>" . $row["type"] . "</td>");
            echo("<td>" . date('d/m/y, g:i A',strtotime($row["time"])) . "</td>");
            echo("<td>" . $row["symbol"] . "</td>");
            echo("<td>" . $row["shares"] . "</td>");
            echo("<td>$" . number_format($row["price"], 2) . "</td>");
            echo("</tr>");
        }
    ?>
    </tbody>
</table>