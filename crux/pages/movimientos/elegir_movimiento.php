<div class="row g-4" id="pagina_movimientos">
    <!-- Opción 1 -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="ri-logout-box-line ri-3x text-primary"></i>
                </div>
                <h2 class="card-title mb-4">Movimiento de Salida</h2>
                <p class="card-text">Presiona esta opción para registrar un nuevo movimiento de Salida</p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-2"><i class="ri-check-line text-primary me-2"></i>Permitirá generar reportes</li>
                </ul>
                <div class="mt-4">
                    <button onclick="elegir('salidas')" class="btn btn-primary btn-lg">
                        <i class="ri-box-3-line me-2"></i>Registrar Nueva Salida
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Opción 2 -->
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="ri-login-box-line ri-3x text-success"></i>
                </div>
                <h2 class="card-title mb-4">Movimiento de Ingreso</h2>
                <p class="card-text">Presiona esta opción para registrar un nuevo movimiento de Ingreso</p>
                <ul class="list-unstyled mt-4">
                    <li class="mb-2"><i class="ri-check-line text-success me-2"></i>Permitirá generar reportes</li>
                </ul>
                <div class="mt-4">
                    <button onclick="elegir('ingresos')" class="btn btn-success btn-lg">
                        <i class="ri-box-3-line me-2"></i>Registrar Nuevo Ingreso
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function elegir(nombre){
        var div = document.getElementById('pagina_movimientos');
        console.log(urlBase + "pages/"+nombre+"/crear_"+nombre+".php");
        AJAXPOST(urlBase + "pages/"+nombre+"/crear_"+nombre+".php", "" , div);
    }
</script>