<!--formulario para actualizar la contraseña cuando este validado-->
<br>
<label for="clave">Nueva Contraseña</label>
<input type="password" name="clave" id="clave" class="form-control" placeholder="Contraseña" required>
<?php
$clave_nueva->mostrar_error_clave();
?>
<br>
<label for="clave2">Escribe de nuevo la contraseña</label>
<input type="password" name="clave2" id="clave2" class="form-control" placeholder="Contraseña escrita anteriormente" required>
<?php
$clave_nueva->mostrar_error_clave2();
?>
<br>
<button type="submit" name="guardar-clave" class="btn btn-lg btn-primary btn-block">
    Reemplazar Contraseña
</button>
