<?
//iniciamos la sesion en general 
session_start();

/* Configuración del archivo, necesaria para cargar ciertas cosas */
$urlBase = "http://localhost/crux/";
$titulo = "Proyecto Base";

/* Conexion a la base de datos */
$cnx_basedatos = "crux";
$cnx_usuario = "root";
$cnx_clave = "";
$cnx_servidor = "127.0.0.1";

//declaramos como global la conexion para despues utilizarla en las funciones
global $conexion;
$conexion = mysqli_connect($cnx_servidor, $cnx_usuario, $cnx_clave, $cnx_basedatos);
if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}

?>
<script>
    //Variables de configuración en JS
    var urlBase = "<?= $urlBase ?>";
</script>

<?