<!--formulario vacio para insertar una publicacion en la base de datos-->
<br>
<div class="form-group">
    <label for="titulo">TÍTULO</label>
    <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Escriba su título">
</div>
<div class="form-group">
    <label for="titulo">URL <a data-toggle="collapse" href="#inf_url"><i class="fas fa-info-circle"></i></a></label>
    <div id="inf_url" class="form-group collapse">
        <label>Esta URL es personalizable (La URL indica lo que se escribirá en la parte superior del navegador).</label>
    </div>
    <input type="text" class="form-control" id="url" name="url" placeholder="Escriba su dirección única sin espacios">
</div>
<div class="form-group">
    <label>Selecciona el tema de su publicación:</label>
    <br>
    <select name="tipo" style="font-size:15px; height: 35px;width: 100%;" id="tipo_entrada">
        <option selected value="General">GENERAL</option>
        <option value="informacion_industrial">INFORMACIÓN DE ENTRENAMIENTO INDUSTRIAL Y PASANTÍAS</option> 
        <option value="tramites_DACE">INFORMACIÓN Y TRÁMITES DACE</option> 
        <option value="servicio_comunitario">SERVICIO COMUNITARIO</option> 
        <option value="cultura">CULTURA</option> 
    </select>
</div>
<div class="form-group">
    <label for="texto">TEXTO</label>
    <textarea class="form-control" rows="10" id="texto" name="texto" placeholder="Escriba su contenido"></textarea>
</div>
<br>
<div class="text-center">
    <button type="submit" class="btn btn-success" name="guardar">Guardar Entrada</button>
    <br>
    <br>
</div>