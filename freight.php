<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bob's Auto Parts --Freight Costs--</title>
</head>
<body>

<h1>Bob's Auto Parts</h1>
<h2>Freight Costs</h2>

<table style="border: 0px; padding: 3px;">
    <tr>
        <td style="background: #cccccc; text-align: center;">Distance</td>
        <td style="background: #cccccc; text-align: center;">Cost</td>
    </tr>
    <?php
    $distance = 50;
    while ($distance <= 250) {
        echo "<tr>";
        echo "<td style=\"text-align: right;\">".$distance."</td>";
        echo "<td style=\"text-align: right;\">".($distance / 10)."</td>";
        echo "</tr>\n";
        $distance += 50;
    }
    ?>
</table>

</body>
</html>
