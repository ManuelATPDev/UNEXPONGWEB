<!--formulario validado para insertar un comentario en la base de datos-->
<div class="form-group">
    <input type="text" class="form-control" id="titulo_comentario" name="titulo_comentario" placeholder="Escriba su título" <?php $comentario_recuperado->mostrar_titulo_comentario() ?>> <?php $comentario_recuperado->mostrar_error_titulo_comentario(); ?>
</div>
<div class="form-group">
    <textarea class="form-control" rows="10" id="texto_comentario" name="texto_comentario" placeholder="Escriba su contenido" ><?php $comentario_recuperado->mostrar_texto_comentario() ?></textarea><?php $comentario_recuperado->mostrar_error_texto_comentario(); ?>
</div>
<br>
<div class="text-center">
    <button type="submit" class="btn btn-success" name="guardar_comentario">Publicar Comentario</button>
    <br>
    <br>
</div>
