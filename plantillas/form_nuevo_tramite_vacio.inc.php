<!--formulario vacio para insertar un tramite en la base de datos-->
<br>
<div class="form-group alert alert-info">
    <label>FECHA DE SOLICITUD: <?php
        date_default_timezone_set('America/Caracas');
        echo date("d") . " del " . date("m") . " de " . date("Y") . " a las " . date("g") . ": " . date("i") . ": " . date("s") . " " . date("A");
        ?></label>
</div>
<div class="form-group alert alert-info">
    <label>APELLIDO Y NOMBRE: <?php echo $usuario->obtener_apellido() ?> <?php echo $usuario->obtener_nombre() ?></label>
</div>
<div class="form-group alert alert-info">
    <label>CEDULA DE IDENTIDAD N°: <?php echo $usuario->obtener_cedula() ?></label>
</div>

<div class="form-group alert alert-info">
    <label>EXPEDIENTE N°: <?php echo $usuario->obtener_expediente() ?></label>
</div>

<div class="form-group">
    <div class="col-md-6">
        <label>Telf. Local: <input type="tel" name="telf_local" placeholder="(Código de área) Número"></label>
        <br>
    </div>
    <div class="col-md-6">
        <label>Telf. Cel: <input type="tel" name="telf_celular" placeholder="(Código de área) Número"></label> 
        <br>
    </div>
</div>


<label><br>Condicion del solicitante:</label>
<div class="text-center radio">

    <label class="radio-inline">
        <input type="radio" value="Bachiller Inactivo" name="condicion">Bachiller: Inactivo
    </label>
    <label class="radio-inline">
        <input type="radio" value="Egresado" name="condicion">Egresado <a data-toggle="collapse" href="#egresado"> <i class="far fa-caret-square-down"></i></a>
    </label>
    <label class="radio-inline">
        <input type="radio" value="Regular" name="condicion">Regular
    </label>
</div>
<br>
<br> 
<div id="egresado" class="form-group collapse">
    <label>Indique el N° de la promoción: <input type="number" min="0" max="99" class="form-control" name="promo" placeholder="18"></label>
    <label>Fecha de acto de grado: <input type="date" class="form-control" name="acto"></label> 
</div>
<div class="form-group">

</div>
<div class="row parte-gestor-entrada">
    <div class="col-md-6">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Solicitud EGRESADOS:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="text-justify checkbox">
                            <label class="checkbox-inline"> <input type="checkbox" value="Notas Certificadas" name="campos_solicitudes[]">Notas Certificadas</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Certificación de titulos" name="campos_solicitudes[]">Certificación de titulos</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Modalidad de estudios" name="campos_solicitudes[]">Modalidad de estudios</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Pensum" name="campos_solicitudes[]">Pensum</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de estudio (Egresado)" name="campos_solicitudes[]">Constancia de estudio</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Certificación de acta de grado" name="campos_solicitudes[]">Certificación de acta de grado</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Certiicacion y firmas de programas" name="campos_solicitudes[]">Certiicacion y firmas de programas</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de buena conducta (Egresado)" name="campos_solicitudes[]">Constancia de buena conducta</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="col-md-6">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Solicitud REGULARES:</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="text-justify checkbox">
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de estudio (Regular)" name="campos_solicitudes[]">Constancia de estudio</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de nota" name="campos_solicitudes[]">Constancia de nota</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Record de notas" name="campos_solicitudes[]">Record de notas</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de buena conducta (Regular)" name="campos_solicitudes[]">Constancia de buena conducta</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<br>

<div class="form-group">
    <label>OTRAS:</label>
    <textarea class="form-control" rows="2" id="otro_tramite" name="otro_tramite" placeholder="(1) INDIQUE, (2) INDIQUE, (3) INDIQUE,..."></textarea>
</div>


<br>
<br>
<div class="text-center">
    <button type="submit" class="btn btn-success" name="guardar_tramite">Enviar constancia(s)</button>
    <br>
    <br>
</div>
<br>

<div class="text-justify alert alert-warning">
    <label>Nota: Por resolucion N° 2011-11-00-B, acta N° 15-2011, de fecha 04 de Noviembre del 2011 del Consejo de Núcleo, Resuelve: "Aprobar que en cada semestre se entregue una(1)constancia de estudios, record de notas y constancias de notas por estudiantes inscritos, salvo las exepciones por casos médicos u otro que pueda evaluar el coordinador del departamento."</label>
</div>

<div class="text-justify alert alert-warning">
    <label>La presentación del número de referencia es indispensable para poder retirar los documentos solicitados.</label>
</div>