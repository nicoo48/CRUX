<script>
    function agregar_linea() {
        // Validar campos
        if (!validar_input("producto", "Debe ingresar un producto para Continuar.")) return;
        if (!validar_input("clase", "Debe ingresar la clase de venta.")) return;
        if (!validar_input("cantidad", "Debe ingresar una Cantidad.")) return;

        // Obtener valores del formulario
        const producto = document.getElementById('producto');
        const productoTexto = producto.options[producto.selectedIndex].text;
        const productoValor = producto.value;
        const clase = document.getElementById('clase');
        const claseTexto = clase.options[clase.selectedIndex].text;
        const claseValor = clase.value;
        const cantidad = document.getElementById('cantidad').value;
        const precio = document.getElementById('precio').value;
        const comentario = document.getElementById('comentario').value.trim();
        const total = cantidad * precio;
        //traemos el hidden para actualizarlo
        const oculto = document.getElementById('oculto');
        oculto.value = oculto.value + productoValor + "," + claseValor + "," + cantidad + "," + precio + "," + comentario + ";";


        // Ocultar mensaje de "Sin Productos" y mostrar la tabla
        $("#mensaje_sin_items").hide("fast");
        $("#tabla-detalle").show("fast");
        $("#boton_guardar").show("fast");

        // Obtener el tbody de la tabla
        const tbody = document.querySelector('#tabla-detalle tbody');

        // Crear nueva fila
        const tr = document.createElement('tr');
        tr.className = 'new-row';

        // Obtener el número de fila actual
        const rowNumber = tbody.children.length + 1;

        // Construir la fila con los datos
        tr.innerHTML = `
        <td>${productoTexto}</td>
        <td>${comentario}</td>
        <td>${claseTexto}</td>
        <td class="center">${cantidad}</td>
        <td class="center">${formatearMoneda(precio)}</td>
        <td class="center">${formatearMoneda(total)}</td>
        <td>
            <button class="btn btn-outline-danger btn-sm" onclick="eliminarFila(this)">
                <i class="bi bi-trash"></i>
            </button>
        </td>`;

        // Agregar la fila a la tabla
        tbody.appendChild(tr);

        // Activar la animación
        setTimeout(() => {
            tr.className = 'new-row visible';
        }, 50);

        // Limpiar el formulario
        document.getElementById('producto').selectedIndex = 0;
        document.getElementById('clase').selectedIndex = 0;
        document.getElementById('cantidad').value = '';
        document.getElementById('comentario').value = '';
        document.getElementById('precio').value = '';
        document.getElementById('total').value = '';
    }

    function eliminarFila(button) {
        const row = button.closest('tr');
        const tbody = document.querySelector('#tabla-detalle tbody');

        // Obtener los datos de la fila que se eliminará
        const productoTexto = row.cells[0].textContent;
        const comentario = row.cells[1].textContent;
        const cantidad = row.cells[2].textContent;
        const claseTexto = row.cells[3].textContent;

        // Obtener el campo oculto
        const oculto = document.getElementById('oculto');

        // Buscar el producto en el selector para obtener su valor
        const productoSelect = document.getElementById('producto');
        let productoValor = '';
        for (let i = 0; i < productoSelect.options.length; i++) {
            if (productoSelect.options[i].text === productoTexto) {
                productoValor = productoSelect.options[i].value;
                break;
            }
        }

        // Buscar la clase en el selector para obtener su valor
        const claseSelect = document.getElementById('clase');
        let claseValor = '';
        for (let i = 0; i < claseSelect.options.length; i++) {
            if (claseSelect.options[i].text === claseTexto) {
                claseValor = claseSelect.options[i].value;
                break;
            }
        }

        // Obtener el precio del elemento original
        const precio = document.getElementById('precio').value;

        // Crear el string que queremos eliminar del campo oculto
        const stringToRemove = productoValor + "," + claseValor + "," + cantidad + "," + precio + "," + comentario + ";";

        // Actualizar el valor del campo oculto
        oculto.value = oculto.value.replace(stringToRemove, '');

        // Animación de eliminación
        row.style.opacity = '0';
        row.style.transform = 'translateY(-20px)';

        setTimeout(() => {
            row.remove();

            // Si no hay más filas, mostrar el mensaje inicial y ocultar la tabla y el botón guardar
            if (tbody.children.length === 0) {
                $("#mensaje_sin_items").show("fast");
                $("#tabla-detalle").hide("fast");
                $("#boton_guardar").hide("fast");
            }
        }, 500);
    }

    function formatearMoneda(numero) {
        return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }

    function calcular_total() {
        // Obtener y validar cantidad
        var cantidad = document.getElementById('cantidad').value;
        cantidad = cantidad === "" ? 0 : parseFloat(cantidad);

        // Obtener y validar precio
        var precio = document.getElementById('precio').value;
        precio = precio === "" ? 0 : parseFloat(precio);

        // Calcular total
        var total = cantidad * precio;

        // Formatear y mostrar el total
        document.getElementById('total').value = formatearMoneda(total);
    }

    function preguardar() {
        // Eliminar la última coma del campo oculto
        const oculto = document.getElementById('oculto');
        if (oculto.value == "") {
            alerta("Debe ingresar al menos un producto para continuar", "warning");
            return;
        }
        abrir_modal("modConfirmar");
    }

    function guardar() {
        var oculto = document.getElementById('oculto').value;
        AJAXPOST(urlBase + "pages/movimientos/salidas/guardar_salida.php?datos=" + oculto, "", document.getElementById("pagina_central"));
    }
</script>