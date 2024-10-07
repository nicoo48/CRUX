<?php
$nivel_directorio = "../../";
require "carga.php";


// obtenemos todas las tiendas del usuario
$filtros["per_id"] = $_SESSION['usuario']['per_id'];
$persona = select("personas", "*", $filtros);

?>

<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            <?
            $ruta = $urlBase . "template/assets/img/avatars/" . $persona["datos"][0]['per_imagen'];
            if (file_exists($ruta)) {
                echo "<img src='$ruta' alt class='rounded-circle'/>";
            } else {
                echo "<img src='template/assets/img/avatars/21.png' alt class='rounded-circle'/>";
            }
            ?>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" onclick="cargar_formulario()">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-2">
                        <div class="avatar avatar-online">
                            <?
                            $ruta = $urlBase . "template/assets/img/avatars/" . $persona["datos"][0]['per_imagen'];
                            if (file_exists($ruta)) {
                                echo "<img src='$ruta' alt class='rounded-circle'/>";
                            } else {
                                echo "<img src='template/assets/img/avatars/21.png' alt class='rounded-circle'/>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <span class="fw-medium d-block small"><?= $persona["datos"][0]["per_usuario"] ?></span>
                        <small class="text-muted">
                            <?
                            if ($persona["datos"][0]["per_admin"] == 1) {
                                echo "admin";
                            } else {
                                echo "usuario";
                            }
                            ?>
                        </small>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <div class="d-grid px-4 pt-2 pb-1">
                <?
                boton("Salir", "arrow-left", "danger", "salir()");
                ?>
            </div>
        </li>
    </ul>
</li>
<script>
    function cargar_formulario() {
        AJAXPOST(urlBase + "pages/configuracion/usuario/editar_usuario.php", "", document.getElementById("pagina_central"));
    }

    function salir() {
        AJAXPOST(urlBase + "logout.php", "", null);
        setTimeout(function() {
            window.location.href = "login.php";
        }, 1000);
    }
</script>