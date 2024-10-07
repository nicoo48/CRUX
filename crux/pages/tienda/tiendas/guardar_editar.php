<?
//cargamos las funciones de la aplicación
$nivel_directorio = "../../../";
require "../../../carga.php";

// guardamos la tienda
unset($campos);
$campos["tnd_nombre"] = $_REQUEST["nombre"];
$campos["tnd_direccion"] = $_REQUEST["direccion"];
$filtros["tnd_id"] = $_REQUEST["id"];
$resultado = update("tiendas", $campos, $filtros);

//validamos el resultado de la consulta
if(!$resultado["error"]){
    mensaje(
        "Nueva Tienda <em>'$_REQUEST[nombre]'</em> Editada con éxito!",
        "Tu nueva tienda fue Editada correctamente.",
        "success",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "outline-success",
        'cargar_pagina("tiendas.php","tienda")'
    );
}else{
    mensaje(
        "Error al Editar la tienda",
        "Ha ocurrido un error al crear la tienda: ".$resultado["mensaje"],
        "danger",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "error",
        'cargar_pagina("tiendas.php","tienda")'
    );
}
?>