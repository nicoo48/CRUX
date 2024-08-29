<?
/**
 * Función para realizar una consulta SELECT
 * @param string $tabla Nombre de la tabla a consultar
 * @param string $campos Campos a seleccionar, por defecto selecciona todos
 * @param array $filtro Filtro de la consulta, por defecto vacio
 * @param bool $debug Si es true, muestra la consulta SQL
 * @return array Devuelve un array con los datos de la consulta
 */
function select($tabla, $campos = '*', $filtro = array(), $debug = false){
    global $conexion;
    $sql = "SELECT $campos FROM $tabla";
    if (count($filtro) > 0) {
        $sql .= " WHERE ";
        foreach ($filtro as $key => $value) {
            $sql .= "$key = '$value' AND ";
        }
        $sql = substr($sql, 0, -4);
    }
    $result = mysqli_query($conexion, $sql);
    if($debug){
        echo "$sql<br>";
    }
    if($result){
        $data['error'] = 0;
        $data['mensaje'] = 'Se encontraron ' . mysqli_num_rows($result) . ' registros';
        $data['datos'] = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data['datos'][] = $row;
        }
        return $data;
    }else{
        $data['error'] = 1;
        $data['mensaje'] = mysqli_error($conexion);
        return $data;
    }
}