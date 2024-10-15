<?php
$nivel_directorio = "../../";
require "../../carga.php";
//obtenemos todas las tiendas del usuario
$filtros["tnd_per_id"] = $_SESSION['usuario']['per_id'];
$tiendas = select("tiendas", "*", $filtros);
if (count($tiendas["datos"]) > 0) {
    ?>
    <div id="operacion"></div>
    <div style="display:flex;justify-content: space-between;">
        <?php
        barra_busqueda("filtrar_tienda()");
        boton("Nueva Tienda", "star", "outline-success", "crearTienda()");
        ?>
    </div>
    <hr>
    <div class="tiendas-grid">
        <?php
        foreach ($tiendas["datos"] as $tienda) {
            $estilo = ($_SESSION["tienda"]["tnd_id"] == $tienda["tnd_id"]) ? "bg-primary" : "";
            $style = ($_SESSION["tienda"]["tnd_id"] == $tienda["tnd_id"]) ? "style='color:white!important'" : "";
        ?>
            <div class="tienda-card" id="tienda_<?= $tienda["tnd_id"] ?>">
                <div class="card <?= $estilo ?>" <?= $style ?> class="tarjeta_estilo" id="est_<?= $tienda["tnd_id"] ?>">
                    <div class="card-body">
                        <h5 class="card-title" style="display: flex;justify-content: space-between;">
                            <i class="bi bi-shop" <?= $style ?>>&nbsp;<?= $tienda["tnd_nombre"] ?></i>
                        </h5>
                        <p class="card-text">
                            <?
                            echo "<em>".$tienda["tnd_codigo"]."</em> - ".$tienda["tnd_direccion"] 
                            ?>
                        </p>
                        <div style="display: flex;justify-content: flex-end;margin-top: auto;">
                            <?php
                            if ($_SESSION["tienda"]["tnd_id"] == $tienda["tnd_id"]) {
                                boton(
                                    "",
                                    "check-all",
                                    "secondary",
                                    'alerta("Tienda ya Seleccionada","success")',
                                    "Utilizar tienda"
                                );
                            } else {
                                boton(
                                    "",
                                    "check2-square",
                                    "info",
                                    "seleccionar_tienda($tienda[tnd_id])",
                                    "Utilizar tienda"
                                );
                            }
                            boton(
                                "",
                                "pencil",
                                "warning",
                                "editarTienda($tienda[tnd_id])",
                                "Editar la información de la tienda"
                            );
                            boton(
                                "",
                                "trash",
                                "danger",
                                "abrir_modal($tienda[tnd_id])",
                                "Eliminar la tienda"
                            );
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
<?
} else {
    mensaje("Aquí no hay nada.", "Parece que aun no tienes tiendas registradas, ¿por qué no creas una?", "info", "shop", 1);
    boton("Crear Tienda", "plus-circle", "outline-info", "crearTienda()");
}
modal("ModEliminar", "Eliminar Tienda", "¿Estás seguro de que deseas eliminar esta tienda?<p style='color:red'>Esta Acción es Permanente</p>", "shop", "xl", "eliminarTienda()");
?>
<style>
    .tiendas-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1rem;
    }

    .tienda-card {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .tienda-card .card-body {
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .tienda-card .card-title {
        margin-bottom: auto;
    }
</style>
<script>
    function seleccionar_tienda(id) {
        AJAXPOST(urlBase + "pages/tienda/tiendas/seleccionar.php", "id=" + id, document.getElementById("operacion"));
    }
    function filtrar_tienda() {
        const searchTerm = document.getElementById('barra_busqueda').value.toLowerCase();
        const tiendas = document.getElementsByClassName('tienda-card');

        for (let tienda of tiendas) {
            const tiendaNombre = tienda.querySelector('.card-title').textContent.toLowerCase();
            const tiendaDireccion = tienda.querySelector('.card-text').textContent.toLowerCase();

            if (tiendaNombre.includes(searchTerm) || tiendaDireccion.includes(searchTerm)) {
                tienda.style.display = '';
            } else {
                tienda.style.display = 'none';
            }
        }
    }

    function crearTienda() {
        AJAXPOST(urlBase + "pages/tienda/tiendas/crear.php", "", document.getElementById("pagina_central"));
    }

    function editarTienda(id) {
        AJAXPOST(urlBase + "pages/tienda/tiendas/editar.php", "id=" + id, document.getElementById("pagina_central"));
    }

    function eliminarTienda() {
        var id = document.getElementById("valor_modal").value;
        AJAXPOST(urlBase + "pages/tienda/tiendas/eliminar.php", "id=" + id, document.getElementById("pagina_central"));
    }
</script>