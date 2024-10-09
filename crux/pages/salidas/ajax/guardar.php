<?php
//cargamos las funciones de la aplicación
$nivel_directorio = "../../../";
require "../../../carga.php";
// guardamos los movimientos
unset($campos);
$campos["mov_tipo"] = "sal";
$campos["mov_clase"] = $_REQUEST["clase"];
$campos["mov_fecha"] = date("Y-m-d H:i:s");
$campos["mov_responsable"] = $_SESSION["usuario"]["per_id"];
$campos["mov_glosa"] = $_REQUEST["glosa"];
$movimientos = insert("movimientos",$campos,1);
if($movimientos["error"] == 0 ){
    unset($campos);
    $campos["mdet_mov_id"] = $movimientos["datos"];
    $campos["mdet_producto"] = $_REQUEST["producto"];
    $campos["mdet_cantidad"] = $_REQUEST["cantidad"];
    $campos["mdet_total"] = $_REQUEST["cantidad"];
    $detalle = insert("movimientos_detalle",$campos,1);
    if($detalle["error"] == 0){
        mensaje(
            "Movimiento de Ingreso creado correctamente",
            "Se creo el movimiento de ingreso #".$movimientos["datos"],
            "check"
        );
        boton(
            "Listado de movimientos",
            "list",
            "outline-info",
            "ir_listado()"
        );
    } else {
        mensaje(
            "Hubo un error al crear el detalle del movimiento #".$movimientos["datos"],
            "No se pudo crear el detalle",
            "warning"
        );
    }
}
?>
<script>
    function ir_listado() {
        AJAXPOST(urlBase + "pages/movimientos/listado_movimientos.php", "", document.getElementById("pagina_central"));
    }
</script>
