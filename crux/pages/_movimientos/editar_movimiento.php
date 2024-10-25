<?php
$nivel_directorio = "../../";
require "../../carga.php";

//obtenemos los datos del movimiento a editar
$filtros["mov_id"] = $_REQUEST["id"];
$movimientos = select("movimientos", "*", $filtros);
$mov = $movimientos["datos"][0]; // Asumimos que solo hay un resultado

//Tabla para editar movimientos
?>
<div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
    tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalToggleLabel">Editar movimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover">
                    <tbody class="table-border-bottom-0">
                        <tr>
                            <td width="140">Tipo Mov.</td>
                            <td>
                                <select name="tipo" id="tipo" class='form-select form-select-sm campos'>
                                    <option value="">- Seleccione el tipo de mov -</option>
                                    <option value="ing" <?php echo ($mov['mov_tipo'] == 'ing') ? 'selected' : ''; ?>>
                                        Ingreso</option>
                                    <option value="sal" <?php echo ($mov['mov_tipo'] == 'sal') ? 'selected' : ''; ?>>
                                        Salida</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>Clase Mov.</td>
                            <td>
                                <select name="clase" id="clase" class='form-select form-select-sm campos'>
                                    <option value="">- Seleccione la clase del mov -</option>
                                    <option value="AJU" <?php echo ($mov['mov_clase'] == 'AJU') ? 'selected' : ''; ?>>
                                        Ajuste</option>
                                    <option value="REP" <?php echo ($mov['mov_clase'] == 'REP') ? 'selected' : ''; ?>>
                                        Reposición</option>
                                    <option value="MTI" <?php echo ($mov['mov_clase'] == 'MTI') ? 'selected' : ''; ?>>Mov.
                                        entre tiendas</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td valign="top">Glosa</td>
                            <td><textarea type="text" class="form-control campos" name="glosa" id="glosa"
                                    placeholder="Ingrese la Glosa" rows="3"><?php echo $mov['mov_glosa'] ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <?php
                                boton("Actualizar Movimiento", "box", "outline-success", "actualizar_movimiento(" . $mov['mov_id'] . ");");
                                ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function actualizar_movimiento(id) {
        // Aquí deberías agregar el código JavaScript para enviar los datos actualizados al servidor
        // Por ejemplo, podrías usar AJAX para enviar los datos al servidor sin recargar la página
        console.log("Actualizando movimiento con ID: " + id);
    }
</script>