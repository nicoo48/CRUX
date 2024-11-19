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
$campos["pro_codigo_barra"] = $_REQUEST["codigo_barra"];
$campos["pro_precio"] = $_REQUEST["precio"];
$campos["pro_unidad"] = $_REQUEST["unidad"];
$campos["pro_per_id"] = $_SESSION["usuario"]["per_id"];
$campos["pro_estado"] = 1;

if (isset($_FILES['imagen'])) {
    $campos['pro_imagen'] = subir_archivo($_FILES['imagen']);
}
$productos = update("productos", $campos, $filtros);

if($productos["error"] == 0) {
    mensaje(
        "Producto Editado Correctamente.",
        "El producto fue Editado con exito.",
        "primary",
        "info-circle",
        1
    );

    boton(
        "Ir al listado de productos",
        "arrow-left",
        "primary",
        'cargar_pagina("productos.php","tienda")'
    );
} else {
    mensaje(
        "No se pudo Editar el producto",
        "Error al Editar el producto",
        "x",
        "danger"
    );
}
