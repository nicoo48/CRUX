<?php
//cargamos las funciones de la aplicación
$nivel_directorio = "../../../../";
require "../../../../carga.php";
// guardamos los productos
unset($campos);
$filtros["pro_id"] = $_REQUEST["id_producto"];
$campos["pro_codigo"] = $_REQUEST["codigo_producto"];
$campos["pro_nombre"] = $_REQUEST["nombre_producto"];
$campos["pro_descripcion"] = $_REQUEST["descripcion"];
$campos["pro_precio"] = $_REQUEST["precio"];
$campos["pro_codigo_barra"] = $_REQUEST["codigo_barra"];
$campos["pro_unidad"] = $_REQUEST["unidad"];
$campos["pro_per_id"] = $_SESSION["usuario"]["per_id"];
$campos["pro_estado"] = 1;
$productos = update("productos",$campos,$filtros);
if($productos["error"] == 0 ){
        mensaje(
            "Producto editado correctamente",
            "Se edito el producto con el codigo #".$_REQUEST["codigo_producto"],
            "check"
        );
        boton(
            "Ir al listado de productos",
            "arrow-left",
            "primary",
            "ir_listado()"
        );
}else{
    mensaje(
        "No se pudo crear el producto",
        "Error al crear el producto",
        "x"
    );
}
?>
<script>
    function ir_listado() {
        AJAXPOST(urlBase + "pages/tienda/productos.php", "", document.getElementById("pagina_central"));
    }
</script>