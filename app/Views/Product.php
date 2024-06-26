<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/All.css"/>
        <?php
        if (isset($styles)) {
            foreach ($styles as $style) {
                ?>
                <link rel = "stylesheet" href = "../../assets/css/<?php echo $style; ?>.css" />
                <?php
            }
        }
        ?>       
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"/>
        <title>PinGiDev</title>
        <link rel="icon" href="assets/imgs/icon/PinGiDevMini.png">
    </head>
    <body>
        <header>
            <h1><a href="/"><img src="../../assets/imgs/icon/PinGiDev.png" alt="Principal icon of PinGiDev"></a></h1>
            <nav class="navbar navbar-expand-lg navbar-dark">
                <button
                    class="navbar-toggler shadow-none border-0"
                    type="button"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasDarkNavbar"
                    aria-controls="offcanvasDarkNavbar"
                    aria-label="Toggle navigation"
                    >
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div
                    class="offcanvas offcanvas-end bg-black text-bg-dark"
                    tabindex="-1"
                    id="offcanvasDarkNavbar"
                    aria-labelledby="offcanvasDarkNavbarLabel"
                    >
                    <div class="offcanvas-header">
                        <button
                            type="button"
                            class="btn-close btn-close-white border-0 shadow-none"
                            data-bs-dismiss="offcanvas"
                            aria-label="Close"
                            ></button>
                    </div>
                    <div class="offcanvas-body">
                        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                            <li class="nav-item">
                                <a class="nav-link <?php
                                echo(isset($section) &&
                                $section === 'Init') ? 'active' : '';
                                ?>" href="/Hello">Hello</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php
                                echo(isset($section) &&
                                $section === 'AboutMe') ? 'active' : '';
                                ?>" href="/AboutMe">About Me</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?php
                                echo(isset($section) &&
                                $section === 'Products') ? 'active' : '';
                                ?>" href="/Products">Products</a>
                            </li>
                            <li>
                                <a class="nav-link <?php
                                echo(isset($section) &&
                                $section === 'Favorites') ? 'active' : '';
                                ?>" href="/Favorites">Favorites</a>
                            </li>
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['rol_name'] == 'admin') { ?>
                                <li>
                                    <a class="nav-link" href="/Management">Management</a>
                                </li>
                                <?php
                            }
                            ?>
                            <li>
                                <a class="nav-link <?php
                                echo(isset($section) &&
                                $section === 'LoginRegister') ? 'active' : '';
                                ?>" href="<?php echo(!isset($_SESSION['user'])) ? '/LoginRegister' : '/Logout'; ?>">
                                    <?php echo(!isset($_SESSION['user'])) ? 'Login/Register' : 'Logout'; ?></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <main>
            <article>
                <section class="productContainer">
                    <div class="product">
                        <img src="<?php
                        echo '../../assets/' . $product['img_folder'] . '/Main Image/' .
                        $product['product_name'] . '.' . $product['img_extension'];
                        ?>" alt="<?php echo $product['product_description']; ?>" class="d-block w-100" id="producImg">
                        <form action="/Order/<?php echo $product['id_product']; ?>" method="post">
                            <div class="product-info">
                                <div class="infoContainer">
                                    <div>
                                        <h3><?php echo $product['product_name']; ?></h3>
                                        <a <?php echo (!isset($_SESSION['user'])) ? 'href="/Login"' : 'disabled'; ?>>
                                            <i class="fa-solid fa-heart btnFav <?php
                                            if (isset($_SESSION['user'])) {
                                                if ($fav) {
                                                    echo 'fav';
                                                }
                                            } else {
                                                echo 'noFav';
                                            }
                                            ?>"  id="<?php echo $product['id_product']; ?>"></i>
                                        </a>
                                    </div>
                                    <p><?php echo $product['product_description']; ?></p>
                                </div>
                                <div class="description form-floating ">
                                    <textarea
                                        class="form-control"
                                        name="order_description"
                                        id="floatingarea"
                                        cols="30"
                                        rows="10"
                                        placeholder="Order Description"
                                        ></textarea>
                                    <label for="floatingarea">Order Description</label>
                                </div>
                                <p><?php
                                    if (isset($errors['order_description'])) {
                                        echo $errors['order_description'];
                                    }
                                    ?></p>
                                <button class="orderBtn">Order</button>
                            </div>
                        </form>
                    </div>
                </section>
                <?php
                if (isset($length) && $length > 1) {
                    ?>
                    <section>
                        <h3>More products</h3>
                        <div class="products">
                            <?php
                            for ($i = 0; $i < $length; $i++) {

                                if ($products[$i]['id_product'] !== $product['id_product']) {
                                    ?>
                                    <div class="productCard">
                                        <a href="/Product/<?php echo $products[$i]['id_product']; ?>">
                                            <img src="../../assets/<?php echo $products[$i]['img_folder'] . '/Main Image/' . $products[$i]['product_name'] . '.' . $products[$i]['img_extension']; ?>" alt="<?php echo $products[$i]['product_description']; ?>"/>
                                        </a>
                                        <div class="button-container">
                                            <h3><?php echo $products[$i]['product_name']; ?></h3>
                                            <a <?php echo (!isset($_SESSION['user'])) ? 'href="/LoginRegister"' : 'disabled'; ?>>
                                                <i class="fa-solid fa-heart btnFav <?php
                                                if (isset($_SESSION['user'])) {
                                                    foreach ($favsProducts as $favProduct) {
                                                        if ($favProduct['id_product'] == $products[$i]['id_product']) {
                                                            echo 'fav';
                                                        }
                                                    }
                                                } else {
                                                    echo 'noFav';
                                                }
                                                ?>"  id="<?php echo $products[$i]['id_product']; ?>"></i>
                                            </a>
                                        </div>
                                        <div class="moreInformation">
                                            <a href="/Product/<?php echo $products[$i]['id_product']; ?>">More information</a>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </section>
                <?php } ?>
            </article>
        </main>
        <footer>
            <div class="legal">
                <a href="">Legal Notices</a></p>
                <a href="">Privacity</a></p>
                <a href="">Contact</a></p>
            </div>
            <p id="copyright">© Creative Commons</p>
            <div class="contact">
                <a href="https://www.instagram.com/" class="fa-brands fa-instagram icon" style="color: #ffffff"></a>
                <i class="fa-brands fa-github icon" style="color: #ffffff"></i>
                <i class="fa-regular fa-envelope icon" style="color: #ffffff"></i>
            </div>
        </footer>
        <script src="../assets/js/bootstrap.min.js"></script>
        <?php
        if (isset($jss)) {
            foreach ($jss as $js) {
                ?>
                <script src="../assets/js/<?php echo $js ?>.js"></script>
                <?php
            }
        }
        ?>
    </body>
</html>