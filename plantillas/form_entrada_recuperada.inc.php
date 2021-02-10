<!--formulario para actualizar una publicacion cuando no se hayan actualizados los campos aun-->
<br>
<input type="hidden" id="id_entrada" name="id_entrada" value="<?php echo $id_entrada; ?>">
<div class="form-group">
    <label for="titulo">TÍTULO</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Escriba su título" value="<?php echo $entrada_recuperada->obtener_titulo(); ?>">
    <input type="hidden" id="titulo_original" name="titulo_original" value="<?php echo $entrada_recuperada->obtener_titulo(); ?>"
</div>
<div class="form-group">
    <label for="titulo">URL</label>
    <input type="text" class="form-control" id="url" name="url" placeholder="Escriba su dirección única sin espacios" value="<?php echo $entrada_recuperada->obtener_url(); ?>">
    <input type="hidden" id="url_original" name="url_original" value="<?php echo $entrada_recuperada->obtener_url(); ?>"
</div>
<div class="form-group">
    <?php $tipo = $entrada_recuperada->obtener_tipo(); ?>
    <label>Selecciona el tema de su publicación:</label>
    <br>
    <select name="tipo" style="font-size:15px; height: 35px;width: 100%;" id="tipo_entrada">
        <option value="General" <?php
        if ($tipo = 'General') {
            echo "selected";
        }
        ?>>GENERAL</option>
        <option value="informacion_industrial" <?php
        if ($tipo = 'informacion_industrial') {
            echo "selected";
        }
        ?>>INFORMACIÓN DE ENTRENAMIENTO INDUSTRIAL Y PASANTÍAS</option> 
        <option value="tramites_DACE" <?php
        if ($tipo = 'tramites_DACE') {
            echo "selected";
        }
        ?>>INFORMACIÓN Y TRÁMITES DACE</option> 
        <option value="servicio_comunitario" <?php
        if ($tipo = 'servicio_comunitario') {
            echo "selected";
        }
        ?>>SERVICIO COMUNITARIO</option> 
        <option value="cultura" <?php
        if ($tipo = 'cultura') {
            echo "selected";
        }
        ?>>CULTURA</option> 
    </select>
</div>
<div class="form-group">
    <label for="texto">TEXTO</label>
    <textarea class="form-control" rows="10" id="texto" name="texto" placeholder="Escriba su contenido"><?php echo $entrada_recuperada->obtener_texto(); ?></textarea>
    <input type="hidden" id="texto_original" name="texto_original" value="<?php echo $entrada_recuperada->obtener_texto(); ?>"
</div>
<br>
<div class="text-center">
    <button type="submit" class="btn btn-success" name="guardar_cambios">Guardar cambios</button>
    <br>
    <br>
</div>
