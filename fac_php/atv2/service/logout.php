<?php
// Iniciar a sessão
session_start();

// Limpar todas as variáveis da sessão
$_SESSION = array();

// Destruir a sessão
session_destroy();

// Destruir os cookies de "lembrar-me" se existirem
if (isset($_COOKIE["remember_token"])) {
    setcookie("remember_token", "", time() - 3600, "/");
}
if (isset($_COOKIE["user_id"])) {
    setcookie("user_id", "", time() - 3600, "/");
}

// Redirecionar para a página de login
header("Location: ../index.php");
exit;
?> 