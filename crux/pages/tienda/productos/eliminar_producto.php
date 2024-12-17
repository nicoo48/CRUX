<?
$nivel_directorio = "../../../";
require "../../../carga.php";

unset($filtros);
$filtros["pro_id"] = $_REQUEST["id"];
$producto  = deletear("productos", $filtros);


if(!$producto["error"]){
    mensaje(
        "Producto Eliminado con éxito!",
        "Tu Producto fue eliminado correctamente.",
        "success",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "outline-success",
        'cargar_pagina("productos.php","tienda")'
    );
}else{
    mensaje(
        "Error al Eliminar el producto",
        "Ha ocurrido un error al eliminar el producto: ".$producto["resultado"],
        "danger",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "error",
        'cargar_pagina("productos.php","tienda")'
    );
}