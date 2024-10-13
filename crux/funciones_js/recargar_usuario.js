function recargar_usuario(numero){
    console.log("recargando")
    var div = document.getElementById('componente_usuario');
    AJAXPOST(urlBase +"componentes/navbar/user.php?veces="+numero,"",div);
}