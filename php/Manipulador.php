<?php

/**
 * Classe responsável por manipular a leitura e gravação de todo e qualquer arquivo (em modo de texto)
 *
 * @author Lucas Zingaro
 */
class Manipulador {

    private $file = "./saves/";
    private $conteudo;

    /**
     * Construtor da classe Manipulador
     *
     * @param string $caminho - Caminho de acesso ao arquivo
     * @param string $nome - Nome do arquivo
     * @param string $extensao - Extensão do Arquivo
     */
    public function __construct(string $caminho = "./saves/", string $nome = "", string $extensao = "") {
        $this->file = $caminho . $nome . $extensao;
    }

    /**
     * Verifica se o arquivo manipulado existe
     * @return bool
     */
    public function isExists(): bool {
        return file_exists($this->file);
    }

    /**
     * Verifica se o arquivo manipulado é realmente um arquivo
     * @return bool
     */
    public function isfile(): bool {
        return is_file($this->file);
    }

    /**
     * Verifica se o arquivo manipulado é um diretório
     * @return bool
     */
    public function isDir(): bool {
        return is_dir($this->file);
    }

    /**
     * Pega o caminho completo do arquivo
     * @return string - Caminho do arquivo
     */
    public function getFile(): string {
        return $this->file;
    }

    /**
     * Define conteúdo do arquivo
     *
     * @param string $str
     * @param bool $encodeUTF8 - define se codifica para UTF-8
     */
    public function setConteudo(string $str, bool $encodeUTF8 = FALSE) {
        if ($encodeUTF8) {
            $this->conteudo = utf8_encode($str);
        } else {
            $this->conteudo = $str;
        }
    }

    /**
     * Pega o conteúdo do arquivo
     *
     * @param bool $decodeUTF8 - define se decodifica de UTF-8
     * @return string - conteúdo
     */
    public function getConteudo(bool $decodeUTF8 = FALSE): string {
        if ($decodeUTF8) {
            return utf8_decode($this->conteudo);
        } else {
            return $this->conteudo;
        }
    }

    /**
     * Salva qualquer conteúdo em qualquer arquivo, segundo seu modo de acesso.
     * 
     * @param string $file - Caminho do arquivo.
     * @param string $conteudo - Conteúdo manipulado.
     * @param string $mode - define o modo de abertura do arquivo.
     * @return bool - Se o arquivo foi salvo.
     * @expectedException Exception - Caso não consiga salvar.
     * @expectedExceptionMessage Não é um arquivo válido.
     * @expectedExceptionMessage Erro ao salvar.
     */
    public static function salvarArquivoXYZ($file, $conteudo, $mode = "w") {
        if (!is_file($file)) {
            throw new Exception("Não é um arquivo válido");
        }
        try {
            $fileOp = fopen($file, $mode); // Abre o arquivo.
            fwrite($fileOp, $conteudo); // Grava no arquivo. Se o arquivo não existir ele será criado.
            return TRUE;
        } catch (Exception $exc) {
            throw new Exception("Erro ao salvar! : " . $exc->getMessage());
        } finally {
            fclose($fileOp); //Fecha o arquivo.
        }
    }

    /**
     * Salva o conteúdo no arquivo, segundo seu modo de acesso.
     * 
     * @param string $conteudo - conteúdo manipulado.
     * @param string $mode - define o modo de abertura do arquivo.
     * @return bool - Se o arquivo foi salvo.
     * @expectedException Exception - Caso não consiga salvar.
     * @expectedExceptionMessage Não é um arquivo válido.
     * @expectedExceptionMessage Erro ao salvar.
     */
    public function salvarArquivo($conteudo = "AUTO", $mode = "w") {
        if (!$this->isfile()) {
            throw new Exception("Não é um arquivo válido : ".$this->file);
        }
        if ($conteudo != "AUTO") {
            $this->setConteudo($conteudo);
        }
        try {
            $fileOp = fopen($this->getFile(), $mode);
            fwrite($fileOp, $this->getConteudo());
        } catch (Exception $exc) {
            throw new Exception("Erro ao salvar! : " . $exc->getMessage());
        } finally {
            fclose($fileOp);
        }
        return TRUE;
        /* //Alternativo 
          try {
          $this->setConteudo(Manipulador::salvarArquivoXYZ($this->getFile(), $this->getConteudo(), $mode));
          return TRUE;
          } catch (Exception $exc) {
          throw new Exception($exc->getMessage());
          }
         */
    }

    /**
     * Adiciona o conteúdo ao arquivo.
     * 
     * @param string $conteudo - Conteúdo adicionado.
     * @return bool - Se o arquivo foi salvo.
     * @expectedException Exception - Caso não consiga salvar.
     * @expectedExceptionMessage Não é um arquivo válido.
     * @expectedExceptionMessage Erro ao adicionar ao arquivo.
     */
    public function adicionarAoArquivo($conteudo) {
        if (!$this->isfile()) {
            throw new Exception("Não é um arquivo válido : ".$this->file);
        }
        try {
            $fileOp = fopen($this->getFile(), "a");
            fwrite($fileOp, $conteudo);
        } catch (Exception $exc) {
            throw new Exception("Erro ao adicionar ao arquivo! : " . $exc->getMessage());
        } finally {
            fclose($fileOp);
        }
        return TRUE;

        /* //Alternativo 
        try {
            return $this->salvarArquivo($conteudo, "a");
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
        */
    }

    /**
     * Recupera todos os dados de um arquivo.
     * 
     * @param string $file - Caminho do arquivo.
     * @return string - Conteúdo encontrado.
     * @expectedException Exception - Caso não consiga recuparar o conteúdo.
     * @expectedExceptionMessage Não é um arquivo válido.
     * @expectedExceptionMessage Erro ao recuperar conteúdo.
     */
    public static function recuperarArquivoXYZ($file): string {
        if (!file_exists($file) && !is_file($file)) {
            throw new Exception("Não é um arquivo válido");
        }
        $char = "";
        try {
            $fileOp = fopen($file, "r"); // Abre o arquivo
            while (!feof($fileOp)) {
                $char .= fgetc($fileOp); // Guarda todo conteúdo do arquivo em $char
            }
        } catch (Exception $exc) {
            throw new Exception("Erro ao recuperar conteúdo : " . $exc->getMessage());
        } finally {
            fclose($fileOp); //Fecha o arquivo
        }
        return $char;
    }

    /**
     * Recupera todos os dados do arquivo.
     * 
     * @param bool $encodeUTF8 - define se codifica para UTF-8
     * @return bool - Se o conteúdo foi recuperado;
     * @expectedException Exception - Caso ocorra um erro ao recuperar conteúdo.
     */
    public function recuperarArquivo(bool $encodeUTF8 = FALSE): bool {
        if (!$this->isfile() || !$this->isExists()) {
            return FALSE;
        }
        try {
            $fileOp = fopen($this->getFile(), "r");
            $char = "";
            while (!feof($fileOp)) {
                $char .= fgetc($fileOp);
            }
        } catch (Exception $exc) {
            throw new Exception("Erro ao recuperar conteúdo : " . $exc->getMessage());
        } finally {
            fclose($fileOp);
        }
        $this->setConteudo($char, $encodeUTF8);
        return TRUE;
        
        /** //Alternativo 
        try {
            $conteudo = $this->RecuperarArquivoXYZ($this->getFile());
            $this->setConteudo($conteudo);
            return TRUE;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
        */
    }

}
