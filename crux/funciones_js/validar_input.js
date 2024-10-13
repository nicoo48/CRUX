function validar_input(input,mensaje){
    var input = document.getElementById(input);
    if(input.value == ""){
        alerta(mensaje,"error");
        input.focus();
        return false;
    }else{
        return true;
    }
}

function mostrar_error(campo, mensaje) {
    crear_mensaje_error(campo);   // Asegurarnos de que el span esté creado
    $("#" + campo).css("border", "2px solid red");  // Cambiar borde a rojo
    $("#error-" + campo).text(mensaje);             // Mostrar mensaje debajo del input
    $("#error-" + campo).addClass("text-danger");   // Agregar clase para color rojo
}

function limpiar_error(campo) {
    $("#" + campo).css("border", "2px solid green");  // Cambiar borde a verde
    $("#error-" + campo).text("");                   // Limpiar el mensaje de error
    $("#error-" + campo).removeClass("text-danger");  // Quitar clase de color rojo
}

function crear_mensaje_error(campo) {
    // Verificar si el span de error ya existe
    if ($("#error-" + campo).length === 0) {
        // Crear el span si no existe y añadirlo después del campo
        $("#" + campo).after('<span id="error-' + campo + '" class="text-danger"></span>');
    }
}

function validar_email(campo, mensaje) {
    var valor = $("#" + campo).val();
    var regex = /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-.]+$/;
    if (!regex.test(valor)) {
        mostrar_error(campo, mensaje);
        $("#" + campo).focus();
        return false;
    }
    limpiar_error(campo);  // Si es correcto, limpiar el error
    return true;
}

function validar_telefono(campo, mensaje) {
    var valor = $("#" + campo).val();
    var regex = /^\+?[0-9]{10,15}$/;  // Acepta entre 10 y 15 dígitos
    if (!regex.test(valor)) {
        mostrar_error(campo, mensaje);
        $("#" + campo).focus();
        return false;
    }
    limpiar_error(campo);  // Si es correcto, limpiar el error
    return true;
}

function validar_imagen(campo, mensaje) {
    var input = document.getElementById(campo);
    if (input.files && input.files[0]) {
        var file = input.files[0];
        var fileType = file.type;
        var fileSize = file.size;
        var allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!allowedTypes.includes(fileType)) {
            mostrar_error(campo, "Solo se permiten imágenes en formato JPEG, PNG o GIF.");
            return false;
        }

        if (fileSize > 2 * 1024 * 1024) { // Limite de 2MB
            mostrar_error(campo, "El tamaño de la imagen no puede exceder los 2MB.");
            return false;
        }
    }
    limpiar_error(campo);  // Si es correcto, limpiar el error
    return true;
}

function validar_contrasenia(id) {
    var input = document.getElementById(id);
    var valor = input.value;
    var nivelSeguridad = calcularSeguridad(valor);
    var mensaje;
    var color;
    var esValido = false; // Asumimos que no es válida al principio

    // Crear o seleccionar el span de mensaje
    var mensajeSpan = document.getElementById(id + "_mensaje");
    if (!mensajeSpan) {
        mensajeSpan = document.createElement("span");
        mensajeSpan.id = id + "_mensaje";
        input.parentNode.appendChild(mensajeSpan);
    }

    // Establecer el mensaje y el color según el nivel de seguridad
    switch (nivelSeguridad) {
        case 1:
            mensaje = "Seguridad baja";
            color = "red";
            esValido = false;
            break;
        case 2:
            mensaje = "Seguridad media";
            color = "orange";
            esValido = true; // Consideramos seguridad media aceptable
            break;
        case 3:
            mensaje = "Seguridad alta";
            color = "green";
            esValido = true;
            break;
        default:
            mensaje = "Contraseña muy débil";
            color = "red";
            esValido = false;
            break;
    }

    // Aplicar el mensaje y el color
    mensajeSpan.textContent = mensaje;
    mensajeSpan.style.color = color;

    // Cambiar el borde del input
    input.style.borderColor = color;

    // Retornar true si la contraseña es aceptable, false si no lo es
    return esValido;
}


function calcularSeguridad(contraseña) {
    var seguridad = 0;

    // Si la longitud es mayor o igual a 8
    if (contraseña.length >= 8) {
        seguridad++;
    }

    // Si tiene letras mayúsculas
    if (/[A-Z]/.test(contraseña)) {
        seguridad++;
    }

    // Si tiene letras minúsculas
    if (/[a-z]/.test(contraseña)) {
        seguridad++;
    }

    // Si tiene números
    if (/\d/.test(contraseña)) {
        seguridad++;
    }

    // Si tiene caracteres especiales
    if (/[\W_]/.test(contraseña)) {
        seguridad++;
    }

    // Devuelve el nivel de seguridad basado en la puntuación (puede ajustarse)
    if (seguridad <= 2) {
        return 1; // Seguridad baja
    } else if (seguridad === 3 || seguridad === 4) {
        return 2; // Seguridad media
    } else {
        return 3; // Seguridad alta
    }
}
