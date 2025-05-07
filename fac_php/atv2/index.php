<?php
require_once 'config/conn.php';
session_start();
if (isset($_SESSION['logado']) && $_SESSION['logado'] === true) {
    header("Location: views/dashboard/index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <title>BiblioTech - Sistema de Biblioteca</title>
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background-image: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
        }

        .home-card {
            margin: 0 auto;
            max-width: 800px;
            border-radius: 1rem;
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background-color: white;
        }

        .home-header {
            background-color: #1e3a8a; /* Cor azul escuro mais sofisticada */
            color: white;
            padding: 30px;
            text-align: center;
        }

        .btn-login {
            background-color: #6f42c1;
            border-color: #6f42c1;
        }

        .btn-login:hover {
            background-color: #5a36a0;
            border-color: #5a36a0;
        }

        .btn-cadastro {
            background-color: #198754;
            border-color: #198754;
        }

        .btn-cadastro:hover {
            background-color: #146c43;
            border-color: #146c43;
        }

        .feature-icon {
            font-size: 2.5rem;
            color: #1e3a8a;
            margin-bottom: 15px;
        }

        .btn-lg {
            padding: 15px 25px;
            font-size: 1.2rem;
        }

        @media (max-width: 768px) {
            .home-card {
                margin: 0 15px;
            }
        }
        
        /* Estilo para decorar com livros */
        .book-decoration {
            position: absolute;
            z-index: -1;
            opacity: 0.1;
            font-size: 10rem;
            color: #0d6efd;
        }
        
        .book-left {
            left: 10%;
            top: 20%;
            transform: rotate(-15deg);
        }
        
        .book-right {
            right: 10%;
            bottom: 20%;
            transform: rotate(15deg);
        }
    </style>
</head>

<body>
    <!-- Decoração de fundo com ícones de livros -->
    <div class="book-decoration book-left">
        <i class="bi bi-book"></i>
    </div>
    <div class="book-decoration book-right">
        <i class="bi bi-journal-bookmark"></i>
    </div>

    <div class="container">
        <div class="card home-card">
            <div class="home-header">
                <h1><i class="bi bi-book"></i> BiblioTech</h1>
                <p class="lead mb-0">Sua biblioteca digital completa</p>
            </div>

            <div class="card-body p-4 p-md-5">
                <div class="row text-center mb-5">
                    <div class="col-md-4">
                        <div class="feature-icon">
                            <i class="bi bi-search"></i>
                        </div>
                        <h5>Catálogo Digital</h5>
                        <p class="text-muted">Encontre qualquer livro com nossa pesquisa avançada.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-icon">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <h5>Empréstimos</h5>
                        <p class="text-muted">Gerencie empréstimos e devoluções facilmente.</p>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-icon">
                            <i class="bi bi-graph-up"></i>
                        </div>
                        <h5>Estatísticas</h5>
                        <p class="text-muted">Acompanhe os livros mais populares e leitores ativos.</p>
                    </div>
                </div>

                <div class="row justify-content-center mb-4">
                    <div class="col-md-10">
                        <p class="text-center fs-5">
                            Bem-vindo à BiblioTech! Faça login para acessar nosso sistema de gerenciamento de biblioteca ou crie uma nova conta para começar a utilizar nossa plataforma.
                        </p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-md-5 mb-3 mb-md-0">
                        <div class="d-grid">
                            <a href="views/login/index.php" class="btn btn-login btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </a>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="d-grid">
                            <a href="views/cadastro/index.php" class="btn btn-cadastro btn-lg">
                                <i class="bi bi-person-plus"></i> Cadastro
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Nova seção com informações sobre a biblioteca -->
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card bg-light border-0">
                            <div class="card-body">
                                <h4 class="text-center mb-4"><i class="bi bi-info-circle"></i> Sobre Nossa Biblioteca</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-collection fs-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">Acervo Diversificado</h6>
                                                <p class="text-muted small mb-0">Mais de 5.000 títulos em diversas áreas do conhecimento</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-journal-text fs-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">Livros Acadêmicos</h6>
                                                <p class="text-muted small mb-0">Material completo para pesquisas e trabalhos escolares</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-laptop fs-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">Reservas Online</h6>
                                                <p class="text-muted small mb-0">Reserve seus livros favoritos sem sair de casa</p>
                                            </div>
                                        </div>
                                        <div class="d-flex align-items-start mb-3">
                                            <div class="me-3 text-primary">
                                                <i class="bi bi-calendar-event fs-4"></i>
                                            </div>
                                            <div>
                                                <h6 class="mb-1">Eventos Literários</h6>
                                                <p class="text-muted small mb-0">Participe dos nossos clubes de leitura e eventos temáticos</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer text-center py-3 bg-light">
                <p class="mb-0">
                    &copy; 2023 BiblioTech | <a href="#" class="text-decoration-none">Termos de Uso</a> | <a href="#" class="text-decoration-none">Privacidade</a>
                </p>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js" integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous"></script>
</body>

</html>