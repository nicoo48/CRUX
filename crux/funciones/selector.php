<?php
function selector($params) {
    global $conexion;

    $p = array_merge([
        'campo' => '', 'tabla' => '', 'id' => '', 'campos' => [],
        'minimo' => 3, 'id_defecto' => '', 'onchange' => '', 
        'onclick' => '', 'todos' => '', 'where' => '', 'order_by' => '',
        'selected' => null // Nuevo parámetro para el valor pre-seleccionado
    ], $params);

    $select = "<select class='form-select form-select-sm campos' name='{$p['campo']}' id='{$p['campo']}'";
    $select .= $p['onchange'] ? " onchange='{$p['onchange']}'" : "";
    $select .= $p['onclick'] ? " onclick='{$p['onclick']}'" : "";
    $select .= ">\n";
    $select .= $p['todos'] ? "<option value=''>{$p['todos']}</option>\n" : "";

    $campos_str = implode(', ', $p['campos']);
    $sql = "SELECT {$p['id']}, {$campos_str} FROM {$p['tabla']}";
    $sql .= $p['where'] ? " WHERE {$p['where']}" : "";
    $sql .= $p['order_by'] ? " ORDER BY {$p['order_by']}" : "";

    $result = mysqli_query($conexion, $sql) or die("Error in query: " . mysqli_error($conexion));

    while ($row = mysqli_fetch_assoc($result)) {
        $option_text = implode(' - ', array_intersect_key($row, array_flip($p['campos'])));
        if (strlen($option_text) >= $p['minimo']) {
            $selected = ($row[$p['id']] == $p['id_defecto'] || $row[$p['id']] == $p['selected']) ? " selected" : "";
            $select .= "<option value='{$row[$p['id']]}'{$selected}>{$option_text}</option>\n";
        }
    }

    return $select . "</select>";
}
?>

<!-- Ejemplo de uso con valor pre-seleccionado -->
<?php
/*
echo selector([
    'campo' => 'comuna',
    'tabla' => 'comunas',
    'id' => 'com_id',
    'campos' => ['com_comuna', 'prv_provincia', 'reg_abreviatura'],
    'todos' => 'Todas las comunas',
    'order_by' => 'com_comuna ASC',
    'selected' => $mov['mov_comuna'] // Asumiendo que $mov['mov_comuna'] contiene el ID de la comuna guardada
]);
*/
?>