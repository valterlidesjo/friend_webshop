document.addEventListener('DOMContentLoaded', function() {
    
    const button = document.querySelector('.scroll-btn'); 

    button.addEventListener('click', function() {
        const targetElement = document.getElementById('more');

        targetElement.scrollIntoView({
            behavior: 'smooth',  
            block: 'start'
        });
    });
});
