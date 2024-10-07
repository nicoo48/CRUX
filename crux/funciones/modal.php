<?php
/**
 * Función para crear un modal básico con funciones JavaScript personalizables y elementos centrados
 * @param string $id ID único del modal
 * @param string $titulo Título del modal
 * @param string $contenido Contenido del cuerpo del modal
 * @param string $icono Icono de Bootstrap Icons (https://icons.getbootstrap.com/)
 * @param string $tamano Tamaño del modal (sm, lg, xl)
 * @param string $funcion_guardar Función JavaScript a ejecutar al hacer clic en "Aceptar"
 */
function modal($id, $titulo, $contenido, $icono,$tamano = "", $funcion_guardar = ""){
    $tamano_clase = $tamano ? "modal-$tamano" : "";
    ?>
    <!-- Modal -->
    <div class="modal fade" id="<?=$id?>" tabindex="-1" aria-labelledby="<?=$id?>Label" aria-hidden="true">
        <div class="modal-dialog <?=$tamano_clase?>" style="display: flex; align-items: center; min-height: calc(100% - 1rem);">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h1 class="modal-title" id="<?=$id?>Label" style='font-size: 35px;'>
                        <i class="bi bi-<?=$icono?>"></i>
                        <?=$titulo?>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 1rem;"></button>
                </div>
                <div class="modal-body text-center">
                    <?=$contenido?>
                    <input type="hidden" class="campos" name="valor_modal" id="valor_modal">
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        <i class="bi bi-x-lg"></i>
                        &nbsp;
                        Cancelar
                    </button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal" onclick="<?=$funcion_guardar?>">
                        <i class="bi bi-check-lg"></i>
                        &nbsp;
                        Aceptar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <script>
        function abrir_modal(id){
            if(id != ""){$("#valor_modal").val(id);}
            var myModal = new bootstrap.Modal(document.getElementById('<?=$id?>'));
            myModal.show();
        }
    </script>
<?php
}
?>