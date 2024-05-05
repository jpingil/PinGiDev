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
                        console.log(data);
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
    bans.forEach(function (ban) {
        ban.addEventListener("click", function () {
            var idUser = this.id;

            fetch("/AdminUser/ban", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    id_user: idUser,
                }),
            })
                    .then(function (response) {
                        if (!response) {
                            throw new Error("Error in response.");
                        }

                        return response.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            if (data.action === "ban") {
                                ban.classList.remove("noBan");
                                ban.classList.add("ban");
                            }
                            if (data.action === "noBan") {
                                ban.classList.remove("ban");
                                ban.classList.add("noBan");
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error("Error " + error);
                    });
        });
    });
});
