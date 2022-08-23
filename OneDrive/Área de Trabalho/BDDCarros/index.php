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

                    $resultado = Pessoa::Cadastrar($nome, $login, $senha);
                    if ($resultado) {
                        echo "<p>O usuário $nome foi cadastrado com sucesso!</p>";
                    } else {
                        echo "<p>Houve um erro no cadastro do $nome!</p>";
                    }
                }
            }
        }
    ?>
    <div id="form01">
        <h2>Cadastro Pessoal</h2>
        <form method="POST">
            Digite seu nome:
            <input type="text" name="nome" required><br><br>
            Digite seu login:
            <input type="email" name="login" required><br><br>
            Digite sua senha:
            <input type="password" name="senha" required minlength="3">
            <br><br>
            <button id="cadastro01">Cadastrar</button>
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
                    echo "<p>Houve um erro no cadastro do carro!</p>";
                }
                
                
            }
        }
    }
    ?>
    <div id="form02">
    <h2>Cadastre aqui o seu Carro</h2>
    <form method="POST">
        Digite o modelo:
        <input type="text" name="modelo" required><br><br>
        Digite o ano:
        <input type="text" name="ano" required minlength="4"><br><br>
        Digite o ID do dono:
        <input type="text" name="idPessoa" required>
        <br><br>
        <button id="cadastro02">Cadastrar</button>
    </form>
    </div>
    <div id="tabPessoa">
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

    <div id="tabCarro">
    <h3>Lista de Carros cadastradas</h3>
    <table>
        <thead>
            <tr>
                <td>ID</td>
                <td>Modelo</td>
                <td>Ano</td>
                <td>IdPessoa</td>
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
                    echo "<td>" . $carro["idPessoa"] . "</td>";
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
            </div>
</body>
</html>