<?php

require_once './Manipulador.php';
require_once './modelo/Mensagem.php';

/**
 * Classe de operações do chat v0.5
 *
 * @author Lucas Zingaro
 */
class Operations {

    /**
     * Pega todas as mensagens de um grupo.
     * 
     * @param string $grupo - Grupo.
     * @return string - Mensagens recuperadas.
     * @expectedException Exception caso não consiga recuperar as mensagens.
     */
    public static function getMsgsGrupo($grupo) {
        try {
            $mp = new Manipulador("./saves/Grupo", '' . $grupo, ".txt");
            if ($mp->recuperarArquivo(TRUE)) {
                return $mp->getConteudo(TRUE);
            } else {
                return "Grupo não encontrado!";
            }
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }

    /**
     * Sobreescreve todas as mensagens de um grupo.
     * 
     * @param string $msgs - Mensagens.
     * @param string $grupo - grupo.
     * @return bool TRUE - se as mensagens foram salvas com sucesso.
     * @expectedException Exception - Caso as mensagens não sejam salvas.
     */
    public static function setMsgsGrupo($msgs, $grupo) {
        try {
            $mp = new Manipulador("./saves/", "Grupo" . $grupo, ".txt");
            $mp->salvarArquivo($msgs);
            return TRUE;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
    }

    /**
     * Adiciona Mensagem ao Grupo.
     * 
     * @param string $msg - Mensagem.
     * @param string $grupo - Grupo.
     * @return bool TRUE - se adicionar a mensagem com sucesso.
     * @expectedException Exception - Caso não consiga adicionar a mensagem.
     */
    public static function addMsgGrupo($msg, $grupo) {
        try {
            $mp = new Manipulador("./saves/", "Grupo" . $grupo, ".txt");
            return $mp->adicionarAoArquivo("\n".$msg);
        } catch (Exception $exc) {
            return "Grupo não existe!";
        }
    }

    /**
     * Adiciona um objeto Mensagem em seu respectivo grupo
     * 
     * @param Mensagem $msgObj - Mensagem adicionada.
     * @return bool - Se a mensagem foi adcionada.
     * @expectedException Exception - Caso a mensagem não possa ser adicionada
     */
    public static function addMsgObj($msgObj) {
        try {
            $this->addMsgGrupo("\n" . $msgObj, $msg->getGrupo());
            return TRUE;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
        /* //Alternativo 
        try {
            $mp = new Manipulador("./saves/", "Grupo" . $msg->getGrupo(), ".txt");
            $mp->adicionarNoArquivo("\n" . $msgObj);
            return TRUE;
        } catch (Exception $exc) {
            return $exc->getMessage();
        }
         */
    }

}

/**
 * Tratamento de requisições por método POST
 */
if (isset($_POST['getTxtGrupo'])) {
    echo Operations::getMsgsGrupo($_POST['getTxtGrupo']);
    return;
} else if (isset($_POST['addTxtGrupo']) && isset($_POST['addTxtMsg'])) {
    echo Operations::addMsgGrupo($_POST['addTxtMsg'], $_POST['addTxtGrupo']);
    return;
} else if (isset($_POST['setTxtGrupo']) && isset($_POST['setTxtMsgs'])) {
    echo Operations::setMsgsGrupo($_POST['setTxtMsgs'], $_POST['setTxtGrupo']);
    return;
} else if (isset($_POST['addObjMsg'])) {
    $msg= unserialize($_POST['addObjMsg']);
    echo Operations::addMsgObj($msg);
    return;
} else {
    echo "Erro";
    return;
}