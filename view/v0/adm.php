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
            <form>
                <textarea id="areaChat" class="areaChat" rows="10" cols="50"   ></textarea><br>
                <input type="reset" id="btnAlterar" class="btn" value="Alterar" onclick="alterarMsgs();"/>
                <input type="reset" class="btn" value="Últimas Mensagens" onclick="setAreaChatDown()"/>
            </form>
        </div>
    </body>
</html>