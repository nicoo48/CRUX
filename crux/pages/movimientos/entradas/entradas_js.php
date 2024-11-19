<script>
// Función para cargar el precio del producto
function cargarPrecioProducto() {
    const productoSelect = document.getElementById('producto');
    const productoId = productoSelect.value;
    
    if (productoId && productoPreciosMap[productoId]) {
        const precio = productoPreciosMap[productoId];
        document.getElementById('precio').value = precio;
        document.getElementById('precio_display').value = formatearMoneda(precio);
        calcular_total();
    } else {
        document.getElementById('precio').value = '';
        document.getElementById('precio_display').value = '';
        document.getElementById('total').value = '';
    }
}

function calcular_total() {
    var cantidad = document.getElementById('cantidad').value;
    cantidad = cantidad === "" ? 0 : parseFloat(cantidad);

    var precio = document.getElementById('precio').value;
    precio = precio === "" ? 0 : parseFloat(precio);

    var total = cantidad * precio;
    document.getElementById('total').value = formatearMoneda(total);
}

function formatearMoneda(numero) {
    return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function agregar_linea() {
    if (!validar_input("producto", "Debe ingresar un producto para Continuar.")) return;
    if (!validar_input("clase", "Debe ingresar la clase de venta.")) return;
    if (!validar_input("cantidad", "Debe ingresar una Cantidad.")) return;

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

    const oculto = document.getElementById('oculto');
    oculto.value = oculto.value + productoValor + "," + claseValor + "," + cantidad + "," + precio + "," + comentario + ";";

    $("#mensaje_sin_items").hide("fast");
    $("#tabla-detalle").show("fast");
    $("#boton_guardar").show("fast");

    const tbody = document.querySelector('#tabla-detalle tbody');
    const tr = document.createElement('tr');
    tr.className = 'new-row';

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

    tbody.appendChild(tr);

    setTimeout(() => {
        tr.className = 'new-row visible';
    }, 50);

    document.getElementById('producto').selectedIndex = 0;
    document.getElementById('clase').selectedIndex = 0;
    document.getElementById('cantidad').value = '';
    document.getElementById('comentario').value = '';
    document.getElementById('precio').value = '';
    document.getElementById('precio_display').value = '';
    document.getElementById('total').value = '';
}

function eliminarFila(button) {
    const row = button.closest('tr');
    const tbody = document.querySelector('#tabla-detalle tbody');

    const productoTexto = row.cells[0].textContent;
    const comentario = row.cells[1].textContent;
    const cantidad = row.cells[3].textContent;
    const precio = row.cells[4].textContent.replace(/\./g, '');
    
    const productoSelect = document.getElementById('producto');
    let productoValor = '';
    for (let i = 0; i < productoSelect.options.length; i++) {
        if (productoSelect.options[i].text === productoTexto) {
            productoValor = productoSelect.options[i].value;
            break;
        }
    }

    const claseSelect = document.getElementById('clase');
    let claseValor = '';
    for (let i = 0; i < claseSelect.options.length; i++) {
        if (claseSelect.options[i].text === row.cells[2].textContent) {
            claseValor = claseSelect.options[i].value;
            break;
        }
    }

    const stringToRemove = productoValor + "," + claseValor + "," + cantidad + "," + precio + "," + comentario + ";";
    const oculto = document.getElementById('oculto');
    oculto.value = oculto.value.replace(stringToRemove, '');

    row.style.opacity = '0';
    row.style.transform = 'translateY(-20px)';

    setTimeout(() => {
        row.remove();
        if (tbody.children.length === 0) {
            $("#mensaje_sin_items").show("fast");
            $("#tabla-detalle").hide("fast");
            $("#boton_guardar").hide("fast");
        }
    }, 500);
}

function preguardar() {
    const oculto = document.getElementById('oculto');
    if (oculto.value == "") {
        alerta("Debe ingresar al menos un producto para continuar", "warning");
        return;
    }
    abrir_modal("modConfirmar");
}

function guardar() {
    var oculto = document.getElementById('oculto').value;
    AJAXPOST(urlBase + "pages/movimientos/entradas/guardar_entrada.php?datos=" + oculto, "", document.getElementById("pagina_central"));
}

// Asegurarse de que el selector tenga el evento change
document.addEventListener('DOMContentLoaded', function() {
    const productoSelect = document.getElementById('producto');
    if (productoSelect) {
        productoSelect.addEventListener('change', cargarPrecioProducto);
    }
});
</script>