<?
function mensaje($titulo, $mensaje, $tipo = "info",$icono = "info-circle") {
    ?>
    <div class="alert alert-<?=$tipo?>" role="alert">
        <h3 class="alert-heading"><i class="bi bi-<?=$icono?>"></i> &nbsp;<?=$titulo?></h3>
        <p><?=$mensaje?></p>
    </div>
    <?
}

function mensaje_exito($titulo, $mensaje) {
    ?>
    <div class="alert alert-success" role="alert" style="text-align: center;">
        <h3 class="alert-heading">
            <img src="path_to_gif/check.gif" alt="Éxito" style="width: 50px; height: 50px;">
            &nbsp;<?=$titulo?>
        </h3>
        <p><?=$mensaje?></p>
    </div>
    <?php
}