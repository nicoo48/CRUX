<?
$nivel_directorio = "../../";
require "../../carga.php";
//obtenemos todas las tiendas del usuario
$movimientos = select("movimientos", "*");
$mov = $movimientos["datos"];
//Tabla para agregar productos al detalle del ingreso
?>
<div class="container">
    <div class="card">
        <h5 class="card-header">Crea Un Movimiento</h5>
        <div class="table-responsive text-nowrap">
            <table class="table table-bordered table-hover">
                <tbody class="table-border-bottom-0">
                    <tr>
                        <td width="140">Nombre</td>
                        <td>
                            <?
                            echo selector([
                                'campo' => 'producto',
                                'tabla' => 'productos',
                                'id' => 'pro_id',
                                'campos' => ['pro_codigo', 'pro_nombre'],
                                'todos' => 'Seleccione un producto',
                                'order_by' => 'pro_codigo ASC'
                            ]);

                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Cantidad</td>
                        <td><input type="text" class="form-control campos" name="cantidad" id="cantidad"
                                placeholder="Ingrese la cantidad"></td>
                    </tr>
                    <tr>
                        <td>Tipo Mov.</td>
                        <td>
                            <select name="tipo" id="tipo" class='form-select form-select-sm campos'>
                                <option value="">- Seleccione el tipo de mov -</option>
                                <option value="ing">Ingreso</option>
                                <option value="sal">Salida</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Clase Mov.</td>
                        <td>
                            <select name="clase" id="clase" class='form-select form-select-sm campos'>
                                <option value="">- Seleccione la clase del mov -</option>
                                <option value="AJU">Ajuste</option>
                                <option value="REP">Reposición</option>
                                <option value="MTI">Mov. entre tiendas</option><!--MOVIMIENTOS ENTRE TIENDAS-->
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td valign="top">Glosa</td>
                        <td><textarea type="text" class="form-control campos" name="glosa" id="glosa"
                                placeholder="Ingrese la Glosa" rows="3"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="2" >
                            <?
                            boton("Crear Movimiento", "box", "outline-success", "crear_movimiento();");
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function crear_movimiento() {
        if (!validar_input("producto", "Debe ingresar un nombre para la tienda.")) {
            return;
        }
        if (!validar_input("cantidad", "Debe ingresar un nombre para la tienda.")) {
            return;
        }
        if (!validar_input("tipo", "Debe ingresar un nombre para la tienda.")) {
            return;
        }
        if (!validar_input("clase", "Debe ingresar un nombre para la tienda.")) {
            return;
        }
        var campos = $(".campos").serialize();
        var div = document.getElementById("container");
        AJAXPOST(urlBase + "pages/movimientos/movimientos/guardar.php", campos, document.getElementById("pagina_central"));
    }
</script>

<style>
    .container {
        display: flex;
        width: 100%;
    }
    .container .card{
        display: flex;
        width: 100%;
    }
</style>