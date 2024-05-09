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
        <link rel="icon" href="../../assets/imgs/icon/PinGiDevMini.png">
    </head>
    <body>
        <header>
            <h1><a href="Aboutme.html"><img src="../../assets/imgs/icon/PinGiDev.png" alt="Principal icon of PinGiDev"></a></h1>
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
                <h2>Product</h2>
                <div class="product" >
                    <img src="<?php
                    echo '../../assets/' . $product['img_folder'] . '/Main Image/' .
                    $product['product_name'] . '.' . $product['img_extension'];
                    ?>" alt="<?php echo $product['product_description']; ?>" class="d-block w-100" id="product">

                    <button class="carousel-control-prev" type="button" data-bs-target="#product" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#product" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
                <form action="/Order/<?php echo $product['id_product'];?>" method="post">
                    <div class="description form-floating">
                        <textarea
                            class="form-control"
                            name="description"
                            id="floatingarea"
                            cols="30"
                            rows="10"
                            placeholder="Product description"
                            ></textarea>
                        <label for="floatingarea">Description</label>
                    </div>
                    <button class="form-btn">Enviar</button>
                </form>
            </article>
        </main>
        <footer>
            <div class="legal">
                <p id="legalNotices"><a href="">Legal Notices</a></p>
                <p id="privacity"><a href="">Privacity</a></p>
                <p id="moreContact">Telf: 645949745</p>
            </div>
            <p id="copyright">© Creative Commons</p>
            <div class="contact">
                <i class="fa-brands fa-instagram icon" style="color: #ffffff"></i>
                <i class="fa-brands fa-github icon" style="color: #ffffff"></i>
                <i class="fa-regular fa-envelope icon" style="color: #ffffff"></i>
            </div>
        </footer>
        <script src="assets/js/bootstrap.min.js"></script>
        <?php
        if (isset($jss)) {
            foreach ($jss as $js) {
                ?>
                <script src="../../assets/js/<?php echo $js ?>.js"></script>
                <?php
            }
        }
        ?>
    </body>
</html>