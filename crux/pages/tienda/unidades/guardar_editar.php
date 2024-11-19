<?
//cargamos las funciones de la aplicación
$nivel_directorio = "../../../";
require "../../../carga.php";

// guardamos la tienda
unset($campos);
$filtros["uni_id"] = $_REQUEST["id"];
$campos["uni_codigo"] = $_REQUEST["codigo"];
$campos["uni_nombre"] = $_REQUEST["nombre"];
$resultado = update("unidad_medida", $campos);

//validamos el resultado de la consulta
if (!$resultado["error"]) {
    mensaje(
        "Unidad de medida: '<em>$_REQUEST[nombre]</em>' Editada con éxito!",
        "Tu Unidad de medida fue editada correctamente",
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
} else {
    mensaje(
        "Error al editar la Unidad de medida",
        "Ha ocurrido un error al crear la Unidad: " . $resultado["mensaje"],
        "danger",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "outline-primary",
        'cargar_pagina("unidades.php","tienda")'
    );
}
?>