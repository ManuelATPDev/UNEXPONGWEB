<!--formulario vacio para insertar usuarios en la base de datos-->
<div class="form-group">
    <label>Nombre</label>
    <input type="text" class="form-control" name="nombre" placeholder="Stefany" >
</div>
<div class="form-group">
    <label>Apellido</label>
    <input type="text" class="form-control" name="apellido" placeholder="Torrealba" >
</div>
<div class="form-group">
    <label>Cédula</label>
    <input type="number" min="0" max="999999999" class="form-control" name="cedula" placeholder="12345678">
</div>
<div class="form-group">
    <label>Expediente</label>
    <input type="number" min="0" max="9999999999" class="form-control" name="expediente" placeholder="1234567890">
</div>
<div class="form-group">
    <label>Especialidad</label>
    <br>
    <select name="especialidad" style="font-size:15px; height: 35px;width: 100%;">
        <option selected value="Mecatrónica">Mecatrónica</option> 
        <option value="Industrial">Industrial</option> 
        <option value="Mecánica">Mecánica</option> 
        <option value="Sistemas">Sistemas</option> 
        <option value="TSU Mecánica">TSU Mecánica</option>
    </select>

</div>
<div class="form-group">
    <label>Correo Electrónico</label>
    <input type="email" class="form-control" name="email" placeholder="usuario@mail.com">
</div>
<div class="form-group">
    <label>Contraseña</label>
    <input type="password" class="form-control" name="clave" placeholder="Contraseña">
</div>
<div class="form-group">
    <label>Repite la contraseña</label>
    <input type="password" class="form-control" name="clave2" placeholder="Contraseña anterior">
</div>
<br>
<button type="reset" class="btn btn-default btn-primary">Resetear el formulario </button>
&nbsp;
<button type="submit" class="btn btn-default btn-primary" name="enviar" onclick="<?php echo "Hola"; ?>">Unirse a la UNEXPO</button>

