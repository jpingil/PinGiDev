document.addEventListener("DOMContentLoaded", function () {

    //Fetch to favorites
    var favIcons = document.querySelectorAll(".btnFav");
    favIcons.forEach((favIcon) => {
        favIcon.addEventListener("click", function () {
            var idProduct = favIcon.id;
            fetch("/ProductFav", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id_product: idProduct,
                }),
            })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error("Response error.");
                        }
                        return response.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            if (data.action == "fav") {
                                favIcon.classList.remove("noFav");
                                favIcon.classList.add("fav");
                            }
                            if (data.action == "noFav") {
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

    //Fetch to ban users and products
    var bans = document.querySelectorAll(".btnBan");
    bans.forEach((ban) => {
        ban.addEventListener("click", function () {
            var idUser = ban.id;
            fetch("/AdminUsers/ban", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id_user: idUser,
                }),
            })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error("Response error.");
                        }
                        return response.json();
                    })
                    .then(function (data) {
                        console.log(data);
                        if (data.success) {
                            if (data.action == "ban") {
                                favIcon.classList.remove("on");
                                favIcon.classList.add("off");
                            }
                            if (data.action == "noBan") {
                                favIcon.classList.remove("off");
                                favIcon.classList.add("on");
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error("Error: " + error);
                    });
        });
    });
});
