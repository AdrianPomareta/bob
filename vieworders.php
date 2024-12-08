<?php
$document_root = $_SERVER['DOCUMENT_ROOT'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bob's Auto Parts --Order Results--</title>

</head>
<body>

<h1>Bob's Auto Parts</h1>
<h2>Customers Orders</h2>


<?php
@$fp = fopen("$document_root/orders.txt", "rb");
flock($fp, LOCK_SH);
//LOCK_SH bloqueo de lectura el fichero se puede compartir con otros lectores
//LOCK_EX bloqueo de escritura, el fichero no se comparte con otros lectores
//LOCK_UN liberar bloqueo exixtente
//LOCK_NB impide el bloqueo al intentar obtener uno
if (!$fp) {
    echo "<p><strong>No orders pending.</br>
                Please try again later.</strong></p>";
    exit;
}
//feof() -->
//se utiliza para comprobar si se ha llegado al final de un archivo durante una operación de lectura.
//Devuelve true si el puntero del archivo está al final, y false en caso contrario.
while (!feof($fp)) {
    //La función fgets() en PHP se utiliza para leer una línea de un archivo abierto.
    // Es especialmente útil cuando necesitas procesar archivos línea por línea.
    $order = fgets($fp);
    echo htmlspecialchars($order) . "</br>";
}

flock($fp, LOCK_UN);//libera bloqueo de lecctura
fclose($fp);
?>


</body>
</html>

