<?
function mensaje($titulo, $mensaje, $tipo = "info", $icono = "info-circle", $modo = 0){
    switch ($modo) {
        case 0:
            // Mensaje clasico y el por defecto
            ?>
            <div class="alert alert-<?= $tipo ?>" role="alert">
                <h3 class="alert-heading"><i class="bi bi-<?= $icono ?>"></i> &nbsp;<?= $titulo ?></h3>
                <p><?= $mensaje ?></p>
            </div>
            <?
        break;
        
        case 1:
            // Mensaje mas tipo error de pagina moderna con icono arriba titulo y descripción todo centrado
            ?>
            <div class="alert alert-<?= $tipo ?>" role="alert">
                <div style="display:flex;flex-direction: column;align-items: center;">
                    <h1><i class="bi bi-<?= $icono ?>"></i></h1>
                    <h3 class="alert-heading"><?= $titulo ?></h3>
                    <p><?= $mensaje ?></p>
                </div>
            </div>
            <?
        break;
    }
}