<?
$nivel_directorio = "../../../";
require "../../../carga.php";

unset($campos);
$campos["mov_tipo"] = "SAL";
$campos["mov_tnd_id"] = $_SESSION["tienda"]["tnd_id"]??1;
$campos["mov_fecha"] = date("Y-m-d H:i:s");
$campos["mov_per_id"] = $_SESSION["usuario"]["per_id"];
$movimiento = insert("movimientos", $campos);
$datos = explode(";", $_REQUEST['datos']);
foreach ($datos as $dato) {
    if ($dato <> "") {
        // Separar los datos
        $aux = explode(",", $dato);
        unset($campos);
        $campos["mdet_mov_id"] = $movimiento["datos"];
        $campos["mdet_tnd_id"] = $_SESSION["tienda"]["tnd_id"]??1;
        $campos["mdet_pro_id"] = $aux[0];
        $campos["mdet_cantidad"] = $aux[2];
        $campos["mdet_valor_unitario"] = $aux[3];
        $campos["mdet_total"] = $aux[2] * $aux[3];
        $campos["mdet_clase"] = $aux[1];
        $campos["mdet_glosa"] = $aux[4];
        $mdet = insert("movimientos_detalle", $campos);
    }
}
mensaje(
    "Se creo con exito la transacción!", 
    "La transacción fue procesada correctamente",
    "success",
    "cart-dash"
);
boton("Ir al Resumen","arrow-left-circle","primary",'cargar_pagina("listado_movimientos.php","movimientos")');
boton("Nueva Venta","cart-dash","success",'cargar_pagina("crear_salida.php","movimientos")');