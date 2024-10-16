<?
/**
 * Función para insertar datos en una tabla
 * @param string $tabla Nombre de la tabla a insertar
 * @param array $datos Array con los datos a insertar
 * @param bool $debug Si es true, muestra la consulta SQL
 * @return array Devuelve un array con los datos de la consulta
 */
function insert($tabla, $datos, $debug = false){
    global $conexion;
    $sql = "INSERT INTO $tabla (";
    foreach ($datos as $key => $value) {
        $sql .= '`' . $key . '`,';
    }
    $sql = substr($sql, 0, -1);
    $sql .= ') VALUES (';
    foreach ($datos as $key => $value) {
        $sql .= "'" . $value . "',";
    }
    $sql = substr($sql, 0, -1);
    $sql .= "),";
    $sql = substr($sql, 0, -1);
    $result = mysqli_query($conexion, $sql);
    // return $sql;
    if ($debug) {
        echo $sql . '<br>';
    }
    if ($result) {
        $data['error'] = 0;
        $data['mensaje'] = 'Se insertaron ' . mysqli_affected_rows($conexion) . ' registros';
        $data['datos'] = mysqli_insert_id($conexion); // Devuelve el ID del registro insertado
        return $data;
    } else {
        $data['error'] = 1;
        $data['mensaje'] = mysqli_error($conexion);
        return $data;
    }
}