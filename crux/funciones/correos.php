<?
use PHPMailer\PHPMailer\PHPMailer;

function enviarCorreo($variables){
    global $_conf;
    $mail = new PHPMailer();
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->SMTPSecure =$_conf['correo']['secure'] ;
    $mail->SMTPDebug = 0;
    $mail->Host = $_conf['correo']['host'];
    $mail->Port = 465;
    $mail->isHTML();
    $mail->Username = $_conf['correo']['correo'];
    $mail->Password = $_conf['correo']['clave'];
    $mail->SetFrom("notificapanalwms@syan.cl","PANAL WMS"); 
    $mail->Subject = utf8_decode($variables['asunto']);
    $mail->Body = utf8_decode($variables['contenido']); 
    $correos = explode(",",$variables["correos"]);
    foreach($correos as $correo){
        if($correo <> ""){
            $mail->AddAddress($correo);
        }
    }
    if($mail->Send()){
        return true;
    }else{
        return $mail->ErrorInfo;
    }
}