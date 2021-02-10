<?php
$titulo = "RECUPERAR CLAVE";

include_once 'plantillas/documento-apertura.inc.php';
include_once 'plantillas/navbar.inc.php';
?>
<!--Vista para solicitar el cambio de la contraseña de un usuario de la pagina-->
<br>
<div class="container">
    <div class="row">
        <div class="col-md-3">
        </div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading text-center">
                    <h4>Recuperación de contraseña</h4>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action=<?php echo RUTA_GENERAR_URL_SECRETA; ?>>
                        <h3 class="text-center">Introduce tu correo electrónico:</h3>
                        <br>
                        <label for="email" class="sr-only">Correo Electrónico</label>
                        <p>
                            Escribe la direccion de correo electronico con el cual te hayas registrado y a éste será enviado un mensaje con el que podrás restablecer tu contraseña.
                        </p>
                        <br>
                        <input type="email" name="email" id="email" class="form-control" placeholder="usuario@mail.com" 
                        <?php
                        if (isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])) {
                            echo 'value="' . $_POST['email'] . '"';
                        }
                        ?> 
                               required autofocus>
                        <br>
                        <br>
                        <br>
                        <button type="submit" name="enviar_email" class="btn btn-lg btn-primary btn-block">
                            Enviar
                        </button>
                    </form>
                    <br>
                </div>
            </div>
        </div>

    </div>
</div>

<?php
include_once 'plantillas/documento-cierre.inc.php';
?>
