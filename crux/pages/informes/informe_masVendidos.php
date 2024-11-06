<?php
$nivel_directorio = "../../";
require "../../carga.php";

// CONSULTAS A LA BBDD
require "datos/datos_masVendidos.php";

// JAVASCRIPT
require "js/masVendidos.php";
?>
<!-- Solo incluir la librería básica de Highcharts -->
<script src="https://code.highcharts.com/highcharts.js"></script>

<div class="container-fluid py-4">
    <div class="row">
        <!-- Gráfico Principal de Ventas -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Productos más Vendidos</h5>
                </div>
                <div class="card-body">
                    <div id="ventasChart"></div>
                </div>
            </div>
        </div>
        
        <!-- Panel Lateral de Estadísticas -->
        <div class="col-lg-4">
            <!-- Ventas del Mes -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Ventas del Mes</h5>
                </div>
                <div class="card-body">
                    <div class="card-info">
                        <p class="mb-0">Total Ventas</p>
                        <h5 class="mb-0">$<?= number_format($total_mes['total_ventas'], 0) ?></h5>
                    </div>
                </div>
            </div>

            <!-- Estadísticas Rápidas -->
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Estadísticas</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-0">Productos en Stock</h6>
                            <small class="text-muted">Total disponible</small>
                        </div>
                        <h4 class="mb-0" style="font-size:20px"><?= number_format($stats['total_productos']) ?></h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-0">Total Compras</h6>
                            <small class="text-muted">Este mes</small>
                        </div>
                        <h4 class="text-success mb-0" style="font-size:20px">$<?= number_format($stats['total_ingresos']) ?></h4>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-0">Total Ventas</h6>
                            <small class="text-muted">Este mes</small>
                        </div>
                        <p class="text-danger mb-0" style="font-size:20px">$<?= number_format($stats['total_salidas']) ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
        .avatar {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
        }
        .avatar-initial { 
            font-weight: 500;
            font-size: 14px;
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 1.5rem;
        }
        .progress {
            background-color: #e9ecef;
        }
    </style>