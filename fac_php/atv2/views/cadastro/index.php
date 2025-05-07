<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="cadastro.css">
</head>

<body>
    <div class="container">
        <div class="card cadastro-card">
            <div class="cadastro-header">
                <h3><i class="bi bi-person-plus-fill"></i> Cadastro</h3>
                <p class="mb-0">Crie sua conta para acessar o sistema</p>
            </div>
            <div class="card-body p-4">
                <form method="post" action="../../service/cadastro.php" id="cadastroForm" novalidate>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="nome" name="nome" placeholder="Seu nome" required>
                                <label for="nome"><i class="bi bi-person"></i> Nome completo</label>
                                <div class="invalid-feedback">
                                    O nome completo é obrigatório.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="999.999.999-99" required>
                                <label for="cpf"><i class="bi bi-card-text"></i> CPF</label>
                                <div class="invalid-feedback">
                                    Informe um CPF válido.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-floating">
                        <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com" required>
                        <label for="email"><i class="bi bi-envelope"></i> Email</label>
                        <div class="invalid-feedback">
                            Por favor, insira um email válido.
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" required>
                                <label for="senha"><i class="bi bi-lock"></i> Senha</label>
                                <div class="invalid-feedback">
                                    A senha deve ter pelo menos 6 caracteres.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" placeholder="Confirmar senha" required>
                                <label for="confirmarSenha"><i class="bi bi-lock-fill"></i> Confirmar senha</label>
                                <div class="invalid-feedback">
                                    As senhas não coincidem.
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-floating">
                        <input type="tel" class="form-control" id="telefone" name="telefone" placeholder="(99) 99999-9999">
                        <label for="telefone"><i class="bi bi-telephone"></i> Telefone</label>
                        <div class="invalid-feedback">
                            Formato de telefone inválido.
                        </div>
                    </div>
                    
                    <div class="form-floating">
                        <select class="form-select" id="genero" name="genero">
                            <option value="" selected disabled>Selecione</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="outro">Outro</option>
                            <option value="prefiro-nao-informar">Prefiro não informar</option>
                        </select>
                        <label for="genero"><i class="bi bi-gender-ambiguous"></i> Gênero</label>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" id="aceite_termos" name="aceite_termos" required>
                        <label class="form-check-label" for="aceite_termos">
                            Concordo com os <a href="#" class="text-decoration-none">termos e condições</a>
                        </label>
                        <div class="invalid-feedback">
                            Você deve concordar com os termos para prosseguir.
                        </div>
                    </div>
                    
                    <div class="alert alert-danger d-none" id="cadastroError" role="alert">
                        <i class="bi bi-exclamation-triangle-fill"></i> <span id="mensagemErro"></span>
                    </div>
                    
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="bi bi-check-circle"></i> Cadastrar
                        </button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center py-3 bg-light" style="border-radius: 0 0 1rem 1rem;">
                <p class="mb-0">Já tem uma conta? <a href="../login/index.php" class="text-decoration-none">Faça login</a></p>
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