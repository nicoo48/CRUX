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