<?
//cargamos las funciones de la aplicación
$nivel_directorio = "../../../";
require "../../../carga.php";
//primero sacamos el arreglo de la sesion
unset($_SESSION["tienda"]);
//seleccionamos la tienda 
$tienda = select("tiendas", "*", ["tnd_id" => $_REQUEST["id"]]);

//la metemos en la session
$_SESSION["tienda"] = $tienda["datos"][0];

//mandamos alerte de exito
?>
<script>
    alerta("Tienda: <?=$tienda["datos"][0]["tnd_nombre"]?> Seleccionado con exito", "success");
    cargar_pagina("tiendas.php", "tienda");
</script>
<?
