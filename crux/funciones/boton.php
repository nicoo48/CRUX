<?
/**
 * Función de botón básico con icono, texto opcional, función onclick y título (información al pasar el mouse)
 * @param string $texto Texto del botón
 * @param string $icono Icono del botón
 * @param string $estilo_boton Estilo del botón (color de Bootstrap)
 * @param string $funcion Función onclick del botón
 * @param string $titulo Texto que se mostrará al pasar el mouse (opcional)
 * @return void
 */
function boton($texto = "", $icono = "info", $estilo_boton = "success", $funcion = "", $titulo = "") {
    $extra = ($funcion !== "") ? 'onclick="' . $funcion . '"' : '';
    $titulo_attr = ($titulo !== "") ? 'title="' . htmlspecialchars($titulo) . '"' : '';

    echo '<button style="margin-right:5px" class="btn btn-' . $estilo_boton . '" ' . $extra . ' ' . $titulo_attr . '><i class="bi bi-' . $icono . '"></i>&nbsp;' . $texto . '</button>';
}