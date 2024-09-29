<!DOCTYPE html>
<html lang="en">
<?
$nivel_directorio = "";

?>
<body class="log_body">
    <?
    //aqui validamos un intento de inicio de sesión
    if (isset($_REQUEST['usuario']) && isset($_REQUEST['clave'])) {

        //si vemos que hay un intento de iniciar sesion entonces cargamos las funciones necesarias
        require "config.php";
        require "funciones/select.php";

        if ($_REQUEST['usuario'] <> '' || $_REQUEST['clave'] <> '') {
            //obtenemos los datos utilizando las credenciales
            $filtros["per_usuario"] = $_REQUEST['usuario'];
            $filtros["per_clave"] = $_REQUEST['clave'];
            $res = select("personas", "*", $filtros);

            //evaluamos la respuesta
            if (count($res["datos"]) > 0) {
                //si hay datos entonces iniciamos sesion
                $_SESSION['usuario'] = $res["datos"][0];
                echo '<script>location.href="index.php";</script>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Contraseña y/o Usuario Invalidos</div>';
            }
        }
    } else {
        //si no hay intento de inicio de sesion entonces cargamos todas las funciones
        require "carga.php";
    }
    ?>
    <div id="operacion"></div>
    <div id="bodyLogin" class="log_cont">
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-person-circle" viewBox="0 0 16 16">
                    <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                    <path fill-rule="evenodd"
                        d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                </svg>
            </span>
            <input type="text" name="usuario" id="usuario" class="form-control" placeholder="Ingrese su Usuario"
                aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="basic-addon1">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-shield-lock" viewBox="0 0 16 16">
                    <path
                        d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                    <path
                        d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415" />
                </svg>
            </span>
            <input type="password" name="clave" id="clave" class="form-control"
                placeholder="Ingrese su contraseña" aria-describedby="basic-addon1">
        </div>
        <button class="btn btn-secondary boton" onclick="logear()">Ingresar </button>
    </div>
</body>
<script>
    function logear() {
        var usuario = document.getElementById('usuario').value;
        var clave = document.getElementById('clave').value;
        var operacion = document.getElementById('operacion');
        var div = document.getElementById('bodyLogin');
        if (usuario == '' || clave == '') {
            operacion.innerHTML = '<div class="alert alert-danger">Debe ingresar usuario y contraseña</div>';
        } else {
            AJAXPOST(urlBase + "login.php", "usuario=" + usuario + "&clave=" + clave, div);
        }
    }
</script>

</html>