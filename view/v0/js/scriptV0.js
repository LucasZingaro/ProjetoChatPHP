
/* 
 * script v0.5
 */

/*Loop de leitura*/
window.onload = function () {
    // set Enter == btnEnviar
    try {
        let input = document.getElementById('txtMsg');
        if (input !== null) {
            input.addEventListener('keyup', function (event) {
                if (event.keyCode === 13) {//13 é o botão 'Enter';
                    event.preventDefault();
                    document.getElementById('btnEnviar').click();
                }
            });
        }
    } catch (error) {
        console.log(error);
    }
};

/*Loop de sincronização*/
setTimeout(function sync() {
    syncMsgs();
    setTimeout(function () {
        sync();
    }, 750);
}, 500);


/**
 * Se foi enviada alguma mensagem
 * @type Boolean
 */
let isLastMsg = false;

/**
 * Sincroniza as mensagens de um grupo com uma textArea
 * 
 * @param {string} grupo - Nome do grupo desejado
 * @param {string} areaChatID - Id da Area que receberá as mensagens
 */
function syncMsgs(grupo = 'Test', areaChatID = 'areaChat') {
    try {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let area = document.getElementById(areaChatID);
                area.innerHTML = this.responseText;
                if (isLastMsg) {
                    setAreaChatDown(areaChatID);
                    isLastMsg = !isLastMsg;
                }

            }
        };
        xmlhttp.open('POST', '../../php/Operations.php', true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.send('getTxtGrupo=' + grupo);
    } catch (error) {
        console.log(error);
    }
}

/**
 * Envia a mensagem para ser adicionada ao grupo por requisição Ajax
 * 
 * @param {string} msg - Mensagem enviada
 * @param {string} grupo - Nome do grupo
 */
function enviarAddMsgs(msg, grupo = 'Test') {
    try {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open('POST', '../../php/Operations.php?', true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                resposta = this.responseText;
                if (resposta != true) {
                    alert(resposta);
                }
            }
        };
        let PostStr = 'addTxtGrupo=' + grupo + '&addTxtMsg=' + msg;
        xmlhttp.send(PostStr);
    } catch (error) {
        console.log(error);
    }
}

/**
 * Envia mensagem Para o grupo
 * 
 * @param {string} grupo - Nome do Grupo
 */
function enviarMsg(grupo = 'Test') {
    try {
        let msg = document.getElementById('txtMsg').value;
        document.getElementById('txtMsg').value = '';
        enviarAddMsgs(msg, grupo);
        isLastMsg = true;
    } catch (error) {
        console.log(error);
    }
}

/**
 * Envia Alterações das mensagens de um grupo
 * 
 * @param {string} msgs - Mensagens Alteradas 
 * @param {string} grupo - Nome do grupo
 */
function enviarAlterMsgs(msgs, grupo = 'Test') {
    try {
        let xmlhttp = new XMLHttpRequest();
        xmlhttp.open('POST', '../../php/Operations.php?', true);
        xmlhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xmlhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                resposta = this.responseText;
                if (resposta != true) {
                    alert(resposta);
                }
            }
        };
        let PostStr = 'setTxtGrupo=' + grupo;
        PostStr += '&setTxtMsgs=' + msgs;
        xmlhttp.send(PostStr);
    } catch (error) {
        console.log(error);
    }

}

/**
 * Altera todas as mensagem de um grupo
 * 
 * @param {string} grupo - Nome do grupo
 */
function alterarMsgs(grupo = 'Test') {
    try {
        let msgs = document.getElementById('areaChat').value;
        enviarAlterMsgs(msgs, grupo);
        isLastMsg = true;
    } catch (error) {
        console.log(error);
    }
}

/**
 * Define a posição do scroll para baixo
 * 
 * @param {string} areaId - Id da area no HTML
 */
function setAreaChatDown(areaId = 'areaChat') {
    area = document.getElementById(areaId);
    area.scrollTop = area.scrollHeight;
}