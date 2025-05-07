# Sistema de Biblioteca - BiblioTech

Este repositório contém um sistema de gerenciamento de biblioteca desenvolvido em PHP, chamado BiblioTech. O sistema permite o cadastro de usuários, login, gerenciamento de livros e empréstimos.

## Estrutura do Projeto

O projeto está organizado da seguinte forma:

```bash
├── config/
│ ├── conn.php # Configurações de conexão com o banco de dados
│ └── db.sql # Script SQL para criação do banco de dados
├── service/
│ ├── cadastro.php # Processamento do formulário de cadastro
│ ├── login.php # Processamento do formulário de login
│ └── logout.php # Processamento de logout
├── views/
│ ├── cadastro/ # Tela de cadastro de usuários
│ │ ├── index.php
│ │ ├── cadastro.css
│ │ └── script.js
│ ├── login/ # Tela de login
│ │ ├── index.php
│ │ ├── login.css
│ │ └── script.js
│ └── dashboard/ # Painel principal após login
│ ├── index.php
│ └── dashboard.css
└── index.php # Página inicial do sistema
```

## Funcionalidades

### 1. Página Inicial
- Apresentação do sistema BiblioTech
- Opções para login ou cadastro de novos usuários
- Interface amigável com informações sobre os recursos do sistema

### 2. Cadastro de Usuários
- Formulário completo para registro de novos usuários
- Validação de dados em tempo real com JavaScript
- Campos para nome, CPF, email, senha, telefone e gênero
- Aceitação obrigatória dos termos de uso
- Armazenamento seguro de senhas com hash

### 3. Login
- Sistema de autenticação seguro
- Opção "Lembrar de mim" com cookies
- Validação de credenciais contra o banco de dados
- Feedback visual para erros de autenticação

### 4. Dashboard
- Painel administrativo após login bem-sucedido
- Exibição de estatísticas da biblioteca
- Livros populares e empréstimos recentes
- Menu de navegação para as diferentes funcionalidades
- Informações do usuário logado

### 5. Sistema de Sessões
- Gerenciamento de sessões para controle de acesso
- Proteção de rotas para usuários não autenticados
- Armazenamento de dados do usuário na sessão
- Logout seguro com limpeza de sessão e cookies

## Tecnologias Utilizadas

- **Backend**: PHP 7+
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework CSS**: Bootstrap 5
- **Banco de Dados**: MySQL
- **Ícones**: Bootstrap Icons

## Segurança

O sistema implementa diversas medidas de segurança:

- Proteção contra SQL Injection usando prepared statements
- Sanitização de entradas do usuário
- Armazenamento seguro de senhas com password_hash()
- Validação de dados no cliente e no servidor
- Proteção de rotas via verificação de sessão
- Tokens seguros para a funcionalidade "Lembrar de mim"

## Banco de Dados

O sistema utiliza uma tabela principal para armazenar os dados dos usuários:

```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    cpf VARCHAR(14) NOT NULL UNIQUE,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    telefone VARCHAR(20),
    genero ENUM('masculino', 'feminino', 'outro', 'prefiro-nao-informar'),
    aceite_termos BOOLEAN NOT NULL DEFAULT FALSE,
    token_lembrar VARCHAR(255),
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_atualizacao DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

## Como Instalar

1. Clone este repositório
2. Configure um servidor web com PHP 7+ e MySQL
3. Importe o arquivo `config/db.sql` para criar o banco de dados
4. Ajuste as configurações de conexão em `config/conn.php`
5. Acesse o sistema pelo navegador

## Fluxo de Uso

1. Acesse a página inicial
2. Crie uma nova conta através do formulário de cadastro
3. Faça login com suas credenciais
4. Explore o dashboard e as funcionalidades do sistema
5. Utilize o botão de logout para encerrar a sessão
