<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
date_default_timezone_set('America/Sao_Paulo');
$thisPage = $_SERVER['PHP_SELF'];

require_once '../../php/Manipulador.php';
?> 

<html>
    <head>
        <title>Chat v0</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="js/script.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="grupoTitulo">Grupo test</div>
        <div>
            <textarea id="areaChat" name="areaChat" rows="10" cols="50" readonly="readonly" disabled="disabled"></textarea>
            <br>
            <input type="text" id="areaMsg" name="areaMsg" value="1"  />
            <input type="button" id="btnEnviar" name="btnEnviar" value="Enviar" onclick="enviarMsg()"/>
        </div>
    </body>
</html>
<?php
?>