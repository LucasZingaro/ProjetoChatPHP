<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManipuladorJson
 *
 * @author Lucas
 */
require_once './Manipulador.php';


class Operations {

    public static function getMsgsGrupo($grupoNome) {
        $grupoNome = $_POST['getTxtGrupo'];
        $mp = new Manipulador("./saves/Grupo", $grupoNome, ".txt");
        echo "\n" . $mp->RecuperarArquivo();
        return;
    }

    public static function adicionarMsgGrupo($msg, $grupo) {
        $mp = new Manipulador("./saves/Grupo", $grupo, ".txt");
        $mp->adicionarNoArquivo($msg);
        return;
    }

}

if (isset($_POST['getTxtGrupo'])) {
    return Operations::getMsgsGrupo($_POST['getTxtGrupo']);
}
if (isset($_POST['addTxtGrupo']) && isset($_POST['addTxtMsg'])) {
    return Operations::adicionarMsgGrupo($_POST['addTxtMsg'], $_POST['addTxtGrupo']);
}