<div class="row g-4" id="cartas">
    <!-- Opción 1 -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body text-center d-flex flex-column justify-content-between">
                <div>
                    <div class="mb-4">
                        <i class="ri-logout-box-line ri-4x text-primary"></i>
                    </div>
                    <h2 class="card-title mb-4">Movimiento de Salida</h2>
                    <p class="card-text">Presiona esta opción para registrar un nuevo movimiento de Salida en el inventario. Este proceso es esencial para mantener un control preciso de los productos que salen de nuestro almacén.</p>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-2"><i class="ri-check-line text-primary me-2"></i>Permitirá generar reportes detallados</li>
                        <li class="mb-2"><i class="ri-check-line text-primary me-2"></i>Actualiza automáticamente el stock</li>
                        <li class="mb-2"><i class="ri-check-line text-primary me-2"></i>Facilita el seguimiento de productos</li>
                    </ul>
                </div>
                <div class="mt-5">
                    <button onclick="ir_a_salidas()" class="btn btn-primary btn-lg">
                        <i class="ri-box-3-line me-2"></i>Registrar Nueva Salida
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Opción 2 -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body text-center d-flex flex-column justify-content-between">
                <div>
                    <div class="mb-4">
                        <i class="ri-login-box-line ri-4x text-success"></i>
                    </div>
                    <h2 class="card-title mb-4">Movimiento de Ingreso</h2>
                    <p class="card-text">Presiona esta opción para registrar un nuevo movimiento de Ingreso en el inventario. Este proceso es crucial para mantener un registro preciso de los productos que entran a nuestro almacén.</p>
                    <ul class="list-unstyled mt-4">
                        <li class="mb-2"><i class="ri-check-line text-success me-2"></i>Permitirá generar reportes detallados</li>
                        <li class="mb-2"><i class="ri-check-line text-success me-2"></i>Actualiza automáticamente el stock</li>
                        <li class="mb-2"><i class="ri-check-line text-success me-2"></i>Facilita el control de inventario</li>
                    </ul>
                </div>
                <div class="mt-5">
                    <button onclick="ir_a_ingresos()" class="btn btn-success btn-lg">
                        <i class="ri-box-3-line me-2"></i>Registrar Nuevo Ingreso
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function ir_a_salidas() {
        AJAXPOST(urlBase + "pages/salidas/crear_salida.php", "", document.getElementById("pagina_central"));
    }
    function ir_a_ingresos() {
        AJAXPOST(urlBase + "pages/ingreso/crear_ingreso.php", "", document.getElementById("pagina_central"));

    }
</script>