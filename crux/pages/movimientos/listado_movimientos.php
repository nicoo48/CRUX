<?php
$nivel_directorio = "../../";
require "../../carga.php";

//declaramos las variables
$lista_compras = [];
$lista_ventas = [];
$lista_productos = [];

//obtenemos los movimientos
unset($filtros);
$filtros["mov_tnd_id"] = $_SESSION["tienda"]["tnd_id"] ?? 1;
$filtros["mov_per_id"] = $_SESSION["usuario"]["per_id"];
$mov = select("movimientos", "*", $filtros, "mov_id DESC");
foreach ($mov["datos"] as $movi) {
    if ($movi["mov_tipo"] == "ING") {
        $lista_compras[$movi["mov_id"]] = $movi;
    } else {
        $lista_ventas[$movi["mov_id"]] = $movi;
    }
}
//obtenemos los detalles y los agrupamos por movimiento
unset($filtros);
$filtros["mdet_tnd_id"] = $_SESSION["tienda"]["tnd_id"] ?? 1;
$detalles = select("movimientos_detalle", "*", $filtros,"mdet_mov_id DESC");
foreach ($detalles["datos"] as $det) {
    if (isset($lista_compras[$det["mdet_mov_id"]])) {
        $lista_compras[$det["mdet_mov_id"]]["detalles"][] = $det;
    } else {
        $lista_ventas[$det["mdet_mov_id"]]["detalles"][] = $det;
    };
}

//obtenemos los productos
unset($filtros);
$filtros["pro_tnd_id"] = $_SESSION["tienda"]["tnd_id"] ?? 1;
$filtros["pro_per_id"] = $_SESSION["usuario"]["per_id"];
$pro = select("productos", "*", $filtros);
foreach ($pro["datos"] as $produc) {
    $lista_productos[$produc["pro_id"]] = $produc;
}

?>
<div class="nav-align-top mb-6">
    <ul class="nav nav-pills mb-4" role="tablist">
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link waves-effect waves-light active" role="tab" data-bs-toggle="tab" data-bs-target="#tab_1" aria-controls="navs-pills-top-home" aria-selected="false" tabindex="-1">
                Compras
            </button>
        </li>
        <li class="nav-item" role="presentation">
            <button type="button" class="nav-link waves-effect waves-light " role="tab" data-bs-toggle="tab" data-bs-target="#tab_2" aria-controls="navs-pills-top-profile" aria-selected="true">
                Ventas
            </button>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active show" id="tab_1" role="tabpanel">
            <div class="card-header d-flex align-items-center justify-content-between" style="flex-direction:column">
                <h5 class="card-title m-0 me-2 text-success">
                    <i class="bi bi-box-arrow-in-left" style="font-size:24px"></i>
                    Ultimas Compras
                </h5>
            </div>
            <? require "movimientos/tabla_compras.php"; ?>
        </div>
        <div class="tab-pane fade" id="tab_2" role="tabpanel">
            <div class="card-header d-flex align-items-center justify-content-between" style="flex-direction:column">
                <h5 class="card-title m-0 me-2 text-primary">
                    <i class="bi bi-box-arrow-left" style="font-size:24px"></i>
                    Ultimas Ventas
                </h5>
            </div>
            <? require "movimientos/tabla_ventas.php"; ?>
        </div>
    </div>
</div>
<?
