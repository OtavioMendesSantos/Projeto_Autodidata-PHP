<?php

// Configurações do banco de dados
$host = "localhost";
$usuario = "root";
$senha = "admin";
$banco = "biblioteca";

// Criando a conexão
$conn = new mysqli($host, $usuario, $senha, $banco);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Função para limpar entradas do usuário
function limparEntrada($dados)
{
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

// Adicionar log para debug
function addLog($message) {
    echo "<script>console.log(" . json_encode($message) . ");</script>";
}