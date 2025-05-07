document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('loginForm');
    
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Reset anterior
        form.querySelectorAll('.is-invalid').forEach(field => {
            field.classList.remove('is-invalid');
        });
        document.getElementById('loginError').classList.add('d-none');
        
        // Validar email
        const email = document.getElementById('email');
        if (!email.value || !isValidEmail(email.value)) {
            email.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validar senha
        const senha = document.getElementById('senha');
        if (!senha.value) {
            senha.classList.add('is-invalid');
            isValid = false;
        }
        
        // Se houver erros, impedir o envio do formulário
        if (!isValid) {
            event.preventDefault();
            document.getElementById('mensagemErro').textContent = 'Por favor, corrija os erros no formulário.';
            document.getElementById('loginError').classList.remove('d-none');
        }
    });
    
    // Função para validar formato de email
    function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
    
    // Remover classes de erro quando o usuário começa a digitar novamente
    form.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            document.getElementById('loginError').classList.add('d-none');
        });
    });
    
    // Verificar se há parâmetro de erro na URL e exibir mensagem
    const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.has('erro')) {
        document.getElementById('loginError').classList.remove('d-none');
    }
    
    // Verificar se há parâmetro de cadastro bem-sucedido e exibir mensagem
    if (urlParams.has('cadastro') && urlParams.get('cadastro') === 'sucesso') {
        const sucessoMsg = document.createElement('div');
        sucessoMsg.className = 'alert alert-success mb-3';
        sucessoMsg.innerHTML = '<i class="bi bi-check-circle-fill"></i> Cadastro realizado com sucesso! Faça login para continuar.';
        form.insertBefore(sucessoMsg, form.firstChild);
        
        // Remover a mensagem após 5 segundos
        setTimeout(() => {
            sucessoMsg.remove();
        }, 5000);
    }
});