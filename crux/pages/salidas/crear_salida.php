<?php
$nivel_directorio = "../../";
require "../../carga.php";

//Obtengo las funciones JAVASCRIPT................
require "js/salida.php";

//Tabla para agregar productos al detalle del ingreso
?>
<div class="container">
    <div class="left-column">
        <div class="card">
            <h5 class="card-header">Crea Una Salida</h5>
            <div class="table-responsive text-nowrap">
                <table class="table table-bordered table-hover">
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td width="140">Nombre</td>
                            <td>
                                <?php
                                selector([
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
                            <td colspan="2" class="right">
                                <?php
                                boton("agregar linea", "box", "outline-info", "agregar_linea();");
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="tabla_data" name="tabla_data" class="campos">
            </div>
        </div>
    </div>
    <div class="right-column">
        <table id="tabla-detalle" class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th width="1">#</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Tipo</th>
                    <th>Clase</th>
                    <th>Glosa</th>
                    <th width="1">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <!-- se agregaran las lineas del detalle directamente -->
            </tbody>
        </table>
    </div>
</div>
<br>
<div class="container">
    <table class="table table-bordered table-hover">
        <tbody class="table-border-bottom-0">
            <tr>
                <td>
                    <?php
                    boton("Crear Salida", "box", "success", "crear_salida();");
                    ?>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<style>
    .container {
        display: flex;
        width: 100%;
    }

    .left-column {
        width: 35%;
        padding-right: 15px;
    }

    .right-column {
        width: 65%;
        padding-left: 15px;
    }

    #tabla-detalle tbody tr.new-row {
        opacity: 0;
        transform: translateY(-20px);
        transition: opacity 0.5s ease, transform 0.8s ease;
    }

    #tabla-detalle tbody tr.new-row.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .row-number {
        font-weight: bold;
        text-align: center;
    }
</style>