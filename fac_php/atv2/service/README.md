# Camada de Serviços (Service)

Este diretório contém os scripts PHP responsáveis pelas operações de manipulação de dados e serviços de autenticação do sistema BiblioTech. Os serviços funcionam como uma camada intermediária entre a interface do usuário e o banco de dados.

## Arquivos e Funcionalidades

### 1. login.php

**Função principal**: Autenticação de usuários no sistema.

**Aspectos técnicos**:
- Implementa autenticação segura usando `password_verify()` para comparação de senhas hash
- Utiliza prepared statements para prevenir SQL Injection
- Mantém estado do usuário através de sessões PHP
- Implementa recurso "lembrar-me" com tokens criptograficamente seguros

**Fluxo de execução**:
1. Captura e sanitiza dados do formulário de login
2. Valida formato básico dos campos (email, senha não vazia)
3. Consulta o banco de dados com prepared statements
4. Verifica a senha usando `password_verify()` (comparação segura de hash)
5. Cria variáveis de sessão para usuário autenticado
6. Opcionalmente cria cookie seguro para "lembrar-me"
7. Registra o login no histórico (IP, navegador, timestamp)
8. Redireciona para o dashboard em caso de sucesso

**Considerações de segurança**:
- Senhas nunca são comparadas em texto plano
- Mensagens de erro genéricas não revelam se o email existe
- Tokens de autenticação persistente são gerados via `random_bytes()`
- Dados de entrada são sanitizados com a função `limparEntrada()`

### 2. cadastro.php

**Função principal**: Registro de novos usuários no sistema.

**Aspectos técnicos**:
- Implementa hash de senha usando `password_hash()` com algoritmo seguro
- Utiliza prepared statements para inserção segura de dados
- Realiza validação e sanitização de dados de entrada
- Implementa verificação de duplicidade (email, CPF)

**Fluxo de execução**:
1. Recebe e sanitiza dados do formulário
2. Gera hash seguro da senha com `password_hash()`
3. Valida informações críticas (email, CPF)
4. Insere dados no banco usando prepared statements
5. Redireciona para o dashboard ou retorna mensagem de erro

**Considerações de segurança**:
- Senhas são armazenadas apenas como hash (nunca em texto plano)
- Uso de prepared statements previne SQL Injection
- Tratamento de exceções para evitar exposição de erros internos
- Conversão adequada de tipos para armazenamento

### 3. logout.php

**Função principal**: Encerramento seguro de sessões de usuário.

**Aspectos técnicos**:
- Implementa limpeza completa de dados de sessão
- Remove cookies de autenticação persistente
- Utiliza redirecionamento após logout

**Fluxo de execução**:
1. Inicia a sessão existente
2. Limpa todas as variáveis de sessão (`$_SESSION = array()`)
3. Destrói a sessão completamente (`session_destroy()`)
4. Remove cookies de autenticação persistente
5. Redireciona para a página inicial

**Considerações de segurança**:
- Invalidação completa da sessão
- Remoção de todos os cookies de autenticação
- Prevenção contra reuso de credenciais

## Aspectos Gerais de Segurança

- **Proteção contra CSRF**: Implementação futura recomendada com tokens de formulário
- **Proteção contra XSS**: Sanitização de entrada e saída de dados
- **Proteção contra SQL Injection**: Uso consistente de prepared statements
- **Armazenamento seguro de senhas**: Utilização de `password_hash()` e `password_verify()`
- **Cookies seguros**: Definição de parâmetros de segurança em cookies (`httponly`, `secure` em produção)
- **Proteção contra força bruta**: Implementação futura recomendada (limitação de tentativas)

## Boas Práticas Implementadas

1. **Separação de responsabilidades**: Serviços separados para cada funcionalidade
2. **Centralização de conexão**: Reuso do arquivo de conexão
3. **Tratamento de erros**: Captura e log de exceções
4. **Mensagens de usuário**: Feedback adequado sem expor detalhes do sistema
5. **Validação em múltiplas camadas**: Cliente (JavaScript) e servidor (PHP)
6. **Sanitização de dados**: Limpeza de entradas para prevenir injeção

## Fluxo de Autenticação 

```mermaid
┌─────────────┐ ┌─────────────┐ ┌─────────────┐ ┌─────────────┐
│ Login │────▶│ Validação │────▶│ Verificação │────▶│ Sessão + │
│ (form) │ │ de dados │ │ de senha │ │ Redirect │
└─────────────┘ └─────────────┘ └─────────────┘ └─────────────┘
▲ │
│ │
│ ▼
┌─────────────┐ ┌─────────────┐
│ Logout │◀─────────────────────────│ Dashboard/ │
│ (destruir │ │ Área restrita│
│ sessão) │ │ │
└─────────────┘ └─────────────┘
```

## Possíveis Melhorias Futuras

- Implementação de autenticação em duas etapas
- Sistema de recuperação de senha
- Registro de falhas de login para detecção de ataques
- Sistema de bloqueio temporário após múltiplas tentativas
- Validação mais rigorosa de força de senha
