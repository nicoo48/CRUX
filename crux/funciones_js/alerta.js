function alerta(message, type = 'info') {
    // Crea el contenedor principal de la alerta
    const alertBox = document.createElement('div');
    alertBox.className = `custom-alert ${type}`;
    alertBox.innerText = message;
    
    // Aplica estilos básicos al contenedor
    alertBox.style.position = 'fixed';
    alertBox.style.top = '20px';
    alertBox.style.left = '50%';
    alertBox.style.transform = 'translateX(-50%)';
    alertBox.style.padding = '15px 20px';
    alertBox.style.borderRadius = '5px';
    alertBox.style.boxShadow = '0px 0px 10px rgba(0, 0, 0, 0.1)';
    alertBox.style.zIndex = '1000';
    alertBox.style.color = '#fff';
    alertBox.style.fontSize = '14px';
    alertBox.style.fontFamily = 'Arial, sans-serif';
    alertBox.style.opacity = '1';
    alertBox.style.transition = 'opacity 0.5s ease-in-out';

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

    // Desaparece la alerta después de 2.5 segundos
    setTimeout(() => {
        alertBox.style.opacity = '0';  // Aplica la animación de desvanecimiento
    }, 1000);

    // Elimina el contenedor después de que la animación termine (0.5s + 2.5s)
    setTimeout(() => {
        alertBox.remove();
    }, 1500);
}
