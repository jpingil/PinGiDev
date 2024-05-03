document.addEventListener("DOMContentLoaded", function () {
    var favIcons = document.querySelectorAll(".btnFav");
    favIcons.forEach((favIcon) => {
        favIcon.addEventListener("click", function () {
            var idProduct = this.id;
            fetch("/ProductFav", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    idProduct: idProduct,
                }),
            })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error("Error in response.");
                        }
                        return response.json();
                    })
                    .then(function (response) {
                        if (response.success) {
                            if (response.action == "fav") {
                                favIcon.classList.remove("noFav");
                                favIcon.classList.add("fav");
                            }
                            if (response.action == "noFav") {
                                favIcon.classList.remove("fav");
                                favIcon.classList.add("noFav");
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error("Error: " + error);
                    });
        });
    });
});
