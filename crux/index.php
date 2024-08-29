<?
//cargo la configuracion y las funciones
require "carga.php";

/* Validamos que el usuario este loggeado */
if (!isset($_SESSION['usuario'])) {
    echo '<script>location.href="login.php";</script>';
    exit;
}
_p($_SESSION);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>CRUX</title>
</html>
<body>
    <a href="logout.php">aa</a>
</body>
</html>