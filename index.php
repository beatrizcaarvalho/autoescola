<?php

require "config.php";

$rota = $_GET["rota"] ?? ($_SERVER["REQUEST_METHOD"] === "POST" ? "alunos/create" : "teste");


function teste() {

    echo "API respondendo com sucesso!";

}


function listarAlunos($con) {

    header("Content-Type: application/json; charset=utf-8");

    $stmt = $con->query("SELECT * FROM Alunos");

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

}


function adicionarAluno($con) {

    $nome = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefone = $_POST["telefone"] ?? "";
    $data_nascimento = $_POST["data_nascimento"] ?? "";

    try {

        $stmt = $con->prepare(
            "INSERT INTO Alunos
            (nome, email, telefone, data_nascimento)
            VALUES (?, ?, ?, ?)"
        );

        $stmt->execute([
            $nome,
            $email,
            $telefone,
            $data_nascimento
        ]);

        header("Content-Type: application/json; charset=utf-8");

        echo json_encode([
            "mensagem" => "Aluno cadastrado com sucesso!"
        ]);

    } catch(PDOException $e) {

        header("Content-Type: application/json; charset=utf-8");

        echo json_encode([
            "erro" => "Não foi possível cadastrar o aluno."
        ]);

    }

}


function listarInstrutores($con) {

    header("Content-Type: application/json; charset=utf-8");

    $stmt = $con->query("SELECT * FROM Instrutores");

    echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));

}


function adicionarInstrutor($con) {

    $nome = $_POST["nome"] ?? "";
    $email = $_POST["email"] ?? "";
    $telefone = $_POST["telefone"] ?? "";
    $categoria_cnh = $_POST["categoria_cnh"] ?? "";

    try {

        $stmt = $con->prepare(
            "INSERT INTO Instrutores
            (nome, email, telefone, categoria_cnh)
            VALUES (?, ?, ?, ?)"
        );

        $stmt->execute([
            $nome,
            $email,
            $telefone,
            $categoria_cnh
        ]);

        header("Content-Type: application/json; charset=utf-8");

        echo json_encode([
            "mensagem" => "Instrutor cadastrado com sucesso!"
        ]);

    } catch(PDOException $e) {

        header("Content-Type: application/json; charset=utf-8");

        echo json_encode([
            "erro" => "Não foi possível cadastrar o instrutor."
        ]);

    }

}


if($_SERVER["REQUEST_METHOD"] === "POST") {

    if($rota === "alunos/create") {

        adicionarAluno($con);

    } elseif($rota === "instrutores/create") {

        adicionarInstrutor($con);

    }

} elseif ($rota === "alunos") {

    listarAlunos($con);

} elseif ($rota === "instrutores") {

    listarInstrutores($con);

} else {

    teste();

}

?>
