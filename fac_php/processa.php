<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars($_POST["nome"]);
    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $mensagem = htmlspecialchars($_POST["mensagem"]);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "E-mail inválido!";
        exit;
    }

    echo "<h2>Dados Recebidos:</h2>";
    echo "Nome: " . $nome . "<br>";
    echo "E-mail: " . $email . "<br>";
    echo "Mensagem: " . nl2br($mensagem) . "<br>";
} else {
    echo "Acesso inválido!";
}
