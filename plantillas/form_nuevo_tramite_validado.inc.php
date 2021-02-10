<!--formulario validado para insertar un comentario en la base de datos-->
<br>
<?php
if (!($tramite_recuperado->tramite_valido() && isset($_POST['campos_solicitudes']) && !empty($_POST['campos_solicitudes']) && isset($_POST['condicion']) && !empty($_POST['condicion']))) {
    echo "<div class='alert alert-danger' role='alert'>Ha ocurrio un error, revise atentamente todos los campos.</div>";
}
?>
<div class="form-group alert alert-info">
    <label>FECHA DE SOLICITUD: <?php
        date_default_timezone_set('America/Caracas');
        echo date("d") . " del " . date("m") . " de " . date("Y") . " a las " . date("g") . ": " . date("i") . ": " . date("s") . " " . date("A");
        ?></label>
</div>
<?php ?>
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
        <label>Telf. Local: <input type="tel" name="telf_local" placeholder="(Código de área) Número" <?php $tramite_recuperado->mostrar_telf_local() ?>></label><?php $tramite_recuperado->mostrar_error_telf_local(); ?>
        <br>
    </div>
    <div class="col-md-6">
        <label>Telf. Cel: <input type="tel" name="telf_celular" placeholder="(Código de área) Número" <?php $tramite_recuperado->mostrar_telf_celular() ?>></label><?php $tramite_recuperado->mostrar_error_telf_celular(); ?>
        <br>
    </div>
</div>


<label><br>Condicion del solicitante:</label>
<div class="text-center">
    <label class="radio-inline">
        <input type="radio" value="Bachiller Inactivo" name="condicion" 
        <?php
        if (isset($_POST['guardar_tramite']) && isset($condicion) && $condicion == 'Bachiller Inactivo') {
            echo 'checked';
        }
        ?>>Bachiller: Inactivo
    </label>

    <label class="radio-inline">
        <input type="radio" value="Egresado" name="condicion" 
        <?php
        if (isset($_POST['guardar_tramite']) && isset($condicion) && $condicion == 'Egresado') {
            echo 'checked';
        }
        ?>>Egresado <a data-toggle="collapse" href="#egresado"> <i class="far fa-caret-square-down"></i></a>
    </label>
    <label class="radio-inline">
        <input type="radio" value="Regular" name="condicion"  
        <?php
        if (isset($_POST['guardar_tramite']) && isset($condicion) && $condicion == 'Regular') {
            echo 'checked';
        }
        ?>>Regular
    </label>
    <?php
    if ($condicion == "") {
        ?>
        <br>
        <div class='alert alert-danger' role='alert'>Ha ocurrio un error, debe seleccionar al menos una (1) condición.</div>
        <?php
    }
    ?>
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
                        <div class="text-justify">
                            <label class="checkbox-inline"> <input type="checkbox" value="Notas Certificadas" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud1) {
                                        echo "checked";
                                    }
                                }
                                ?>
                                                                   >Notas Certificadas</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Certificación de titulos" name="campos_solicitudes[]"
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud2) {
                                        echo "checked";
                                    }
                                }
                                ?>
                                                                   >Certificación de titulos</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Modalidad de estudios" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud3) {
                                        echo "checked";
                                    }
                                }
                                ?>>Modalidad de estudios</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Pensum" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud4) {
                                        echo "checked";
                                    }
                                }
                                ?>>Pensum</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de estudio (Egresado)" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud5) {
                                        echo "checked";
                                    }
                                }
                                ?>>Constancia de estudio</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Certificación de acta de grado" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud6) {
                                        echo "checked";
                                    }
                                }
                                ?>>Certificación de acta de grado</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Certiicacion y firmas de programas" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud7) {
                                        echo "checked";
                                    }
                                }
                                ?>>Certiicacion y firmas de programas</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de buena conducta (Egresado)" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud8) {
                                        echo "checked";
                                    }
                                }
                                ?>>Constancia de buena conducta</label>
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
                        <div class="text-justify">
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de estudio (Regular)" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud12) {
                                        echo "checked";
                                    }
                                }
                                ?>>Constancia de estudio</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de nota" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud10) {
                                        echo "checked";
                                    }
                                }
                                ?>>Constancia de nota</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Record de notas" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud11) {
                                        echo "checked";
                                    }
                                }
                                ?>>Record de notas</label>
                            <br>
                            <br>
                            <label class="checkbox-inline"> <input type="checkbox" value="Constancia de buena conducta (Regular)" name="campos_solicitudes[]" 
                                <?php
                                if (isset($_POST['guardar_tramite'])) {
                                    if ($solicitud13) {
                                        echo "checked";
                                    }
                                }
                                ?>>Constancia de buena conducta</label>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php
if (empty($_POST['campos_solicitudes'])) {
    ?>
    <br><div class='alert alert-danger' role='alert'>Ha ocurrio un error, debe seleccionar al menos una (1) constancia que realizar.</div>
    <?php
}
?>
<br>

<div class="form-group">
    <label>OTRAS:</label>
    <textarea class="form-control" rows="2" id="otro_tramite" name="otro_tramite" placeholder="(1) INDIQUE, (2) INDIQUE, (3) INDIQUE,..."><?php $tramite_recuperado->mostrar_otro_tramite() ?></textarea><?php $tramite_recuperado->mostrar_error_otro_tramite(); ?>
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