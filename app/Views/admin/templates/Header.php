<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="stylesheet" href="../../assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="../../assets/css/All.css"/>
        <link rel="stylesheet" href="../../assets/css/Admin.css"/>
        <?php
        if (isset($styles)) {
            foreach ($styles as $style) {
                ?>
                <link rel = "stylesheet" href = "../../assets/css/<?php echo $style; ?>.css" />
                <?php
            }
        }
        ?>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
            />
        <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css"/>
        <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min"/>
        <title>PinGiDev</title>
        <link rel="icon" href="../../assets/imgs/icon/PinGiDevMini.png">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="../../plugins/select2/js/select2.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.select2').select2();
            });
        </script>
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
                        <ul class="navbar-nav justify-content-end flex-grow-1">
                            <li class="nav-item">
                                <?php if ($_SESSION['user']['id_rol'] == 0) { ?>
                                    <a class="nav-link  <?php
                                    echo(isset($section) &&
                                    $section === 'AdminUsers') ? 'active' : '';
                                    ?>"" href="/AdminUsers">Users</a>
                                   <?php } else {
                                       ?>
                                    <a href="/" class="nav-link username"><?php echo $_SESSION['user']['user_name']; ?></a>
                                <?php } ?>
                            </li>
                            <?php if ($_SESSION['user']['id_rol'] == 0) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php
                                    echo(isset($section) &&
                                    $section === 'AdminProducts') ? 'active' : '';
                                    ?>" href="/AdminProducts">Products</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php
                                    echo(isset($section) &&
                                    $section === 'AdminOrders') ? 'active' : '';
                                    ?>" href="/AdminOrders">Orders</a>
                                </li>
                                <li>
                                    <a class="nav-link <?php
                                    echo(isset($section) &&
                                    $section === 'AdminLogs') ? 'active' : '';
                                    ?>" href="/AdminLogs">Logs</a>
                                </li>
                                <li>
                                    <a class="nav-link" href="/AboutMe">Web</a>
                                </li>
                                <li>
                                    <a class="nav-link <?php
                                    echo(isset($section) &&
                                    $section === 'LoginRegister') ? 'active' : '';
                                    ?>" href="<?php echo(!isset($_SESSION['user'])) ? '/LoginRegister' : '/Logout'; ?>">
                                        <?php echo(!isset($_SESSION['user'])) ? 'Login/Register' : 'Logout'; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>