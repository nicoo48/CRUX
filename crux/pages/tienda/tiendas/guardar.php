<?
//cargamos las funciones de la aplicación
$nivel_directorio = "../../../";
require "../../../carga.php";

// guardamos la tienda
unset($campos);
$campos["tnd_nombre"] = $_REQUEST["nombre"];
$campos["tnd_direccion"] = $_REQUEST["direccion"];
$campos["tnd_codigo"] = $_REQUEST["codigo"];
$campos["tnd_per_id"] = $_SESSION['usuario']['per_id'];

$resultado = insert("tiendas", $campos,1);

//validamos el resultado de la consulta
if (!$resultado["error"]) {
    mensaje(
        "Nueva Tienda '<em>$_REQUEST[nombre]</em>' creada con éxito!",
        "Tu nueva tienda fue creada correctamente, ahora puedes agregar productos a tu tienda.",
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
    boton(
        "Crear Otra Tienda",
        "plus-circle",
        "outline-info",
        "crearTienda()"
    );
} else {
    mensaje(
        "Error al crear la tienda",
        "Ha ocurrido un error al crear la tienda: " . $resultado["mensaje"],
        "danger",
        "shop",
        1
    );
    boton(
        "Volver",
        "arrow-left-circle",
        "outline-primary",
        'cargar_pagina("tiendas.php","tienda")'
    );
}
?>
<script>
    function crearTienda() {
        AJAXPOST(urlBase + "pages/tienda/tiendas/crear.php", "", document.getElementById("pagina_central"));
    }

</script>