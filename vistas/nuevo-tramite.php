<?php
include_once 'app/ControlSesion.inc.php';
if (ControlSesion::sesion_iniciada()) {

    include_once 'app/config.inc.php';
    include_once 'app/Conexion.inc.php';
    include_once 'app/Tramite.inc.php';
    include_once 'app/Usuario.inc.php';
    include_once 'app/RepositorioTramite.inc.php';
    include_once 'app/RepositorioUsuario.inc.php';
    include_once 'app/ValidadorTramite.inc.php';
    include_once 'app/ControlSesion.inc.php';
    include_once 'app/Redireccion.inc.php';


    $solicitud1 = null;
    $solicitud2 = null;
    $solicitud3 = null;
    $solicitud4 = null;
    $solicitud5 = null;
    $solicitud6 = null;
    $solicitud7 = null;
    $solicitud8 = null;
    $solicitud9 = null;
    $solicitud10 = null;
    $solicitud11 = null;
    $solicitud12 = null;
    $solicitud13 = null;
    $condicion = null;

    $campos_solicitudes = array();


    Conexion::abrir_conexion();
    $usuario = RepositorioUsuario::obtener_usuario_por_id(Conexion::obtener_conexion(), $_SESSION['id_usuario']);

    if (isset($_POST['guardar_tramite'])) {

        if (isset($_POST['campos_solicitudes']) && !empty($_POST['campos_solicitudes'])) {
            if (in_array("Notas Certificadas", $_POST['campos_solicitudes'])) {
                $solicitud1 = "Notas Certificadas";
            }

            if (in_array("Certificación de titulos", $_POST['campos_solicitudes'])) {
                $solicitud2 = "Certificación de titulos";
            }

            if (in_array("Modalidad de estudios", $_POST['campos_solicitudes'])) {
                $solicitud3 = "Modalidad de estudios";
            }
            if (in_array("Pensum", $_POST['campos_solicitudes'])) {
                $solicitud4 = "Pensum";
            }
            if (in_array("Constancia de estudio (Egresado)", $_POST['campos_solicitudes'])) {
                $solicitud5 = "Constancia de estudio";
            }
            if (in_array("Constancia de estudio (Regular)", $_POST['campos_solicitudes'])) {
                $solicitud12 = "Constancia de estudio";
            }
            if (in_array("Certificación de acta de grado", $_POST['campos_solicitudes'])) {
                $solicitud6 = "Certificación de acta de grado";
            }
            if (in_array("Certiicacion y firmas de programas", $_POST['campos_solicitudes'])) {
                $solicitud7 = "Certiicacion y firmas de programas";
            }
            if (in_array("Constancia de buena conducta (Egresado)", $_POST['campos_solicitudes'])) {
                $solicitud8 = "Constancia de buena conducta";
            }
            if (in_array("Constancia de buena conducta (Regular)", $_POST['campos_solicitudes'])) {
                $solicitud13 = "Constancia de buena conducta";
            }
            if (in_array("Constancia de estudio", $_POST['campos_solicitudes'])) {
                $solicitud9 = "Constancia de estudio";
            }
            if (in_array("Constancia de nota", $_POST['campos_solicitudes'])) {
                $solicitud10 = "Constancia de nota";
            }
            if (in_array("Record de notas", $_POST['campos_solicitudes'])) {
                $solicitud11 = "Record de notas";
            }
        }

        if (isset($_POST['condicion']) && !empty($_POST['condicion'])) {
            switch ($_POST['condicion']) {
                case "Bachiller Inactivo":
                    $condicion = "Bachiller Inactivo";
                    break;
                case "Egresado":
                    $condicion = "Egresado";
                    break;
                case "Regular":
                    $condicion = "Regular";
                    break;
            }
        }


        Conexion :: abrir_conexion();

        $tramite_recuperado = new ValidadorTramite($_POST['telf_local'], $_POST['telf_celular'], $_POST['promo'], $_POST['acto'], htmlspecialchars($_POST['otro_tramite']));

        $tipo = $solicitud1 . " " . $solicitud2 . " " . $solicitud3 . " " . $solicitud4 . " " . $solicitud5 . " " . $solicitud6 . " " . $solicitud7 . " " . $solicitud8 . " " . $solicitud9 . " " . $solicitud10 . " " . $solicitud11 . " " . $solicitud12 . " " . $solicitud13 . " " . $tramite_recuperado->obtener_otro_tramite();

        if ($tramite_recuperado->tramite_valido() && isset($_POST['campos_solicitudes']) && !empty($_POST['campos_solicitudes']) && isset($_POST['condicion']) && !empty($_POST['condicion'])) {
            if (ControlSesion::sesion_iniciada()) {
                $n_referencia = rand(100, 10000000) . $usuario->obtener_id();
                $tramite = new Tramite('', $_SESSION['id_usuario'], $tipo, '', $n_referencia, 0);

                $tramite_insertado = RepositorioTramite::insertar_tramite(Conexion::obtener_conexion(), $tramite);
                if ($tramite_insertado) {
                    $destinatario = "torrealbamanuel2001@gmail.com";
                    $asunto = "Datos del trámite realizado en la UNEXPO";
                    $mensaje = "<h1><strong>Datos del trámite: </strong></h1><br/>";
                    $mensaje .= "<h3><strong>Número de Referencia: " . $n_referencia . "</strong></h3><br/>";
                    $mensaje .= "<p>Apellido y Nombre: " . $usuario->obtener_apellido() . " " . $usuario->obtener_nombre() . "<br/></p>";
                    $mensaje .= "<p>Cédula: " . $usuario->obtener_cedula() . "<br/></p>";
                    $mensaje .= "<p>Expediente: " . $usuario->obtener_expediente() . "<br/></p>";
                    $mensaje .= "<p>Télefono Local: " . $tramite_recuperado->obtener_telf_local() . "<br/></p>";
                    $mensaje .= "<p>Télefono Celular: " . $tramite_recuperado->obtener_telf_celular() . "<br/></p>";
                    $mensaje .= "<p>Condición del solicitante: " . $condicion . "<br/></p>";
                    $mensaje .= "<p>Número de Promoción: " . $tramite_recuperado->obtener_promo() . "<br/></p>";
                    $mensaje .= "<p>Fecha de acto de grado: " . $tramite_recuperado->obtener_acto() . "<br/></p>";
                    $mensaje .= "<p>Tipos de trámite a solicitar: " . $tipo . "<br/></p>";
                    $mensaje .= "<p>Otros trámites: " . $tramite_recuperado->obtener_otro_tramite() . "<br/></p>";
                    $encabezado = "Content-type: text/html; charset=UTF-8\r\n";
                    $encabezado .= "From: UNEXPONG <unexpong@gmail.com>\r\n";
                    $encabezado .= "Reply-To:  <unexpong@gmail.com>\r\n";

                    $exito = mail($destinatario, $asunto, $mensaje, $encabezado);


                    if ($exito) {
                        Redireccion::redirigir(RUTA_PETICION_VALIDA);
                    } else {
                        Redireccion::redirigir(RUTA_PETICION_FALLIDA);
                    }
                }
            } else {
                Redireccion::redirigir(RUTA_LOGIN);
            }
            Conexion::cerrar_conexion();
        }
    }

    $titulo = 'NUEVO TRAMITE';

    include_once 'plantillas/documento-apertura.inc.php';
    include_once 'plantillas/navbar.inc.php';
    ?>
    <head>
        <link rel="stylesheet" href="<?php echo RUTA_CSS ?>estilos.css" type="text/css">
    </head>

    <!--Vista para insertar una nueva publicacion en la pagina-->
    <div class="container">
        <div class="jumbotron">
            <div id="logo" class="col-sm-4 text-center">
                <img src="img/logounex.jpg" class="img-responsive" width="300" height="300">
            </div>
            <h4 class="text-center"> REPÚBLICA BOLIVARIANA DE VENEZUELA </h4>
            <h4 class="text-center"> UNIVERSIDAD NACIONAL EXPERIMENTAL POLITÉCNICA </h4>
            <h4 class="text-center"> "ANTONIO JODE DE SUCRE" </h4>
            <h4 class="text-center"> VICE-RECTORADO "LUIS CABALLERO MEJIAS" </h4>
            <h4 class="text-center"> NÚCLEO GUARENAS </h4>
            <h4 class="text-center"> DPTO. DE ADMISIÓN Y CONTROL DE ESTUDIOS </h4>
            <h3 class="text-center"> SOLICITUD DE CONSTANCIAS </h3>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6 text-center" id="nuevo-tramite">
                <form role="form" method="post" action="<?php echo RUTA_NUEVO_TRAMITE ?>">
                    <?php
                    if (isset($_POST['guardar_tramite'])) {
                        include_once 'plantillas/form_nuevo_tramite_validado.inc.php';
                    } else {
                        include_once 'plantillas/form_nuevo_tramite_vacio.inc.php';
                    }
                    ?>
                </form>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
    <br>
    <br>

    <?php
    include_once 'plantillas/documento-cierre.inc.php';
    ?>
    <?php
} else {

    include_once 'app/Conexion.inc.php';
    include_once 'app/RepositorioUsuario.inc.php';

    $titulo = 'INICIA SESIÓN CON ANTERIORIDAD';

    include_once 'plantillas/documento-apertura.inc.php';
    include_once 'plantillas/navbar.inc.php';
    include_once 'plantillas/inicia_sesion_antes.inc.php';
    include_once 'plantillas/documento-cierre.inc.php';
}
?>


