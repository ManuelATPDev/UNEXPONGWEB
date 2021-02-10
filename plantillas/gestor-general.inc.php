<!--vista del gestor generas de los datos obtenidos en la base de datos de la seccion de comentarios, entradas y tramites-->
<div class="row text-center">
    <div class="col-md-4 gg-elemento" id="gg-entradas">
        <h2><i class="fas fa-newspaper" aria-hidden="true"></i></h2>
        <h3>Entradas</h3>
        <hr style="border-color:white;">
        <h4><?php echo $cantidad_entradas_activas; ?></h4>
        <h5>Entradas publicadas</h5>
        <br>
        <h4><?php echo $cantidad_entradas_inactivas; ?></h4>
        <h5>Borradores</h5>
        <br>
    </div>
    <div class="col-md-4 gg-elemento" id="gg-comentarios">
        <h2><i class="fa fa-comments" aria-hidden="true"></i></h2>
        <h3>Comentarios</h3>
        <hr style="border-color:white;">
        <h4><?php echo $cantidad_comentarios; ?></h4>
        <h5>Comentarios escritos</h5>
        <br> 
    </div>
    <div class="col-md-4 gg-elemento" id="gg-tramites">
        <h2><i class="fa fa-file-archive" aria-hidden="true"></i></h2>
        <h3>Trámites</h3>
        <hr style="border-color:white;">
        <h4><?php echo $cantidad_tramites_activos; ?></h4>
        <h5>Trámites realizados</h5>
        <br>
        <h4><?php echo $cantidad_tramites_inactivos; ?></h4>
        <h5>Trámites en espera</h5>
        <br>
    </div>
</div>
