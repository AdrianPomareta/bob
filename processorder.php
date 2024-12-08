global$file_path; global$file_path; <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bob's Auto Parts --Order Results--</title>
</head>
<body>

<h1>Bob's Auto Parts</h1>
<h2>Order Results</h2>

<?php
//variables process form
//crea variable y escribe o si no hay valor asignado mediante
//operador ternario.
$tireqty = isset($_POST["tireqty"]) ? $_POST["tireqty"] : 0;
$oilqty = isset($_POST["oilqty"]) ? $_POST["oilqty"] : 0;
$sparkqty = isset($_POST["sparkqty"]) ? $_POST["sparkqty"] : 0;
$find = isset($_POST["find"]) ? $_POST["find"] : 0;
$discount = isset($_POST["discount"]) ? $_POST["discount"] : 0;
$address = isset($_POST["address"]) ? $_POST["address"] : 0;
// Obtener el directorio raíz del servidor web
// $_SERVER['DOCUMENT_ROOT'] proporciona la ruta absoluta al directorio raíz del servidor.
$document_root = $_SERVER['DOCUMENT_ROOT'];
$date=date('H:i, jS F Y');

//mensaje Order processed.
echo '<p>Order processed at: ';
echo  date('H:i, jS F Y');
echo '</p>';

//mostrar pedido de order form
// el caracter . se utiliza para concatenar cadenas
echo '<p>Your order is a follows: </p>';
echo htmlspecialchars($tireqty).' tires</br>';
echo htmlspecialchars($oilqty).' oil</br>';
echo htmlspecialchars($sparkqty).' spark</br>';

//calculo precio total formulario.
$totalqty = $tireqty + $oilqty + $sparkqty;
echo"<p>Items ordered: ".$totalqty."</br>";
$totalamount = 0.00;

define('TIREPRICE', 100);
define('OILPRICE', 10);
define('SPARKPRICE', 4);
$totalamount = $tireqty * TIREPRICE
             + $oilqty * OILPRICE
             + $sparkqty * SPARKPRICE;

echo "Subtotal: $".number_format($totalamount, 2)."</br>";
$taxrate = 0.10; //impuesto de ventas 10%
$totalamount = $totalamount * (1 + $taxrate);
echo "Total including tax: $".number_format($totalamount, 2)."</p>";
echo "<p>Address to ship to is:  ".htmlspecialchars($address). "</p>";

//isset() --> verifica si una variable está definida y no es nula
//Retorna true si todas las variables están definidas y su valor no es null.

//empty() --> se utiliza para comprobar si una variable está vacía.
// Retorna true si la variable está vacía
// y false si tiene algún valor considerado "no vacío".


//echo 'isset($tireqty): '.isset($tireqty).'</br>';
//echo 'isset($nothere): '.isset($nothere).'</br>';
//echo 'isset($tireqty): '.empty($tireqty).'</br>';

if ($totalqty == 0){
    echo "<p style='color: red'>";
    echo "You did not order anything on the previus page!";
    echo "</p>";
}else{
    if($tireqty>0)
        echo htmlspecialchars($tireqty).' tires</br>';
    if($oilqty>0)
        echo htmlspecialchars($oilqty).' oil</br>';
    if($sparkqty>0)
        echo htmlspecialchars($sparkqty).' spark plugs</br>';

}

//aplicar descuento si:

if($tireqty<10){
    $discount = 0;
}elseif ($tireqty>=10 && $tireqty<=49){
    $discount = 5;
}elseif ($tireqty>=60 && $tireqty<=99){
    $discount = 10;
}elseif ($tireqty>=100){
    $discount = 15;
}

//seleccion desplegable order form

switch ($find){
    case "a":
        echo "<p style='color: blue'>";
        echo "Regular costumer.</p>";
        break;
    case "b":
        echo "<p style='color: blue'>";
        echo "Costumer referred by TV advert.</p>";
        break;
    case "c":
        echo "<p style='color: blue'>";
        echo "Costumner referred by phone directory.</p>";
        break;
    case "d":
        echo "<p style='color: blue'>";
        echo "Costumner referred by word of mouth.</p>";
        break;
    default:
        echo "<p style='color: white; background-color: coral'>";
        echo "Unknown costumer.</p>";
        break;
        }

/**
 * ------------------------------Guardar informacion en fichero--------------------------------------------------------
 */


//1-.abrir fichero.

$fp = fopen("$document_root/orders.txt", "ab");
if (!$fp){
    echo "<p style='color: red'>";
    echo "<strong>Your order could not processed at this time. Please try again later</strong></p>";
}


//2-.escribr fichero.

// Especificar la ruta completa del archivo donde se almacenarán los pedidos
$file_path = "$document_root/orders.txt";

//echo "<p>Document root: $document_root</p>";
//echo "<p>File path: $file_path</p>";

// Intentar abrir el archivo en modo "ab" (apertura para escritura al final del archivo)
// Si el archivo no existe, se intentará crear. Si no se puede abrir, muestra un mensaje de error.
$fp = fopen($file_path, "ab");

if (!$fp) {
    // Si no se puede abrir el archivo, muestra un mensaje de error al usuario.
    echo "<p style='color: red'><strong>Your order could not be processed at this time. Please try again later.</strong></p>";
} else {
    // Construir la cadena de texto que se escribirá en el archivo
    // La cadena incluye datos como fecha, cantidades de artículos, total y dirección, separados por tabuladores (\t).
    $outputstring = $date . "\t" . $tireqty . " tires\t" . $oilqty . " oil\t" . $sparkqty . " spark plugs\t" . $totalamount . "\t" . $address . "\n";

    // Bloquear el archivo para evitar conflictos con otros procesos que puedan intentar escribir al mismo tiempo
    // LOCK_EX establece un bloqueo exclusivo durante la escritura.
    flock($fp, LOCK_EX);

    // Intentar escribir la cadena en el archivo
    if (fwrite($fp, $outputstring) === false) {
        // Si ocurre un error al escribir, muestra un mensaje de error al usuario.
        echo "<p style='color: red'><strong>Error writing to file.</strong></p>";
    }

    // Liberar el bloqueo del archivo para que otros procesos puedan acceder a él
    flock($fp, LOCK_UN);

    // Cerrar el archivo después de escribir
    fclose($fp);

    // Confirmar al usuario que el pedido se escribió correctamente en el archivo
    echo "<p>Order written to file successfully.</p>";
}

        ?>
</body>
</html>