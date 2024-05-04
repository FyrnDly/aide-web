// Target Heading
const links = document.querySelectorAll('a[href^="#"]')

links.forEach(link => {
    link.addEventListener('click', function (event) {
        event.preventDefault();

        links.forEach(
            link => link.classList.remove('active')
        );

        this.classList.add('active');
        if (this.getAttribute('href') === '#') {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        } else {
            const target = document.querySelector(this.getAttribute('href'))
            const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - 95;
            window.scrollTo({
                top: targetPosition,
                behavior: 'smooth'
            });
        };
    });
});


// Navbar Background Animation
window.addEventListener('scroll', function () {
    const nav = document.querySelector('header');
    if (window.pageYOffset > 0) {
        nav.classList.add('bg-nav');
    } else {
        nav.classList.remove('bg-nav');
    }
});
