;
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * script v0
 */
//loop leitura
window.onload = function () {
    // set Enter == btnEnviar
    var input = document.getElementById("areaMsg");
    input.addEventListener("keyup", function (event) {
        if (event.keyCode === 13) {//13 is "Enter";
            event.preventDefault();
            document.getElementById("btnEnviar").click();
        }
    });
};

setTimeout(function sync() {
    syncMsgs();
    setTimeout(function () {
        sync();
    }, 500);
}, 500);


/** Se foi enviada alguma mensagem*/
let isLastMsg = false;
function syncMsgs(grupo = "Test") {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            //var myObj = JSON.parse(this.responseText);
            //document.getElementById("demo").innerHTML = myObj.name;
            //alert(this.responseText);
            let area = document.getElementById("areaChat");
            area.innerHTML = this.responseText;
            if (isLastMsg) {
                area.scrollTop = area.scrollHeight;
                isLastMsg = !isLastMsg;
            }

        }
    };
    xmlhttp.open("POST", "../../php/Operations.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("getTxtGrupo=" + grupo);
}

function enviarMsgs(grupo = "Test", msg = "msgdefault") {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "../../php/Operations.php?", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let PostStr = "addTxtGrupo=" + grupo;
    PostStr += "&addTxtMsg=" + msg;
    xmlhttp.send(PostStr);
    isLastMsg = true;
}

function enviarMsg() {
    let grupo = "Test";
    let msg = "\n" + document.getElementById("areaMsg").value;
    document.getElementById("areaMsg").value = "";
    enviarMsgs(grupo, msg);
}


