<?php
// Iniciar a sessão para acessar os dados armazenados
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['logado']) || $_SESSION['logado'] !== true) {
    // Redirecionar para a página de login se não estiver logado
    header("Location: ../login/index.php");
    exit;
}

// Obter dados do usuário da sessão
$usuario_nome = $_SESSION['usuario_nome'] ?? "Usuário";
$usuario_id = $_SESSION['usuario_id'] ?? 0;
$usuario_email = $_SESSION['usuario_email'] ?? "";

// Dados estatísticos da biblioteca (simulados por enquanto)
$total_livros = 5842;
$livros_emprestados = 423;
$usuarios_ativos = 1287;
$reservas_pendentes = 37;

// Livros populares simulados
$livros_populares = [
    ["titulo" => "Cem Anos de Solidão", "autor" => "Gabriel García Márquez", "emprestimos" => 143],
    ["titulo" => "1984", "autor" => "George Orwell", "emprestimos" => 112],
    ["titulo" => "Dom Quixote", "autor" => "Miguel de Cervantes", "emprestimos" => 96],
    ["titulo" => "O Pequeno Príncipe", "autor" => "Antoine de Saint-Exupéry", "emprestimos" => 85],
    ["titulo" => "Harry Potter e a Pedra Filosofal", "autor" => "J.K. Rowling", "emprestimos" => 78]
];

// Empréstimos recentes simulados
$emprestimos_recentes = [
    ["titulo" => "A Metamorfose", "usuario" => "Maria Santos", "data" => "20/06/2023", "devolucao" => "04/07/2023"],
    ["titulo" => "O Senhor dos Anéis", "usuario" => "Carlos Oliveira", "data" => "18/06/2023", "devolucao" => "02/07/2023"],
    ["titulo" => "A Revolução dos Bichos", "usuario" => "Ana Pereira", "data" => "15/06/2023", "devolucao" => "29/06/2023"],
    ["titulo" => "Orgulho e Preconceito", "usuario" => "Roberto Almeida", "data" => "12/06/2023", "devolucao" => "26/06/2023"]
];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca Virtual - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" />
    <link rel="stylesheet" href="dashboard.css" />
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar d-none d-lg-block" style="width: 250px;">
        <div class="logo">
            <h3><i class="bi bi-book"></i> BiblioTech</h3>
        </div>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="#"><i class="bi bi-speedometer2"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-search"></i> Catálogo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-person"></i> Usuários</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-arrow-left-right"></i> Empréstimos</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-bookmark"></i> Reservas</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-bar-chart"></i> Relatórios</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#"><i class="bi bi-gear"></i> Configurações</a>
            </li>
            <li class="nav-item mt-4">
                <a class="nav-link text-danger" href="../../service/logout.php"><i class="bi bi-box-arrow-left"></i> Sair</a>
            </li>
        </ul>
    </div>

    <!-- Navbar para mobile -->
    <nav class="navbar navbar-expand-lg d-lg-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><i class="bi bi-book"></i> BiblioTech</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="#"><i class="bi bi-speedometer2"></i> Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-search"></i> Catálogo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-person"></i> Usuários</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-arrow-left-right"></i> Empréstimos</a>
                    </li>
                    <!-- Outros itens do menu -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Conteúdo principal -->
    <div class="main-content">
        <!-- Barra de navegação superior -->
        <nav class="navbar navbar-expand mb-4 rounded">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <button class="btn d-lg-none me-2" type="button">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    <div class="search-box">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Pesquisar livros, autores...">
                            <button class="btn btn-outline-secondary" type="button"><i class="bi bi-search"></i></button>
                        </div>
                    </div>
                </div>
                <div class="user-info d-flex align-items-center">
                    <div class="dropdown">
                        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Usuário">
                            <span class="ms-2 d-none d-sm-inline"><?= $usuario_nome ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Perfil</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Configurações</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="../../service/logout.php"><i class="bi bi-box-arrow-right me-2"></i>Sair</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Cabeçalho da página -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="mb-0">Dashboard da Biblioteca</h2>
            <button class="btn btn-primary"><i class="bi bi-plus-lg me-2"></i>Novo Livro</button>
        </div>

        <!-- Cards de estatísticas -->
        <div class="row mb-4 g-3">
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card bg-card-1 p-3 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Total de Livros</h6>
                            <h3 class="fw-bold text-primary"><?= number_format($total_livros) ?></h3>
                        </div>
                        <div class="card-icon text-primary">
                            <i class="bi bi-book"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-decoration-none">Ver catálogo <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card bg-card-2 p-3 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Emprestados</h6>
                            <h3 class="fw-bold text-success"><?= number_format($livros_emprestados) ?></h3>
                        </div>
                        <div class="card-icon text-success">
                            <i class="bi bi-arrow-left-right"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-decoration-none text-success">Gerenciar empréstimos <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card bg-card-3 p-3 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Usuários Ativos</h6>
                            <h3 class="fw-bold text-warning"><?= number_format($usuarios_ativos) ?></h3>
                        </div>
                        <div class="card-icon text-warning">
                            <i class="bi bi-people"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-decoration-none text-warning">Ver usuários <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="dashboard-card bg-card-4 p-3 border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted">Reservas Pendentes</h6>
                            <h3 class="fw-bold text-danger"><?= number_format($reservas_pendentes) ?></h3>
                        </div>
                        <div class="card-icon text-danger">
                            <i class="bi bi-bookmark"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <a href="#" class="text-decoration-none text-danger">Gerenciar reservas <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráfico e Livros Populares -->
        <div class="row mb-4 g-3">
            <div class="col-lg-8">
                <div class="card border-0 dashboard-card">
                    <div class="card-header bg-white border-0">
                        <h5 class="card-title mb-0">Estatísticas de Empréstimos</h5>
                    </div>
                    <div class="card-body">
                        <canvas id="emprestimosChart" height="250"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 dashboard-card">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Livros Mais Populares</h5>
                        <a href="#" class="text-decoration-none">Ver todos</a>
                    </div>
                    <div class="card-body">
                        <?php foreach ($livros_populares as $index => $livro): ?>
                            <div class="d-flex align-items-center mb-3">
                                <div class="me-3 fw-bold text-muted">#<?= $index + 1 ?></div>
                                <div>
                                    <h6 class="mb-0"><?= $livro['titulo'] ?></h6>
                                    <small class="text-muted"><?= $livro['autor'] ?></small>
                                </div>
                                <div class="ms-auto badge bg-primary rounded-pill"><?= $livro['emprestimos'] ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Empréstimos Recentes e Destaques -->
        <div class="row mb-4 g-3">
            <div class="col-lg-7">
                <div class="card border-0 dashboard-card">
                    <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">Empréstimos Recentes</h5>
                        <a href="#" class="text-decoration-none">Ver todos</a>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th>Livro</th>
                                        <th>Usuário</th>
                                        <th>Data</th>
                                        <th>Devolução</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($emprestimos_recentes as $emprestimo): ?>
                                        <tr>
                                            <td><?= $emprestimo['titulo'] ?></td>
                                            <td><?= $emprestimo['usuario'] ?></td>
                                            <td><?= $emprestimo['data'] ?></td>
                                            <td><?= $emprestimo['devolucao'] ?></td>
                                            <td><span class="badge bg-success">Ativo</span></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card border-0 dashboard-card">
                    <div class="card-header bg-white border-0">
                        <h5 class="card-title mb-0">Destaques do Mês</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="text-center">
                                    <img src="https://covers.openlibrary.org/b/id/7395605-L.jpg" class="book-cover mb-3" alt="Livro">
                                    <h6>Cem Anos de Solidão</h6>
                                    <small class="text-muted d-block">Gabriel García Márquez</small>
                                    <div class="mt-2">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-half text-warning"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="text-center">
                                    <img src="https://covers.openlibrary.org/b/id/8314135-L.jpg" class="book-cover mb-3" alt="Livro">
                                    <h6>O Pequeno Príncipe</h6>
                                    <small class="text-muted d-block">Antoine de Saint-Exupéry</small>
                                    <div class="mt-2">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star text-warning"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Ações Rápidas -->
        <div class="row g-3">
            <div class="col-md-3">
                <div class="card border-0 dashboard-card text-center p-3">
                    <div class="card-body">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3 d-inline-block mb-3">
                            <i class="bi bi-plus-lg fs-3 text-primary"></i>
                        </div>
                        <h5>Adicionar Livro</h5>
                        <p class="text-muted">Cadastre novos livros no sistema</p>
                        <button class="btn btn-sm btn-outline-primary">Adicionar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 dashboard-card text-center p-3">
                    <div class="card-body">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3 d-inline-block mb-3">
                            <i class="bi bi-arrow-up-right fs-3 text-success"></i>
                        </div>
                        <h5>Empréstimo</h5>
                        <p class="text-muted">Registre um novo empréstimo</p>
                        <button class="btn btn-sm btn-outline-success">Emprestar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 dashboard-card text-center p-3">
                    <div class="card-body">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3 d-inline-block mb-3">
                            <i class="bi bi-arrow-down-left fs-3 text-warning"></i>
                        </div>
                        <h5>Devolução</h5>
                        <p class="text-muted">Registre uma devolução de livro</p>
                        <button class="btn btn-sm btn-outline-warning">Devolver</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 dashboard-card text-center p-3">
                    <div class="card-body">
                        <div class="rounded-circle bg-danger bg-opacity-10 p-3 d-inline-block mb-3">
                            <i class="bi bi-file-earmark-text fs-3 text-danger"></i>
                        </div>
                        <h5>Relatórios</h5>
                        <p class="text-muted">Gere relatórios e estatísticas</p>
                        <button class="btn btn-sm btn-outline-danger">Gerar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="script.js"></script>
</body>

</html>