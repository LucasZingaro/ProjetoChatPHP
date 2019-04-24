<?php

date_default_timezone_set('America/Sao_Paulo');

/**
 * Mensagem enviada de um usuário para um grupo
 *
 * @author Lucas Zingaro
 */
class Mensagem {

    private $conteudo;
    private $user;
    private $grupo;
    private $data;

    public function __construct($conteudo, $grupo = "Test", $user = "UserGhost", $data = "AUTO") {
        $this->setConteudo($conteudo);
        $this->setGrupo($grupo);
        $this->setUser($user);
        if ($data != "AUTO") {
            $this->setData($data);
        } else {
            $this->setData(date("d/m/Y - H:i:s"));
        }
    }

    public function getConteudo() {
        return $this->conteudo;
    }

    public function getUser() {
        return $this->user;
    }

    public function getGrupo() {
        return $this->grupo;
    }

    public function getData() {
        return $this->data;
    }

    public function setConteudo($msg) {
        $this->conteudo = $msg;
    }

    public function setUser($user) {
        $this->user = $user;
    }

    public function setGrupo($grupo) {
        $this->grupo = $grupo;
    }

    public function setData($data) {
        $this->data = $data;
    }

    public function __toString() {
        return "|" . $this->getUser() . " - " . $this->getData() . "| " . $this->getConteudo();
    }

}
