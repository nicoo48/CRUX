<?php
// Destruimos la sesión
session_destroy();

// En vez de un JSON, simplemente podemos retornar una cadena que indique éxito
echo 'success';
?>