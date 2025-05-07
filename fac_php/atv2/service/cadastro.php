<?php

require_once '../config/conn.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Verificando se recebemos os dados
        addLog("Recebendo dados do formulário");
        
        $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : '';
        $email = isset($_POST['email']) ? $_POST['email'] : '';
        $senha = isset($_POST['senha']) ? $_POST['senha'] : '';
        $senha = password_hash($senha, PASSWORD_DEFAULT);
        $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : '';
        $genero = isset($_POST['genero']) ? $_POST['genero'] : '';
        $aceite_termos = isset($_POST['aceite_termos']) ? $_POST['aceite_termos'] : '';
        
        // Verificando se a conexão está funcionando
        if (!$conn) {
            throw new Exception("Falha na conexão com o banco de dados");
        }
        
        addLog("Preparando a consulta SQL");
        
        $sql = "INSERT INTO usuarios (
            nome,
            cpf,
            email,
            senha,
            telefone,
            genero,
            aceite_termos,
            token_lembrar
        ) VALUES (?, ?, ?, ?, ?, ?, ?, 'não lembrar')";

        // Preparando e executando a consulta
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Erro na preparação da consulta: " . $conn->error);
        }
        
        addLog("Vinculando parâmetros");
        
        // Converta aceite_termos para inteiro se for 'on'
        $aceite_int = ($aceite_termos == 'on') ? 1 : 0;
        
        $stmt->bind_param("ssssssi", $nome, $cpf, $email, $senha, $telefone, $genero, $aceite_int);
        
        addLog("Executando a consulta");
        
        if ($stmt->execute()) {
            addLog("Cadastro bem-sucedido!");
            $stmt->close();
            echo "<script>alert('Cadastro realizado com sucesso');</script>";
            header("Location: ../views/dashboard/index.php");
            exit;
        } else {
            $error = $stmt->error;
            $stmt->close();
            throw new Exception("Erro ao executar a consulta: " . $error);
        }
    } catch (Exception $e) {
        addLog("Erro: " . $e->getMessage());
        echo "<script>alert('Erro ao realizar o cadastro: " . addslashes($e->getMessage()) . "');</script>";
    }
}
