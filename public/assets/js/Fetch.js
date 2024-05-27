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
    bans.forEach((ban) => {
        ban.addEventListener("click", function () {

            //This is done to avoid repeating code.
            var data = this.id.split('-');
            var id = '';
            if (data[0] == 'AdminUsers') {
                id = 'id_user';
            } else if (data[0] == 'AdminProducts') {
                id = 'id_product';
            }
            var jsonObject = {};
            jsonObject[id] = data[1];

            fetch("/" + data[0] + "/ban", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(jsonObject),
            })
                    .then(function (response) {
                        if (!response.ok) {
                            throw new Error("Response error.");
                        }
                        return response.json();
                    })
                    .then(function (data) {
                        if (data.success) {
                            if (data.action == "ban") {
                                ban.classList.remove("fa-toggle-on");
                                ban.classList.add("fa-toggle-off");
                            }
                            if (data.action == "noBan") {
                                ban.classList.remove("fa-toggle-off");
                                ban.classList.add("fa-toggle-on");
                            }
                        }
                    })
                    .catch(function (error) {
                        console.error("Error: " + error);
                    });
        });
    });
});
