// darkMode.js
document.addEventListener('DOMContentLoaded', function() {
    const darkModeToggle = document.querySelector('.dark-mode-toggle');
    const body = document.body;

    // Vérifie si l'utilisateur a déjà une préférence de mode
    const isDarkMode = localStorage.getItem('darkMode') === 'enabled';

    // Applique le mode sombre si activé
    if (isDarkMode) {
        body.classList.add('dark-mode');
    }

    // Bascule entre les modes clair et sombre
    darkModeToggle.addEventListener('click', function() {
        body.classList.toggle('dark-mode');
        const isDarkMode = body.classList.contains('dark-mode');
        localStorage.setItem('darkMode', isDarkMode ? 'enabled' : 'disabled');
    });
});