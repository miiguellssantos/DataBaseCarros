<?php
    require_once "BancoDados.php";

    class Pessoa 
    {
        public static function Cadastrar($nome, $login, $senha) 
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("INSERT INTO pessoas(nome, login, senha) VALUES (?, ?, ?)");
                $sql->execute([
                    $nome,
                    $login,
                    $senha
                ]);

                // rowCount() - contar a quantidade de linhas inseridas, removidas ou atualizadas com o comando
                if ($sql->rowCount() > 0) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo $e->getMessage();
                exit;
            }
        }
        
        public static function listar(){
                try{
                    $conexao = Conexao::getConexao();
                    $sql = $conexao->prepare("SELECT * from pessoas ORDER BY id");
                    $resultado = $sql->execute();

                    return $sql->fetchAll();
                } catch(Exception $e){
                    echo $e->getMessage();
                    exit;
                }
        }
    }

?>