document.addEventListener("DOMContentLoaded", function () {
    var activeA = document.querySelector(".active");
    var activeLi = activeA.parentNode;
    if (activeLi.previousElementSibling) {
        activeLi.previousElementSibling.firstElementChild.classList.add("liBefore");
    }
    if (activeLi.nextElementSibling) {
        activeLi.nextElementSibling.firstElementChild.classList.add("liNext");
    }
});