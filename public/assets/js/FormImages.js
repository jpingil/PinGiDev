var imagePreview = document.getElementById("image-preview");
console.log("hola");
document.getElementById("image").addEventListener("change", function () {
    console.log("estamos");
    var files = this.files;
    var img = document.createElement("img");
    var reader = new FileReader();

    //If exists other img, we remove that img
    if (imagePreview.querySelector('img')) {
        imagePreview.querySelector('img').remove();
    }

    reader.onload = function (e) {
        img.src = e.target.result;
    };

    reader.readAsDataURL(files[0]);
    imagePreview.appendChild(img);
});