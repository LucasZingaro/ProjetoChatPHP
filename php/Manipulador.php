<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * A classe responsavél por manipular a leitura e gravção todo e qualquer arquivo .txt
 *
 * @author Lucas
 */
class Manipulador {

    private $file = "./saves/";
    private $conteudo = "";

    /**
     * Contrutor da classe Manipulador
     */
    public function Manipulador($caminho = "./saves/", $nome = "", $extensao = "") {
        $this->file = $caminho . $nome . $extensao;
    }

    /**
     * Verifica se o arquivo manipulado existe
     */
    public function isExists() {
        return file_exists($this->file);
    }

    /**
     * Verifica se o arquivo manipulado é realmente um arquivo
     */
    public function isfile() {
        return is_file($this->file);
    }

    /**
     * Verifica se o arquivo manipulado é um diretório
     */
    public function isDir() {
        return is_dir($this->file);
    }
    
    /**
     * Pega o caminho completo do arquivo
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * Define conteudo do arquivo
     */
    public function setConteudo($str) {
        return $this->conteudo = $str;
    }

    /**
     * Pega o conteudo do arquivo
     */
    public function getConteudo() {
        return $this->conteudo;
    }
    
    /**
     * Salva qualquer conteudo em qualquer arquivo, segundo seu modo de acesso.
     */
    public static function salvarArquivoXYZ($file, $conteudo, $mode = "w") {
        if (!file_exists($file) || !is_file($file)) {
            return;
        }
        try {
            $fp = fopen($file, $mode); // abre o arquivo
            fwrite($fp, $conteudo); // grava no arquivo. Se o arquivo não existir ele será criado
            fclose($fp);
            return $conteudo;
        } catch (Exception $e) {
            return "Erro ao salvar: $e";
        }
    }
    
    /**
     * Salva o conteudo no arquivo, segundo seu modo de acesso.
     */
    public function salvarArquivoMode($conteudo = NULL, $mode = "w") {
        if ($conteudo != NULL) {
            $this->setConteudo($conteudo);
        }
        return $this->salvarArquivoXYZ($this->getFile(), $this->getConteudo(), $mode);
    }
    
    /**
     * Adiciona o conteudo ao arquivo
     */
    public function adicionarNoArquivo($addStr) {
        return $this->salvarArquivoMode($addStr, "a");
    }
    
    /**
     * Salva o conteudo, sobreescrevendo o anterior.
     */
    public function salvarArquivo($newStrTxt = NULL) {
        return $this->salvarArquivo($newStrTxt, "w");
    }

    public static function RecuperarArquivoXYZ($file) {
        if (file_exists($file) && is_file($file)) {
            try {
                $fp = fopen($file, "r");
                $char = "";
                while (!feof($fp)) {
                    try {
                        $char .= fgetc($fp);
                    } catch (Exception $exc) {
                        break;
                    }
                }
                fclose($fp);
                return ($char);
            } catch (Exception $e) {
                return "ERRO:RecuperarArquivo(): $e";
            }
        } else {
            return "Nenhum Arquivo encontrado";
        }
    }

    public function RecuperarArquivo() {
        if (file_exists($this->getFile())) {
            try {
                $fp = fopen($this->getFile(), "r");
                $char = "";
                while (!feof($fp)) {
                    try {
                        $char .= fgetc($fp);
                    } catch (Exception $exc) {
                        break;
                    }
                }
                fclose($fp);
                return utf8_encode($char);
            } catch (Exception $e) {
                return "ERRO:RecuperarArquivo(): $e";
            }
        } else {
            return "Nenhum Arquivo encontrado";
        }
    }

}
