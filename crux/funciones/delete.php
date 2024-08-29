<?
/**
 * Funcion para realizar un DELETE en una tabla
 * @param string $tabla Nombre de la tabla a eliminar
 * @param string $filtro Filtro de la consulta, por defecto vacio
 * @param bool $debug Si es true, muestra la consulta SQL
 * @return bool Devuelve true si se elimino correctamente, false si no
 */
function delete($tabla, $filtro, $debug = false){
    global $cnx_mysql;
    $sql = "DELETE FROM $tabla WHERE $filtro";
    $result = mysqli_query($cnx_mysql, $sql);
    if ($debug) {
        echo $sql;
    }
    if ($result) {
        return true;
    } else {
        return false;
    }
}