document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('cadastroForm');
    
    // Máscaras para os campos
    const cpfInput = document.getElementById('cpf');
    const telefoneInput = document.getElementById('telefone');
    
    cpfInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 11) value = value.slice(0, 11);
        
        if (value.length > 9) {
            this.value = value.replace(/(\d{3})(\d{3})(\d{3})(\d{2})/, '$1.$2.$3-$4');
        } else if (value.length > 6) {
            this.value = value.replace(/(\d{3})(\d{3})(\d+)/, '$1.$2.$3');
        } else if (value.length > 3) {
            this.value = value.replace(/(\d{3})(\d+)/, '$1.$2');
        } else {
            this.value = value;
        }
    });
    
    telefoneInput.addEventListener('input', function() {
        let value = this.value.replace(/\D/g, '');
        if (value.length > 11) value = value.slice(0, 11);
        
        if (value.length > 6) {
            this.value = value.replace(/(\d{2})(\d{5})(\d+)/, '($1) $2-$3');
        } else if (value.length > 2) {
            this.value = value.replace(/(\d{2})(\d+)/, '($1) $2');
        } else {
            this.value = value;
        }
    });
    
    // Validação do formulário
    form.addEventListener('submit', function(event) {
        let isValid = true;
        
        // Reset anterior
        form.querySelectorAll('.is-invalid').forEach(field => {
            field.classList.remove('is-invalid');
        });
        document.getElementById('cadastroError').classList.add('d-none');
        
        // Validar nome
        const nome = document.getElementById('nome');
        if (!nome.value || nome.value.length < 3) {
            nome.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validar CPF
        const cpf = document.getElementById('cpf');
        if (!cpf.value || !validarCPF(cpf.value)) {
            cpf.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validar email
        const email = document.getElementById('email');
        if (!email.value || !isValidEmail(email.value)) {
            email.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validar senha
        const senha = document.getElementById('senha');
        if (!senha.value || senha.value.length < 6) {
            senha.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validar confirmação de senha
        const confirmarSenha = document.getElementById('confirmarSenha');
        if (senha.value !== confirmarSenha.value) {
            confirmarSenha.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validar telefone (não é obrigatório, mas se preenchido deve ser válido)
        const telefone = document.getElementById('telefone');
        if (telefone.value && !validarTelefone(telefone.value)) {
            telefone.classList.add('is-invalid');
            isValid = false;
        }
        
        // Validar termos
        const termosCheckbox = document.getElementById('aceite_termos');
        if (!termosCheckbox.checked) {
            termosCheckbox.parentElement.querySelector('.invalid-feedback').style.display = 'block';
            isValid = false;
        }
        
        // Se houver erros, impedir o envio do formulário
        if (!isValid) {
            event.preventDefault();
            document.getElementById('mensagemErro').textContent = 'Por favor, corrija os erros no formulário.';
            document.getElementById('cadastroError').classList.remove('d-none');
        } else {
            // Verificar se o email já está em uso (simulação)
            if (email.value === 'existente@exemplo.com') {
                email.classList.add('is-invalid');
                document.getElementById('mensagemErro').textContent = 'Este email já está cadastrado.';
                document.getElementById('cadastroError').classList.remove('d-none');
                event.preventDefault();
            }
        }
    });
    
    // Função para validar formato de email
    function isValidEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }
    
    // Função para validar CPF
    function validarCPF(cpf) {
        cpf = cpf.replace(/[^\d]/g, '');
        
        if (cpf.length !== 11 || /^(\d)\1{10}$/.test(cpf)) return false;
        
        let soma = 0;
        let resto;
        
        for (let i = 1; i <= 9; i++) 
            soma = soma + parseInt(cpf.substring(i-1, i)) * (11 - i);
        
        resto = (soma * 10) % 11;
        
        if ((resto == 10) || (resto == 11)) resto = 0;
        if (resto != parseInt(cpf.substring(9, 10))) return false;
        
        soma = 0;
        for (let i = 1; i <= 10; i++) 
            soma = soma + parseInt(cpf.substring(i-1, i)) * (12 - i);
        
        resto = (soma * 10) % 11;
        
        if ((resto == 10) || (resto == 11)) resto = 0;
        if (resto != parseInt(cpf.substring(10, 11))) return false;
        
        return true;
    }
    
    // Função para validar telefone
    function validarTelefone(telefone) {
        const regex = /^\(\d{2}\) \d{5}-\d{4}$/;
        return regex.test(telefone);
    }
    
    // Remover classes de erro quando o usuário começa a digitar novamente
    form.querySelectorAll('input, select').forEach(input => {
        input.addEventListener('input', function() {
            this.classList.remove('is-invalid');
            document.getElementById('cadastroError').classList.add('d-none');
        });
    });
    
    // Validação específica para confirmar senha
    document.getElementById('confirmarSenha').addEventListener('input', function() {
        const senha = document.getElementById('senha').value;
        if (this.value && senha !== this.value) {
            this.classList.add('is-invalid');
        } else {
            this.classList.remove('is-invalid');
        }
    });
});