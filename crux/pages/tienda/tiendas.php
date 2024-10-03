<?
$nivel_directorio = "../../";
require "../../carga.php";

//obtenemos todas las tiendas del usuario
$filtros["tnd_per_id"] = $_SESSION['usuario']['per_id'];
$tiendas = select("tiendas", "*", $filtros);
if (count($tiendas["datos"]) > 0) {
    mensaje(
        "Tus tiendas",
        "Aquí puedes ver todas las tiendas que has creado.",
        "info",
        "shop",
        0
    );
?>
    <div class="card">
        <h5 class="card-header">Tiendas</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th width="250">Nombre</th>
                        <th>Dirección</th>
                        <th width="180">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <? foreach ($tiendas["datos"] as $tienda) { ?>
                        <tr>
                            <td><span class="fw-medium"><?= $tienda["tnd_nombre"] ?></span></td>
                            <td><?= $tienda["tnd_direccion"] ?></td>
                            <td style="display:flex">
                                <?
                                boton(";Editar","pencil","outline-success","editarTienda(".$tienda["tnd_id"].")");
                                boton(";Eliminar","trash","outline-danger","eliminarTienda(".$tienda["tnd_id"].")");
                                boton(";Productos","box","outline-info","cargar_pagina('productos.php','tienda',".$tienda["tnd_id"].")");
                                ?>
                            </td>
                        </tr>
                    <?
                    };
                    ?>
                </tbody>
            </table>
        </div>
    </div>
<?
} else {
    mensaje(
        "Aquí no hay nada.",
        "Parece que aun no tienes tiendas registradas, ¿por qué no creas una?",
        "info",
        "shop",
        1
    );
    boton(
        "Crear Tienda",
        "plus-circle",
        "outline-info",
        "crearTienda()"
    );
?>
    <script>
        function crearTienda() {
            AJAXPOST(urlBase + "pages/tienda/tiendas/crear.php", "", document.getElementById("pagina_central"));
        }
    </script>
<?
}
