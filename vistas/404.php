<!--Vista de la pagina por si no se encuentra la pagina solicitada-->
<?php
header($_SERVER['SERVER_PROTOCOL'] . "404 Not Found", true, 404);
echo 'La página no existe';
