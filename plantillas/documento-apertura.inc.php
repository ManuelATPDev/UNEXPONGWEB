<!--UNEXPONGWEB
CREADO POR MANUEL TORREALBA Y STEFANY VILLAMIZAR ESTUDIANTES DE INGENIERIA MECATRONICA EN LA 
UNIVERSIDAD NACIONAL POLITECNICA "ANTONIO JOSE DE SUCRE" VICE-RECTORADO "LUIS CABALLERO MEJIAS" NUCLEO GUARENAS
VERSION DE NETBEANS IDE 11.0-->

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php
        if (!isset($titulo) || empty($titulo)) {
            $titulo = 'UNEXPO Núcleo Guarenas';
        }
        echo "<title>$titulo</title>";
        ?>

        <link rel="shortcut icon" href="<?php echo RUTA_ICO ?>">

        <link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="<?php echo RUTA_CSS ?>estilos.css" type="text/css">

        <link rel="stylesheet" href="<?php echo RUTA_FONT ?>all.css">


    </head>
    <body>