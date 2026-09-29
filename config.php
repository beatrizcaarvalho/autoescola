<?php
$host = "localhost";
$dbname = "autoescola";
$user = "root";
$password = "";

try {
    $con = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user,
        $password
    );
     $con->setattribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    echo "Conectado com sucesso!";

} catch (PDOException $e) {
    http_response_code(500);

    echo json_encode([
        "erro" => "Falha na conexão: " . $e->getMessage()
    ]);
}
?>