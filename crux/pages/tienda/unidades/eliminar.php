<?
$nivel_directorio = "../../../";
require "../../../carga.php";

unset($filtros);
$filtros["uni_id"] = $_REQUEST["id"];
$unidad  = deletear("unidad_medida", $filtros);


if(!$unidad["error"]){
    mensaje(
        "Unidad Eliminada con éxito!",
        "Tu Unidad fue eliminada correctamente.",
        "success",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "outline-success",
        'cargar_pagina("unidades.php","tienda")'
    );
}else{
    mensaje(
        "Error al Eliminar la tienda",
        "Ha ocurrido un error al eliminar la Unidad: ".$unidad["resultado"],
        "danger",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "error",
        'cargar_pagina("unidades.php","tienda")'
    );
}