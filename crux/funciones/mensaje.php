<?
function mensaje($titulo, $mensaje, $tipo = "info",$icono = "info-circle") {
    ?>
    <div class="alert alert-<?=$tipo?>" role="alert">
        <h3 class="alert-heading"><i class="bi bi-<?=$icono?>"></i> &nbsp;<?=$titulo?></h3>
        <p><?=$mensaje?></p>
    </div>
    <?
}