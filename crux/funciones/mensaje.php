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
            <div class="alert alert-<?=$tipo?>" role="alert">
                <div style="display:flex;flex-direction: column;align-items: center;">
                    <i class="bi bi-<?=$icono?>" style='font-size: 35px'></i>
                    <h5 class="alert-heading" style="margin:0"><?= $titulo ?></h5>
                    <p><?=$mensaje?></p>
                </div>
            </div>
            <?
        break;
    }
}