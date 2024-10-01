<?php

/**
 * Función de botón básico con icono, texto opcional, función onclick y tooltip (texto emergente)
 * @param string $texto Texto del botón (opcional si solo quieres usar el tooltip)
 * @param string $icono Icono del botón
 * @param string $estilo_boton Estilo del botón (color de Bootstrap)
 * @param string $funcion Función onclick del botón
 * @return void
 */
function boton($texto = "", $icono = "info", $estilo_boton = "success", $funcion = "")
{
    $extra = ($funcion !== "") ? 'onclick="' . $funcion . '"' : '';
    if (substr($texto, 0, 1) == ";") {
        $texto = str_replace(";", "", $texto);
        $tooltip_attr = 'data-bs-toggle="tooltip" data-bs-custom-class="custom-tooltip" data-bs-placement="top" data-bs-title="' . $texto . '"';
        $texto = '';
    } else {
        $tooltip_attr = '';
    }

    echo '<button style="margin-right:5px" class="btn btn-' . $estilo_boton . '" ' . $extra . ' ' . $tooltip_attr . '><i class="bi bi-' . $icono . '"></i>&nbsp;' . $texto . '</button>';
    if ($tooltip_attr <> '') {
        ?>
        <script>
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        </script>
        <?
    }
}
