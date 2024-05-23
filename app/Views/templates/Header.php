<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/css/All.css"/>
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
            <h1><a href="/"><img src="assets/imgs/icon/PinGiDev.png" alt="Principal icon of PinGiDev"></a></h1>
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
                                ?>" href="/AboutMe">About Us</a>
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
                                <a class="nav-link <?php echo (isset($_SESSION['user'])) ? 'user' : ''; ?>" 
                                   href="<?php echo(!isset($_SESSION['user'])) ? '/LoginRegister' : ''; ?>">
                                       <?php
                                       echo(!isset($_SESSION['user'])) ? 'Login/Register' : '<i class="fa-solid fa-gear"></i>';
                                       ?></a>
                                <?php if (isset($_SESSION['user'])) { ?>
                                    <ul class="userOptions">
                                        <div class="userOption">
                                            <a href="/Edit">Edit</a>
                                        </div>
                                        <div class="userOption">
                                            <a href="/Logout">Logout</a>
                                        </div>
                                    </ul>
                                <?php } ?>
                            </li>

                        </ul>
                    </div>
                </div>
            </nav>
        </header>