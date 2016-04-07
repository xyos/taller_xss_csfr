<?
session_start();
if ($_SESSION['user'] === "hola") {
    echo("hecho");
    $file = '/tmp/transferencias.txt';
    $token = $_POST['name'] . ":" . $_POST['amount'] ."\n";
    file_put_contents($file, $token, FILE_APPEND | LOCK_EX);
} else {
    echo("no autorizado");
}
?>
