<!-- Card 1: Resumen de ventas -->
<div class="col-md-6 col-xl-8 mb-4">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-tittle">
                Bienvenido <?= $_SESSION["usuario"]["per_nombre"] ?>
            </h5>
            <small><?= date("d/m/Y") ?></small>
        </div>
        <div class="card-body">
            <h5><i class="bi bi-currency-dollar"></i> Meta Mensual</h5>
            <div class="d-none d-lg-flex progress-labels mb-5">
                <div class="progress-label loading-text" style="width: 69.9%">$70.000</div>
                <div class="progress-label waiting-text" style="width: 30.1%">$30.000</div>
            </div>
            <div class="overview-progress progress rounded-4 bg-transparent mb-2" style="height: 46px">
                <div class="progress-bar small fw-medium text-start bg-primary px-1 px-lg-4" role="progressbar"
                    style="width: 69.9%" aria-valuenow="28.3" aria-valuemin="0" aria-valuemax="100">
                    69.9%
                </div>
                <div class="progress-bar small fw-medium text-start rounded-start bg-lighter text-heading px-1 px-lg-4"
                    role="progressbar" style="width: 30.1%" aria-valuenow="39.7" aria-valuemin="0" aria-valuemax="100">
                    30.1%
                </div>
            </div>
        </div>
    </div>
</div>