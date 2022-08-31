<!-- 
==============================================================

BANCO DE DADOS EM FUNÇÃO DE TABELAS CRIADAS ANTERIORMENTE
TABELA PESSOA COM: id(int, primary key e autofill), nome(varchar(255)), login(varchar(255)) e senha(varchar(255))

TABELA CARRO COM: id(int, primary key e autofill), modelo (varchar(255)), ano(int) e idPessoa(int, foreing key = Pessoa(id))

===============================================================
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Pessoa-Carro</title>
    <link href="style.css" rel="stylesheet">
</head>
<body>
    <header>
    <h1>Cadastro Pessoa-Carro</h1>  
    <hr>
    </header>

    <main>
        <div class="container">
            <?php

                // $_POST é um array associativo
                // isset($_POST[KEY]) - verifca se $_POST[KEY] existe;
                // !empty($_POST[KEY]) - verifca se $_POST[KEY] não está vazio;

                require_once "configs/pessoas.php";

                if (isset($_POST["nome"]) and !empty($_POST["nome"])) {
                    if (isset($_POST["login"]) and !empty($_POST["login"])) {
                        if (isset($_POST["senha"]) and !empty($_POST["senha"])) {
                            $nome = $_POST["nome"];
                            $login = $_POST["login"];
                            $senha = $_POST["senha"];

                            if (!Pessoa::existe($login)){
                                $resultado = Pessoa::Cadastrar($nome, $login, $senha);
                                if($resultado){
                                    echo "<script>alert('Cadastro realizado com sucesso!')</script>";
                                }else{
                                    echo "<script>alert('Houve um erro no cadastro.')</script>";
                                }
                            }else{
                                echo "<script>alert('Essa pessoa já existe!')</script>";
                            }
                        }
                    }
                }
            ?>

            <div id="form">
                <form method="POST">
                    <h2>Cadastro Pessoal</h2>
                    Digite seu nome:
                    <input type="text" name="nome" required><br><br>
                    Digite seu login:
                    <input type="email" name="login" required><br><br>
                    Digite sua senha:
                    <input type="password" name="senha" required minlength="3">
                    <br><br>
                    <button id="cadastro">Cadastrar</button>
                </form>
            </div>

            <?php
                require_once "configs/carro.php";
                if (isset($_POST["modelo"]) and !empty($_POST["modelo"])) {
                    if (isset($_POST["ano"]) and !empty($_POST["ano"])) {
                        if (isset($_POST["idPessoa"]) and !empty($_POST["idPessoa"])) {
                            $modelo = $_POST["modelo"];
                            $ano = $_POST["ano"];
                            $idPessoa = $_POST["idPessoa"];

                            $resultado = Carro::Cadastrar($modelo, $ano, $idPessoa);
                            if ($resultado) {
                                
                            } else {
                                echo  "<script>alert('Houve um erro no cadastro');</script>";
                            }
                            
                            
                        }
                    }
                }
            ?>

            <div id="form">
                <h2>Cadastre aqui o seu Carro</h2>
                <form method="POST">
                    Digite o modelo:
                    <input type="text" name="modelo" required><br><br>
                    Digite o ano:
                    <input type="text" name="ano" required minlength="4"><br><br>
                    Selecione o dono:
                    <select name="idPessoa">
                        <?php  
                            $listaPessoas = Pessoa::listar();
                            foreach ($listaPessoas as $pessoa){
                                $nome = $pessoa["nome"];
                                $id = $pessoa["id"];

                                echo "<option value='$id'>$nome</option>" ;
                            }  
                        ?>
                    </select>
                    <br><br>
                    <button id="cadastro">Cadastrar</button>
                </form>
            </div>

            <div id="tab">
                    <h2> Lista de Pessoas Cadastradas</h2>
                
                <table>
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Nome</td>
                            <td>Login</td>
                            <td>Senha</td>
                        </tr>
                    </thead>
                    
                    <tbody>
                        <?php
                        require_once "configs/pessoas.php";
                            $listaPessoas = Pessoa::listar();
                            foreach($listaPessoas as $pessoa){
                                echo "<tr>";
                                echo "<td>" . $pessoa["id"] . "</td>";
                                echo "<td>" . $pessoa["nome"] . "</td>";
                                echo "<td>" . $pessoa["login"] . "</td>";
                                echo "<td>" . $pessoa["senha"] . "</td>";
                                echo "</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>

            <div id="tab">
                <h3>Lista de Carros cadastradas</h3>
                <table>
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Modelo</td>
                        <td>Ano</td>
                        <td>Nome(Dono)</td>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    require_once "configs/carro.php";
                        $listaCarros = Carro::listar();
                        foreach($listaCarros as $carro){
                            echo "<tr>";
                            echo "<td>" . $carro["id"] . "</td>";
                            echo "<td>" . $carro["modelo"] . "</td>";
                            echo "<td>" . $carro["ano"] . "</td>";
                            echo "<td>" . $carro["nomePessoa"] . "</td>";
                            echo "</tr>";
                        }
                    ?>
                </tbody>
                </table>
            </div>
        </div>
    </main>
    <hr>
    <footer>
     2021 - Miguel Lordello dos Santos®               
    </footer>
</body>
</html>