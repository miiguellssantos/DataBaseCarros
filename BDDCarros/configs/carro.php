<?php
    require_once "BancoDados.php";

    class Carro 
    {
        public static function Cadastrar($modelo, $ano, $idpessoa) 
        {
            try {
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("INSERT INTO carro(modelo, ano, idpessoa) VALUES (?, ?, ?)");
                $sql->execute([
                    $modelo,
                    $ano, 
                    $idpessoa
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

        public static function listar()
        {
            try{
                $conexao = Conexao::getConexao();
                $sql = $conexao->prepare("SELECT c.*, p.nome as nomePessoa from Carro c JOIN Pessoas p ON c.idpessoa=p.id ORDER BY id" );
                $resultado = $sql->execute();

                return $sql->fetchAll();
            } catch(Exception $e){
                echo $e->getMessage();
                exit;
            }
        }
    }
?>