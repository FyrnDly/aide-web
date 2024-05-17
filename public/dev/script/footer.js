// Footer check bottom position
window.addEventListener('load', function () {
    // Get Footer element
    var footer = document.querySelector('footer');
    var footerPosition = footer.offsetTop;
    var footerSizeHeight = footer.offsetHeight;
    var checkBottom = window.innerHeight - footerPosition;
    // Add class fix-bottom
    if (checkBottom >= footerSizeHeight) {
        footer.classList.add('fixed-bottom');
    };
});