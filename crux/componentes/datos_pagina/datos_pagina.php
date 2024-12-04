<?
$m = $_SESSION["tienda"]["tnd_meta_mensual"];

unset($filtros);
$filtros["where"] = "mov_fecha BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."'";
$movimientos_mes = select("movimientos");
foreach ($movimientos_mes["datos"] as $mov) {
    $mov_detalle = select("movimientos_detalle","*",["mdet_mov_id"=>$mov["mov_id"]]);     
    foreach($mov_detalle["datos"] as $mdet){
        if($mdet["mdet_clase"] == "VNT"){
            $stats["total_salidas"] += $mdet["mdet_total"];
            $cantidad_ventas += $mdet["mdet_cantidad"]; 
        }
        if($mdet["mdet_clase"] == "COM"){
            $stats["total_ingresos"] += $mdet["mdet_total"];
            $cantidad_compras += $mdet["mdet_cantidad"];
        }
        
    }    
}
unset($filtros);
$fecha_inicio = date('Y-m-d', strtotime('-12 months'));
$fecha_inicio = date('Y-m-01', strtotime($fecha_inicio)); // Primer día del mes
$fecha_inicio .= " 00:00:00"; // Hora inicial

$fecha_fin = date('Y-m-d'); // Fecha actual
$fecha_fin = date('Y-m-t', strtotime($fecha_fin)); // Último día del mes
$fecha_fin .= " 23:59:59"; // Hora final

$filtros["where"] = "mov_fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
$movimientos_12_meses = select("movimientos","*",$filtros);
foreach($movimientos_12_meses["datos"] as $m12){
    $movimientos_detalle = select("movimientos_detalle","*",["mdet_mov_id"=>$m12["mov_id"]]);
    $mes = date('Y-m',strtotime($m12["mov_fecha"]));
    foreach($movimientos_detalle["datos"] as $mdet){
        if($mdet["mdet_clase"] == "VNT"){
            $meses[$mes] += $mdet["mdet_total"];
            $total_ventas += $mdet["mdet_total"];
            $total_unidades += $mdet["mdet_cantidad"];
            $ventas_por_producto[$mdet["mdet_pro_id"]] += $mdet["mdet_cantidad"];   
        }
    }
    $promedio_ventas = $total_ventas / count($meses);
}
//con el fin de analizar que productos se pueden vender mejor este mes analizamos datos del año pasado
unset($filtros);
$fecha_inicio = date('Y-m-d', strtotime('-12 months'));
$fecha_inicio = date('Y-m-01', strtotime($fecha_inicio)); // Primer día del mes
$fecha_inicio .= " 00:00:00"; // Hora inicial

$fecha_fin = date('Y-m-d', strtotime('-12 months')); // Fecha actual
$fecha_fin = date('Y-m-t', strtotime($fecha_fin)); // Último día del mes
$fecha_fin .= " 23:59:59"; // Hora final

$filtros["where"] = "mov_fecha BETWEEN '$fecha_inicio' AND '$fecha_fin'";
$mov_mes_anio_pasado = select("movimientos", "*", $filtros);
foreach ($mov_mes_anio_pasado["datos"] as $mmap) {
    $movimientos_detalle = select("movimientos_detalle", "*", ["mdet_mov_id" => $mmap["mov_id"]]);
    foreach ($movimientos_detalle["datos"] as $mdet) {
        if ($mdet["mdet_clase"] == "VNT") {
            $ventas_anio_pasado[$mdet["mdet_pro_id"]] += $mdet["mdet_cantidad"];
        }
    }
}
