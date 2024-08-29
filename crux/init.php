<?

//hacemos una pequeña rutina para traer todas las funciones de la carpeta funciones
$funciones = opendir("funciones/");
while ($archivo = readdir($funciones)) {
    if (!is_dir($archivo)) {
        require "funciones/" . $archivo;
    }
}

$funciones_js = opendir("funciones_js/");
while ($archivo = readdir($funciones_js)) {
    if (!is_dir($archivo)) {
        echo "<script src= 'funciones_js/$archivo'></script>";
    }
}

?>

<!-- Incluimos los estilos de CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

<!-- Incluimos las funciones de JS -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" 
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" 
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
</script>