<?php
function _label_estado($categoria, $valor, $tipo = 1) {
    global $estados;
    
    if (!isset($estados[$categoria]) || !isset($estados[$categoria][$valor])) {
        // Si la categoría o el valor no existen, devuelve una etiqueta por defecto
        return _label("Desconocido", "bi-question-circle", "secondary", $tipo);
    }
    
    $estado = $estados[$categoria][$valor];
    return _label($estado[0], $estado[1], $estado[2], $tipo);
}

function _label($texto, $icono = "", $color = "secondary", $tipo = 1) {
    ob_start();
    if ($tipo == 1) {
        // Etiqueta compacta
        ?>
        <span class="badge bg-<?php echo $color; ?> d-inline-flex align-items-center">
            <?php if ($icono !== ""): ?>
                <i class="bi <?php echo $icono; ?> me-1"></i>
            <?php endif; ?>
            <?php echo $texto; ?>
        </span>
        <?php
    } else {
        // Etiqueta de ancho completo
        ?>
        <div class="d-flex w-100">
            <span class="badge bg-<?php echo $color; ?> d-flex align-items-center justify-content-center w-100">
                <?php if ($icono !== ""): ?>
                    <i class="bi <?php echo $icono; ?> me-1"></i>
                <?php endif; ?>
                <?php echo $texto; ?>
            </span>
        </div>
        <?php
    }
    return ob_get_clean();
}

// Ejemplo de uso:
// echo _label_estado("producto", "1",1);
// echo _label_estado("usuario", "2",2);
?>