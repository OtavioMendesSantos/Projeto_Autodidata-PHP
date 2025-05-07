<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Tela de Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="container">
        <div class="card login-card">
            <div class="login-header">
                <h3><i class="bi bi-person-circle"></i> Login</h3>
                <p class="mb-0">Faça login para acessar o sistema</p>
            </div>
            <div class="card-body p-4">
                <form method="post" action="../../service/login.php" id="loginForm" novalidate>
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
                        <label for="email"><i class="bi bi-envelope"></i> Email</label>
                        <div class="invalid-feedback">
                            Por favor, insira um email válido.
                        </div>
                    </div>

                    <div class="form-floating">
                        <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                        <label for="senha"><i class="bi bi-lock"></i> Senha</label>
                        <div class="invalid-feedback">
                            A senha é obrigatória.
                        </div>
                    </div>

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="lembrar" name="lembrar">
                        <label class="form-check-label" for="lembrar">
                            Lembrar de mim
                        </label>
                    </div>

                    <div class="alert alert-danger d-none" id="loginError" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> Email ou senha inválidos. Tente novamente.
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary btn-lg">
                            <i class="bi bi-box-arrow-in-right"></i> Entrar
                        </button>
                    </div>

                    <div class="mt-3 text-center">
                        <a href="#" class="text-decoration-none">Esqueceu sua senha?</a>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3 bg-light" style="border-radius: 0 0 1rem 1rem;">
                <p class="mb-0">Não tem uma conta? <a href="../cadastro/index.php" class="text-decoration-none">Cadastre-se</a></p>
            </div>
        </div>
        <div class="text-center mt-3">
            <a href="../../index.php" class="btn btn-outline-secondary">
                <i class="bi bi-house-door"></i> Voltar para Home
            </a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>

    <script src="script.js"></script>
</body>

</html>