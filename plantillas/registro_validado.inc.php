<!--formulario validado para insertar usuarios en la base de datos-->
<div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" placeholder="Leunam" <?php $entrada_recuperada->mostrar_nombre() ?>>
    <?php
    $entrada_recuperada->mostrar_error_nombre();
    ?>
</div>
<div class="form-group">
    <label>Apellido</label>
    <input type="text" class="form-control" name="apellido" placeholder="Torrealba" <?php $entrada_recuperada->mostrar_apellido() ?>>
    <?php
    $entrada_recuperada->mostrar_error_apellido();
    ?>
</div>
<div class="form-group">
    <label>Cédula</label>
    <input type="number" min="0" max="999999999" class="form-control" name="cedula" placeholder="12345678" <?php $entrada_recuperada->mostrar_cedula() ?>>
    <?php
    $entrada_recuperada->mostrar_error_cedula();
    ?>
</div>
<div class="form-group">
    <label>Expediente</label>
    <input type="number" min="0" max="9999999999" class="form-control" name="expediente" placeholder="1234567890" <?php $entrada_recuperada->mostrar_expediente() ?>>
    <?php
    $entrada_recuperada->mostrar_error_expediente();
    ?>
</div>
<div class="form-group">
    <label>Especialidad</label>
    <br>
    <select name="especialidad" style="font-size:15px; height: 35px;width: 100%;">
        <option value="Mecatrónica" <?php
        if (isset($_POST['enviar'])) {
            if ($tipo1) {
                echo "selected";
            }
        }
        ?>>Mecatrónica</option> 
        <option value="Industrial" <?php
        if (isset($_POST['enviar'])) {
            if ($tipo2) {
                echo "selected";
            }
        }
        ?>>Industrial</option> 
        <option value="Mecánica" <?php
        if (isset($_POST['enviar'])) {
            if ($tipo3) {
                echo "selected";
            }
        }
        ?>>Mecánica</option> 
        <option value="Sistemas" <?php
        if (isset($_POST['enviar'])) {
            if ($tipo4) {
                echo "selected";
            }
        }
        ?>>Sistemas</option> 
        <option value="TSU Mecánica" <?php
        if (isset($_POST['enviar'])) {
            if ($tipo5) {
                echo "selected";
            }
        }
        ?>>TSU Mecánica</option>
    </select>
</div>
<div class="form-group">
    <label>Correo Electrónico</label>
    <input type="email" class="form-control" name="email" placeholder="usuario@mail.com" <?php $entrada_recuperada->mostrar_email() ?>>
    <?php
    $entrada_recuperada->mostrar_error_email();
    ?>
</div>
<div class="form-group">
    <label>Contraseña</label>
    <input type="password" class="form-control" name="clave" placeholder="Contraseña">
    <?php
    $entrada_recuperada->mostrar_error_clave();
    ?>
</div>
<div class="form-group">
    <label>Repite la contraseña</label>
    <input type="password" class="form-control" name="clave2" placeholder="Contraseña Anterior">
    <?php
    $entrada_recuperada->mostrar_error_clave2();
    ?>
</div>
<br>
<button type="reset" class="btn btn-default btn-primary">Resetear el formulario</button>
<button type="submit" class="btn btn-default btn-primary" name="enviar">Unirse a la UNEXPO</button>

