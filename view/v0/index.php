<!DOCTYPE html>
<html>
    <head>
        <title>Chat v0.5</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
        <script src="js/scriptV0.js" type="text/javascript"></script>
    </head>
    <body>
        <div class="grupoTitulo">Grupo test</div>
        <div>
            <textarea id="areaChat" class="areaChat" name="areaChat" rows="10" cols="50" readonly="readonly" disabled="disabled"></textarea>
            <br><input type="text" id="txtMsg" class="txtMsg" name="txtMsg" placeholder="Escreva..." />
            <input type="button" id="btnEnviar" class="btn" name="btnEnviar" value="Enviar" onclick="enviarMsg();"/>
            <input type="reset" class="btn" value="Últimas Mensagens" onclick="setAreaChatDown('areaChat')"/>
        </div>
    </body>
</html>