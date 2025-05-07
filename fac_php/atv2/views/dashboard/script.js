// Simulação de dados para o gráfico
document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('emprestimosChart').getContext('2d');

    // Dados de exemplo para o gráfico
    const data = {
        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun'],
        datasets: [{
            label: 'Empréstimos',
            data: [65, 78, 52, 91, 43, 56],
            backgroundColor: 'rgba(59, 130, 246, 0.2)',
            borderColor: 'rgba(59, 130, 246, 1)',
            borderWidth: 2,
            tension: 0.3
        },
        {
            label: 'Devoluções',
            data: [42, 55, 40, 80, 31, 45],
            backgroundColor: 'rgba(16, 185, 129, 0.2)',
            borderColor: 'rgba(16, 185, 129, 1)',
            borderWidth: 2,
            tension: 0.3
        }
        ]
    };

    // Configurações do gráfico
    const config = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    };

    // Criar o gráfico
    new Chart(ctx, config);
});