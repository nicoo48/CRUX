<script>
    let rowCounter = 1;

    function agregar_linea() {
        var producto = $("#producto option:selected").text();
        var productoId = $("#producto").val();
        var cantidad = $("#cantidad").val();
        var clase = $("#clase option:selected").text();
        var claseValue = $("#clase").val();
        var glosa = $("#glosa").val();

        if (!validar_input("producto", "Debe ingresar un Producto.")) return;
        if (!validar_input("cantidad", "Debe ingresar una Cantidad.")) return;
        if (!validar_input("clase", "Debe ingresar la clase del movimiento.")) return;
        if (!validar_input("glosa", "Debe ingresar una glosa para el movimiento.")) return;

        dibujarNuevaFila(productoId, producto, cantidad, claseValue, clase, glosa);
        limpiarFormulario();
    }
    
    function dibujarNuevaFila(productoId, producto, cantidad, claseValue, clase, glosa) {
        var tabla = document.querySelector("#tabla-detalle tbody");
        var nuevaFila = tabla.insertRow();

        nuevaFila.className = 'new-row';
        nuevaFila.innerHTML = `
            <td class="row-number">${rowCounter}</td>
            <td class="campos" data-id="${productoId}">${producto}</td>
            <td class="campos">${cantidad}</td>
            <td class="campos">Ingreso</td>
            <td class="campos" data-value="${claseValue}">${clase}</td>
            <td class="campos">${glosa}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="eliminarFila(this)">Eliminar</button>
            </td>
        `;

        nuevaFila.offsetHeight;
        nuevaFila.classList.add('visible');
        rowCounter++;
    }

    function limpiarFormulario() {
        $("#producto").val("");
        $("#cantidad").val("");
        $("#clase").val("");
        $("#glosa").val("");
    }

    function eliminarFila(boton) {
        var fila = boton.closest("tr");
        fila.classList.remove('visible');
        setTimeout(() => {
            fila.remove();
            actualizarNumeracion();
        }, 500);
    }

    function actualizarNumeracion() {
        rowCounter = 1;
        document.querySelectorAll('#tabla-detalle tbody tr').forEach((row) => {
            row.querySelector('.row-number').textContent = rowCounter;
            rowCounter++;
        });
    }

    function crear_ingreso() {
        var tableData = [];
        document.querySelectorAll('#tabla-detalle tbody tr').forEach((row) => {
            tableData.push({
                producto: row.cells[1].dataset.id,
                cantidad: row.cells[2].textContent,
                clase: row.cells[4].dataset.value,
                glosa: row.cells[5].textContent
            });
        });

        if (tableData.length === 0) {
            alert("No hay productos en la tabla. Agregue al menos un producto antes de crear la salida.");
            return;
        }

        $('#tabla_data').val(JSON.stringify(tableData));
        var campos = $(".campos").serialize();
        console.log(campos);
        AJAXPOST(urlBase + "pages/ingreso/ajax/guardar.php", campos, document.getElementById("pagina_central"));
    }

    function validar_input(id, mensaje) {
        var valor = $("#" + id).val();
        if (valor == "" || valor == null) {
            alert(mensaje);
            $("#" + id).focus();
            return false;
        }
        return true;
    }

    $(document).ready(function() {
        rowCounter = 1;
    });
</script>