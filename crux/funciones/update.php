<?
/**
 * Función para realizar un UPDATE en una tabla
 * @param string $tabla Nombre de la tabla a actualizar
 * @param array $datos Array con los datos a actualizar
 * @param string $filtro Filtro de la consulta, por defecto vacio
 * @param bool $debug Si es true, muestra la consulta SQL
 * @return array Devuelve un array con los datos de la consulta
 */
function update($tabla, $datos, $filtro, $debug = false){
    global $conexion;
    $sql = "UPDATE $tabla SET ";
    foreach ($datos as $key => $value) {
        $sql .= $key . " = '" . $value . "',";
    }
    $sql = substr($sql, 0, -1);
    if ($filtro <> '') {
        $sql .= ' WHERE ' . $filtro;
    }
    $result = mysqli_query($conexion, $sql);
    if ($debug) {
        echo $sql . '<br>';
    }
    if ($result) {
        $datos['resultado'] = $result;
        $datos['error'] = 0;
        return $datos;
    } else {
        $datos['resultado'] = mysqli_error($conexion);
        $datos['error'] = 1;
        return $datos;

    }

}