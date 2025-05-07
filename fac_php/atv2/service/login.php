<?php
// Iniciar sessão
session_start();

// Incluir arquivo de conexão
require_once '../config/conn.php';

// Verificar se é uma requisição POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Capturar e limpar os dados do formulário
    $email = limparEntrada($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';
    $lembrar = isset($_POST['lembrar']) ? true : false;

    addLog("Recebendo dados do formulário");
    addLog("Email: " . $email);
    addLog("Senha: " . $senha);
    addLog("Lembrar: " . ($lembrar ? "Sim" : "Não"));

    // Validar dados básicos
    $erros = array();

    if (empty($email)) {
        $erros[] = "O campo Email é obrigatório";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Formato de email inválido";
    }

    if (empty($senha)) {
        $erros[] = "O campo Senha é obrigatório";
    }

    // Se não houver erros de validação básica, verificar no banco de dados
    if (empty($erros)) {
        // Preparar consulta SQL segura
        $stmt = $conn->prepare("
            SELECT
                id,
                nome,
                email,
                senha
            FROM 
                usuarios 
            WHERE email = ?
        ");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            // Usuário encontrado, verificar senha
            $usuario = $result->fetch_assoc();

            // Verificar se a senha está correta usando password_verify
            if (password_verify($senha, $usuario['senha'])) {
                // Login bem-sucedido, criar sessão
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_email'] = $usuario['email'];
                $_SESSION['logado'] = true;

                // Se o usuário marcou "Lembrar de mim", criar um cookie
                if ($lembrar) {
                    // Criar token seguro
                    $token = bin2hex(random_bytes(32));

                    // Armazenar o token no banco para verificação futura
                    $stmt = $conn->prepare("UPDATE usuarios SET token_lembrar = ? WHERE id = ?");
                    $stmt->bind_param("si", $token, $usuario['id']);
                    $stmt->execute();

                    // Criar cookie que expira em 30 dias
                    setcookie('remember_token', $token, time() + (86400 * 30), "/", "", false, true);
                    setcookie('user_id', $usuario['id'], time() + (86400 * 30), "/", "", false, true);
                }

                // Registrar o login no histórico
                // $ip = $_SERVER['REMOTE_ADDR'];
                // $agente = $_SERVER['HTTP_USER_AGENT'];

                if ($stmt->execute()) {
                    addLog("Login bem-sucedido");
                    echo "<script>alert('Login bem-sucedido');</script>";
                    header("Location: ../views/dashboard/index.php");
                } else {
                    addLog("Erro ao registrar login no histórico");
                    echo "<script>alert('Erro ao registrar login no histórico');</script>";
                }
                exit();
            } else {
                // Senha incorreta
                $erros[] = "Email ou senha incorretos";
            }
        } else {
            // Usuário não encontrado
            $erros[] = "Email ou senha incorretos";
        }
    }

    // Se chegou até aqui, houve erro. Armazenar erros na sessão
    $_SESSION['login_erro'] = implode("<br>", $erros);

    // Redirecionar de volta para o formulário de login
    header("Location: ../views/login/index.php?erro=1");
    exit();
}

// Se não for uma requisição POST, redirecionar para a página inicial
header("Location: ../index.php");
exit();
