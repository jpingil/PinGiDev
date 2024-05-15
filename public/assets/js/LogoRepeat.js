document.addEventListener("DOMContentLoaded", function () {
    var logos = document.querySelectorAll('.logo');
    var slider = document.querySelector('.slider');
    for (var i = 0; i < 6; i++) {
        logos.forEach(function(logo) {
            var logoClone = logo.cloneNode(true);
            slider.appendChild(logoClone);
        });
    }
});
