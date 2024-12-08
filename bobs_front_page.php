<?php
$pictures = array('disco_freno.jpg', 'motor.jpg', 'spark-plug.webp', 'volante.jpg');
shuffle($pictures);
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Bob's Auto Parts --Order Results--</title>
    </head>
    <body>

    <h1>Bob's Auto Parts</h1>

    <div align="center">
        <table style="width: 100%; border: 0">

            <tr>

                <?php
                for ($i = 0; $i < 3; $i++) {
                    echo"<td style=\"width: 33%; text-aling: center\">
                       <img src='img/{$pictures[$i]}' alt='Imagen {$i}' style='max-width: 100%; height: auto;'/>
                      </td>";
                }

                ?>
            </tr>
        </table>


    </div>


    </body>
    </html>
<?php
