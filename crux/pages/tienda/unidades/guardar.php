<?
//cargamos las funciones de la aplicación
$nivel_directorio = "../../../";
require "../../../carga.php";

// guardamos la tienda
unset($campos);
$campos["uni_codigo"] = $_REQUEST["codigo"];
$campos["uni_nombre"] = $_REQUEST["nombre"];
$resultado = insert("unidad_medida", $campos);

//validamos el resultado de la consulta
if (!$resultado["error"]) {
    mensaje(
        "Nueva Unidad de medida: '<em>$_REQUEST[nombre]</em>' creada con éxito!",
        "Tu nueva Unidad de medida fue creada correctamente",
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
    boton(
        "Crear Otra Unidad",
        "plus-circle",
        "outline-info",
        "crearUnidad()"
    );
} else {
    mensaje(
        "Error al crear la Unidad de medida",
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
<script>
    function crearTienda() {
        AJAXPOST(urlBase + "pages/tienda/unidades/crear.php", "", document.getElementById("pagina_central"));
    }

</script>