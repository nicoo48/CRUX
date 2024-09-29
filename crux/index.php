<?
//cargo la configuracion y las funciones
$nivel_directorio = "";
require "carga.php";

/* Validamos que el usuario este loggeado */
if (!isset($_SESSION['usuario'])) {
    echo '<script>location.href="login.php";</script>';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CRUX</title>

</html>

<body style="user-select:none">
    <? require 'top.php'; ?>
    <div id="pagina_central" style="padding:5px;"></div>
</body>

</html>