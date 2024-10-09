<script>
    let rowCounter = 0;

    function agregar_linea() {
        var producto = $("#producto option:selected").text();
        var cantidad = $("#cantidad").val();
        var clase = $("#clase option:selected").text();
        var glosa = $("#glosa").val();

        if (!producto || !cantidad || !clase) {
            alert("Por favor, complete todos los campos obligatorios.");
            return;
        }

        dibujarNuevaFila(producto, cantidad, clase, glosa);
        limpiarFormulario();
    }

    function dibujarNuevaFila(producto, cantidad, clase, glosa) {
        var tabla = document.querySelector("#tabla-detalle tbody");
        var nuevaFila = tabla.insertRow();
        rowCounter++;

        nuevaFila.className = 'new-row';
        nuevaFila.innerHTML = `
            <td class="row-number">${rowCounter}</td>
            <td>${producto}</td>
            <td>${cantidad}</td>
            <td>Salida</td>
            <td>${clase}</td>
            <td>${glosa}</td>
            <td>
                <button class="btn btn-danger btn-sm" onclick="eliminarFila(this)">Eliminar</button>
            </td>
        `;

        // Trigger reflow
        nuevaFila.offsetHeight;

        // Add visible class to start animation
        nuevaFila.classList.add('visible');
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
        }, 500); // This should match the transition duration in CSS
    }

    function actualizarNumeracion() {
        rowCounter = 0;
        document.querySelectorAll('#tabla-detalle tbody tr').forEach((row) => {
            rowCounter++;
            row.querySelector('.row-number').textContent = rowCounter;
        });
    }

    // Update the crear_movimiento function to remove the tipo check
    function crear_salida() {
        var campos = $(".campos").serialize();
        console.log(campos);
        var div = document.getElementById("container");
        console.log(div);
        AJAXPOST(urlBase + "pages/salidas/ajax/guardar.php", campos, document.getElementById("pagina_central"));
    }
</script>