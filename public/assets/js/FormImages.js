var imagePreview = document.getElementById("image-preview");

var imagesPreview = document.getElementById("images-preview");

document.getElementById("image").addEventListener("change", function () {
    var files = this.files;
    var img = document.createElement("img");
    var reader = new FileReader();

    if (imagePreview.querySelector('img')) {
        imagePreview.querySelector('img').remove();
    }

    reader.onload = function (e) {
        img.src = e.target.result;
    };


    reader.readAsDataURL(files[0]);
    imagePreview.appendChild(img);
});

document.getElementById("images").addEventListener("change", function () {
    var files = this.files;
    var imagesPreview = document.getElementById("images-preview");

    // Limpiar el contenedor de imágenes previas
    imagesPreview.innerHTML = '';

    // Iterar sobre cada archivo seleccionado
    for (var i = 0; i < files.length; i++) {
        var img = document.createElement("img");
        var reader = new FileReader();

        reader.onload = (function (image) {
            return function (e) {
                image.src = e.target.result;
            };
        })(img);

        reader.readAsDataURL(files[i]);
        imagesPreview.appendChild(img);
    }
});

