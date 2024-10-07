<?php
/**
 * Genera una barra de búsqueda
 * @param string $placeholder Texto de placeholder para el campo de búsqueda
 * @param string $funcion Función JavaScript a ejecutar en el evento onchange
 */
function barra_busqueda( $funcion = "",$placeholder = "Buscar...") {
    ?>
    <div class="search-wrapper" style="width:60%">
        <div class="input-group">
            <span class="input-group-text">
                <i class="ri-search-line"></i>
            </span>
            <input type="text" class="form-control" placeholder="<?=$placeholder?>" oninput="<?=$funcion?>" >
        </div>
    </div>
<?
}
?>