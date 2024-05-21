document.addEventListener("DOMContentLoaded", function () {
    var activeElement = document.querySelector(".active");
    if (activeElement.previousElementSibling) {
        activeElement.previousElementSibling.classList.add("liBefore");
    }
});