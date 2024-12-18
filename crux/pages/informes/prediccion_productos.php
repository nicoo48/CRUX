<?php
$nivel_directorio = "../../";
require "../../carga.php";
require "datos/datos_prediccion.php";
require "js/predicciones_js.php";
?>

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Fila Principal - Gráficos y Estadísticas -->
        <div class="row g-4">
            
            <!-- Gráfico de Proyección de Ventas por Producto (Principal) -->
            <div class="col-xl-8">
                <div class="card h-100 shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h5 class="card-title mb-1">Proyección de Ventas por Producto</h5>
                            <p class="text-muted small mb-0">Análisis y predicción de ventas futuras</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="graficoProyeccionVentas" style="width: 100%; height: 400px;"></div>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Comparación Histórica vs Predicción (Ventas Mensuales) -->
            <div class="col-xl-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-1">Ventas Mensuales: Históricas vs Predicciones</h5>
                        <p class="text-muted small mb-0">Comparación de ventas pasadas con proyecciones futuras</p>
                    </div>
                    <div class="card-body">
                        <div id="graficoTortaPrediccion" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <!-- Gráfico de Tasa de Crecimiento Acumulada -->
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title mb-1">Tasa de Crecimiento Acumulada</h5>
                        <p class="text-muted small mb-0">Crecimiento acumulado de ventas</p>
                    </div>
                    <div class="card-body">
                        <div id="graficoCrecimiento" style="width: 100%; height: 300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Estilo personalizado para mejorar la vista */
    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 0.125rem 0.375rem rgba(0, 0, 0, 0.05);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        margin-bottom: 1.5rem;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.08);
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid rgba(0, 0, 0, .05);
        padding: 1.5rem;
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Estilo para mejorar la visualización de los gráficos */
    .container-xxl {
        max-width: 100%;
    }

    .col-xl-8, .col-xl-4 {
        padding: 1rem;
    }

    .row.g-4 {
        margin: 0;
    }

    .col-xl-8 .card-body, .col-xl-4 .card-body {
        padding: 2rem;
        background: #f9f9f9;
        border-radius: 10px;
    }

    .card-header h5 {
        font-size: 1.25rem;
        font-weight: 600;
    }

    .card-header p {
        font-size: 0.875rem;
        color: #777;
    }

    /* Ajustes para pantallas pequeñas */
    @media (max-width: 991px) {
        .col-xl-8, .col-xl-4 {
            flex: 0 0 100%;
            max-width: 100%;
        }
    }

</style>

