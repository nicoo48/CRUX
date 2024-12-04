<?
/**
 * Función para realizar una consulta SELECT
 * @param string $tabla Nombre de la tabla a consultar
 * @param string $campos Campos a seleccionar, por defecto selecciona todos
 * @param array $filtro Filtro de la consulta, por defecto vacio
 * @param string|array $ordenar Campo(s) para ordenar y dirección, por defecto vacío
 * @param bool $depurar Si es true, muestra la consulta SQL
 * @return array Devuelve un array con los datos de la consulta
 */
function select($tabla, $campos = '*', $filtro = array(),  $depurar = false,$ordenar = '') {
    global $conexion;
    $consulta = "SELECT $campos FROM $tabla";
    
    // Agregar filtros WHERE si existen
    if (count($filtro) > 0) {
        if($filtro["where"] != ""){
            $consulta .= " WHERE " . $filtro["where"];
        }else{
            $consulta .= " WHERE ";
            foreach ($filtro as $campo => $valor) {
                $consulta .= "$campo = '$valor' AND ";
            }
            $consulta = substr($consulta, 0, -4);
        }
    }

    
    // Agregar ORDER BY si existe
    if (!empty($ordenar)) {
        if (is_array($ordenar)) {
            $consulta .= " ORDER BY ";
            $clausulasOrden = [];
            foreach ($ordenar as $campo => $direccion) {
                // Si es un array asociativo
                if (is_string($campo)) {
                    $clausulasOrden[] = mysqli_real_escape_string($conexion, $campo) . " " . 
                                      mysqli_real_escape_string($conexion, $direccion);
                } else {
                    // Si es un array simple
                    $clausulasOrden[] = mysqli_real_escape_string($conexion, $direccion);
                }
            }
            $consulta .= implode(", ", $clausulasOrden);
        } else {
            // Si es string
            $consulta .= " ORDER BY " . mysqli_real_escape_string($conexion, $ordenar);
        }
    }
    
    if($depurar) {
        echo "$consulta<br>";
    }
    
    $resultado = mysqli_query($conexion, $consulta);
    
    if($resultado) {
        $datos['error'] = 0;
        $datos['mensaje'] = 'Se encontraron ' . mysqli_num_rows($resultado) . ' registros';
        $datos['datos'] = array();
        while ($fila = mysqli_fetch_assoc($resultado)) {
            $datos['datos'][] = $fila;
        }
        return $datos;
    } else {
        $datos['error'] = 1;
        $datos['mensaje'] = mysqli_error($conexion);
        return $datos;
    }
}
?>