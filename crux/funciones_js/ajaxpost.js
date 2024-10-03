function AJAXPOST(Pagina, Variables, Obj, MsjLoad, FuncionListo, FuncionCarga, Conexion) {
  if (MsjLoad == null || MsjLoad == false) {
    MsjLoad = "<center>Espere un momento...</center>";
  }

  document.body.style.cursor = "wait";
  $("a").css("cursor", "wait");
  $("#div_cargando").show("fast");
  var Conexion = crearXMLHttpRequest();
  Conexion.open("POST", Pagina, true);
  Conexion.setRequestHeader(
    "Content-Type",
    "application/x-www-form-urlencoded"
  );
  Conexion.send(Variables);

  Conexion.onreadystatechange = ProcesarCambioEstado;
  function ProcesarCambioEstado() {
    if (Conexion.readyState == 4) {
      if (Obj != false) {
        $(Obj).fadeOut("fast", function () {
          $(Obj).html(Conexion.responseText);
        });
        $(Obj).fadeIn("fast", function () {
          if (FuncionListo != null && FuncionListo != false) {
            x = FuncionListo;
            x(Conexion);
          } else {
            if (typeof carga_pagina == "function") carga_pagina();
          }
        });
      } else {
        if (FuncionListo != null) {
          x = FuncionListo;
          x(Conexion);
        }
      }
      $("#div_cargando").hide("fast");
      $("a").css("cursor", "pointer");
      document.body.style.cursor = "auto";
    } else {
      if (FuncionCarga != null) {
        x = FuncionCarga;
        x(Conexion);
      }
    }
  }
  return Conexion;
}

function crearXMLHttpRequest() {
  return window.XMLHttpRequest ? new XMLHttpRequest() : new ActiveXObject("Microsoft.XMLHTTP");
}

function simbolos(a) {
  return a.replace(/\+/g, "%2B").replace(/%u2013/g, "-");
}
