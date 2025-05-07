const hamburger = document.getElementById('hamburger');

hamburger.addEventListener('click', () => {
    hamburger.toggleAttribute('data-active');
    document.getElementById('sidebar-mb').toggleAttribute('data-active');
    document.getElementById('content').classList.toggle('opacity-40');
    if (document.body.style.overflow === 'hidden') {
        document.body.style.overflow = '';
    } else {
        document.body.style.overflow = 'hidden';
    }
})