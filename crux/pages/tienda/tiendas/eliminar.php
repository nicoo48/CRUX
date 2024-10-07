<?
$nivel_directorio = "../../../";
require "../../../carga.php";

unset($filtros);
$filtros["tnd_id"] = $_REQUEST["id"];
$tienda  = deletear("tiendas", $filtros);


if(!$tienda["error"]){
    mensaje(
        "Tienda Eliminada con éxito!",
        "Tu tienda fue eliminada correctamente.",
        "success",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "success",
        "cargar_pagina('tiendas.php','tienda')"
    );
}else{
    mensaje(
        "Error al Eliminar la tienda",
        "Ha ocurrido un error al eliminar la tienda: ".$tienda["resultado"],
        "danger",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "error",
        "cargar_pagina('tiendas.php','tienda')"
    );
}
//seleccionamos la tienda que vamos a eliminar