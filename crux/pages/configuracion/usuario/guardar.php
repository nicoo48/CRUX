<?
$nivel_directorio = "../../../";
require "../../../carga.php";
//primero validamos si la clave actual es correcta

echo "<script>";
if($_REQUEST['act_clave'] <> $_SESSION['usuario']['per_clave']){
    echo 'alerta("La clave actual no es correcta","error")';
    exit;
}else{
    echo 'var div = document.getElementById("operacion");';
    echo 'div.innerHTML = "";';     
    echo 'var div = document.getElementById("div_boton");';
    echo 'div.innerHTML = "";';     
}
echo "</script>";

// preguntamos si es que viene la imagen apra guardarla en una variable 

//creamos un array con los campos que se van a actualizar
$campos['per_nombre'] = $_REQUEST['nombre'];
$campos['per_clave'] = $_REQUEST['nue_clave'];
$campos['per_apellidos'] = $_REQUEST['apellidos'];
if(isset($_FILES['imagen'])) {$campos['per_imagen'] = subir_archivo($_FILES['imagen']);}
$campos['per_correo'] = $_REQUEST['correo'];
$campos['per_telefono'] = $_REQUEST['telefono'];
$filtro['per_id'] = $_SESSION['usuario']['per_id'];

$res = update("personas",$campos,$filtro);

if(!$res["error"]){
    mensaje("Guardado Con Exito!","Datos de usuario guardados correctamente.","success","person",1);
    
    //es necesario actualizar la variable de sesion
    $nuevos_datos = select("personas","*",array("per_id"=>$_SESSION['usuario']['per_id']));
    $_SESSION['usuario'] = $nuevos_datos["datos"][0];
    
    //ademas recargamos la pagina
    echo "<script>setTimeout(function(){location.reload();},2000);</script>";
}