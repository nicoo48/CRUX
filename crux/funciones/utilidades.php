<?
function _p($array){
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}
function cantidad($cantidad){
    return number_format($cantidad, 0, '.', ',');
}
function fecha($fecha){
    return date("d/m/Y", strtotime($fecha));
}
function fecha_hora($fecha){
    return date("d/m/Y H:i:s", strtotime($fecha));
}