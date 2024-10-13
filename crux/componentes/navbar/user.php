<?
// Si la variable `veces` está definida, modificamos el nivel de directorios
$nivel_directorio = "";
if (isset($_REQUEST["veces"])) {
    $veces = (int)$_REQUEST["veces"]; // Asegurarse de que es un entero
    for ($i = 0; $i < $veces; $i++) {
        $nivel_directorio .= "../";
    }
    require $nivel_directorio . "carga.php";
}


// obtenemos todas las tiendas del usuario
$persona = $_SESSION['usuario'];
?>
<li class="nav-item navbar-dropdown dropdown-user dropdown">
    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
        <div class="avatar avatar-online">
            <?
            if ($persona['per_imagen'] <> "") {
                echo "<img src='$persona[per_imagen]' alt class='rounded-circle'/>";
            } else {
                echo "<img src='template/assets/img/avatars/21.png' alt class='rounded-circle'/>";
            }
            ?>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li>
            <a class="dropdown-item" onclick="cargar_pagina('configuracion.php','configuracion')">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-2">
                        <div class="avatar avatar-online">
                            <?
                            if ($persona['per_imagen'] <> "") {
                                echo "<img src='$persona[per_imagen]' alt class='rounded-circle'/>";
                            } else {
                                echo "<img src='template/assets/img/avatars/21.png' alt class='rounded-circle'/>";
                            }
                            ?>
                        </div>
                    </div>
                    <div class="flex-grow-1">
                        <small class="text-muted"><?= "<b>Usuario:</b> <em>$persona[per_usuario]</em>";?></small>
                        <br>
                        <small class="text-muted"><?= "<b>Tienda:</b><em>".$_SESSION["tienda"]["tnd_codigo"]."</em>";?></small>
                    </div>
                </div>
            </a>
        </li>
        <li>
            <div class="dropdown-divider"></div>
        </li>
        <li>
            <div class="d-grid px-4 pt-2 pb-1">
                <?boton("Salir", "arrow-left", "danger", "salir()");?>
            </div>
        </li>
    </ul>
</li>
<script>
    function salir() {
        AJAXPOST(urlBase + "logout.php", "", null);
        setTimeout(function() {
            window.location.href = "login.php";
        }, 1000);
    }
</script>