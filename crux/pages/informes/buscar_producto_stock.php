<?php
$nivel_directorio = "../../";
require "../../carga.php";
// CONSULTAS A LA BBDD
require "datos/datos_stock.php";
// JAVASCRIPT
require "js/stock.php";
?>
<!-- Buscador de Producto -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Consulta el Stock de otro Producto</h5>
            </div>
            <div class="card-body">
                <form class="row g-3 align-items-center">
                    <div class="col-md-8">
                        <div class="buscador">
                            <?php selector([
                                'campo' => 'producto',
                                'tabla' => 'productos',
                                'id' => 'pro_id',
                                'campos' => ['pro_codigo', 'pro_nombre'],
                                'todos' => 'Seleccione un producto',
                                'order_by' => 'pro_codigo ASC'
                            ]); ?>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" class="btn btn-primary" onclick="buscarProducto()">
                            <i class="bx bx-search me-1"></i>
                            Consultar Stock
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>