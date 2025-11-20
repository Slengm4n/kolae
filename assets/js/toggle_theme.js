
    // --- LÓGICA DE GERENCIAMENTO DE TEMA (O Toggle) ---
    // A função que realmente aplica ou remove a classe 'dark'
    function applyTheme(theme) {
        const html = document.documentElement;
        // Adicionando a classe de transição aqui para garantir que ela esteja sempre presente antes da troca
        html.classList.add('transition-colors', 'duration-500'); 

        if (theme === 'dark') {
            html.classList.add('dark');
            localStorage.setItem('theme', 'dark');
        } else {
            html.classList.remove('dark');
            localStorage.setItem('theme', 'light');
        }
    }

    // Função que aplica o tema inicial ao carregar o DOM
    function initializeTheme() {
        const savedTheme = localStorage.getItem('theme');
        let initialTheme;

        if (savedTheme) {
            initialTheme = savedTheme;
        } else {
            const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            initialTheme = systemPrefersDark ? 'dark' : 'light';
        }

        // Aplica o tema inicial na tag <html>
        applyTheme(initialTheme);
        
        // Adiciona o listener ao botão
        const themeToggle = document.getElementById('theme-toggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.classList.contains('dark') ? 'dark' : 'light';
                const newTheme = currentTheme === 'light' ? 'dark' : 'light';
                applyTheme(newTheme);
            });
        }
    }
    
    // Inicializa o tema quando o DOM estiver pronto
    document.addEventListener('DOMContentLoaded', initializeTheme);
