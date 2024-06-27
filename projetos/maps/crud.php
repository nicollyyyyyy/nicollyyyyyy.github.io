<?php
    include("conecta.php");
    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $telefone = $_POST["telefone"];
    $descricao = $_POST["descricao"];

    if(isset($_POST["inserir"]))
    {
        $comando = $pdo->prepare("INSERT INTO cadastro VALUES('$cpf','$nome','$telefone','$descricao')");
        $resultado = $comando->execute();
        header("Location: index.html");
    }
    if(isset($_POST["deletar"]))
    {
        $comando = $pdo->prepare("DELETE FROM cadastro WHERE cpf='$cpf' ");
        $resultado = $comando->execute();
        header("Location: index.html");
    }
    if(isset($_POST["alterar"]))
    {
        $comando = $pdo->prepare("UPDATE cadastro SET nome='$nome', telefone='$telefone', descricao='$descricao' WHERE cpf='$cpf' ");
        $resultado = $comando->execute();
        header("Location: index.html");
    }
    if(isset($_POST["listar"]))
    {
        header("Location: listar.php");
    }
?>