function alerta(message, type = 'info') {
    // Crea el contenedor principal de la alerta
    const alertBox = document.createElement('div');
    alertBox.className = `custom-alert ${type}`;
    alertBox.innerText = message;

    // Aplica estilos básicos al contenedor
    alertBox.style.position = 'fixed';
    alertBox.style.top = '5vh';  // Se ajusta 5% de la altura del viewport
    alertBox.style.left = '50%';
    alertBox.style.transform = 'translateX(-50%)';  // No movemos en Y, sólo centramos horizontalmente
    alertBox.style.padding = '15px 20px';
    alertBox.style.borderRadius = '5px';
    alertBox.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
    alertBox.style.zIndex = '9999';  // Aumentamos el z-index para asegurar visibilidad
    alertBox.style.color = '#fff';
    alertBox.style.fontSize = '14px';
    alertBox.style.fontFamily = 'Arial, sans-serif';
    alertBox.style.opacity = '0';
    alertBox.style.transition = 'all 0.5s ease-in-out';
    alertBox.style.maxWidth = '90vw';  // Asegura que la alerta no sobrepase la pantalla en pantallas pequeñas
    alertBox.style.wordWrap = 'break-word';  // Hace que el texto se ajuste dentro de la alerta si es largo
    alertBox.style.textAlign = 'center';  // Alinea el texto al centro

    // Estilos según el tipo de alerta
    switch(type) {
        case 'success':
            alertBox.style.backgroundColor = '#4CAF50';
            break;
        case 'error':
            alertBox.style.backgroundColor = '#f44336';
            break;
        case 'warning':
            alertBox.style.backgroundColor = '#ff9800';
            break;
        default:
            alertBox.style.backgroundColor = '#2196F3';
    }

    // Añade el contenedor al body
    document.body.appendChild(alertBox);

    // Animación de entrada
    setTimeout(() => {
        alertBox.style.opacity = '1';
    }, 1);

    // Inicia la animación de salida después de 2.5 segundos
    setTimeout(() => {
        alertBox.style.opacity = '0';
    }, 2500);

    // Elimina el contenedor después de que la animación termine
    setTimeout(() => {
        alertBox.remove();
    }, 3000);
}
