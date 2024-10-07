<?
/**
 * Funcion para realizar un DELETE en una tabla
 * @param string $tabla Nombre de la tabla a eliminar
 * @param array $filtros Filtro de la consulta, por defecto vacio
 * @param bool $debug Si es true, muestra la consulta SQL
 * @return array Devuelve un array con los datos de la consulta
 */
function deletear($tabla, $filtros, $debug = false){
    global $conexion;
    $sql = "DELETE FROM $tabla";
    if($filtros <> ""){
        $sql .=" WHERE ";
        foreach($filtros as $key => $value){
            $sql .= "($key = '$value') AND";
        }
        $sql = substr($sql, 0, -3);
    }
    $result = mysqli_query($conexion, $sql);
    if ($debug) {
        echo $sql;
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