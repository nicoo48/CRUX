<?php
$nivel_directorio = "../../";
require "../../carga.php";

// obtenemos todas las tiendas del usuario
$filtros["per_id"] = $_SESSION['usuario']['per_id'];
$persona = select("personas", "*", $filtros);

if (count($persona) == 0) {
    // No se encuentra al usuario en la tabla personas, cerrar sesión y redirigir
    mensaje(
        "Hubo un error al encontrar al usuario",
        "No se encontró al usuario de la cuenta, contacte a un administrador",
        "warning"
    );
    echo "<script>location.href='".$nivel_directorio."logout.php';</script>";
} else {
    ?>
    <script>
        // Definir la función
        function cargar_formulario() {
            AJAXPOST(urlBase + "pages/configuracion/usuario/editar_usuario.php", "", document.getElementById("pagina_central"));
        }
        // Ejecutar la función inmediatamente después de definirla
        cargar_formulario();
    </script>
    <?php
}
?>
