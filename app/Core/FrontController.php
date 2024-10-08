<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {
        session_start();

        Route::add('/',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InitController();
                    $controlador->see();
                }
                , 'get');

        Route::add('/Hello',
                function () {
                    $controlador = new \Com\Daw2\Controllers\InitController();
                    $controlador->see();
                }
                , 'get');

        Route::add('/AboutMe',
                function () {
                    $controlador = new \Com\Daw2\Controllers\AboutMeController();
                    $controlador->seeAbouMe();
                }
                , 'get');

        Route::add('/Products',
                function () {
                    $controlador = new \Com\Daw2\Controllers\ProductController();
                    $controlador->seeProducts();
                }
                , 'get');

        Route::add('/Product/([0-9]+)',
                function ($id) {
                    $controlador = new \Com\Daw2\Controllers\ProductController();
                    $controlador->seeProduct($id);
                }
                , 'get');

        Route::add('/seeLoginRegister',
                function () {
                    $controlador = new \Com\Daw2\Controllers\UserController();
                    $controlador->seeLoginRegister();
                }
                , 'post');

        if (isset($_SESSION['user'])) {
            Route::add('/CustomProduct',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\CustomProductController();
                        $controlador->seeCustomProduct();
                    }
                    , 'get');

            Route::add('/Logout',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->logout();
                    }
                    , 'get');

            Route::add('/ProductFav',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\FavoriteController();
                        $controlador->changeFav();
                    }
                    , 'post');

            Route::add('/Favorites',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\FavoriteController();
                        $controlador->seeFavorites();
                    }
                    , 'get');

            Route::add('/Order/([0-9]+)',
                    function ($idProduct) {
                        $controlador = new \Com\Daw2\Controllers\OrderController();
                        $controlador->processOrder($idProduct);
                    }
                    , 'post');

            Route::add('/Edit',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->seeEdit($_SESSION['user']['id_user'], true);
                    }
                    , 'get');

            Route::add('/Edit',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->processEdit($_SESSION['user']['id_user'], true);
                    }
                    , 'post');

            if ($_SESSION['user']['rol_name'] == 'admin') {
                Route::add('/Management',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->seeUsers();
                        }
                        , 'get');

                Route::add('/AdminUsers',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->seeUsers();
                        }
                        , 'get');

                Route::add('/AdminUsers/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->seeAdd();
                        }
                        , 'get');

                Route::add('/AdminUsers/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->processAdd();
                        }
                        , 'post');

                Route::add('/AdminUsers/edit/([0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->seeEdit($id);
                        }
                        , 'get');

                Route::add('/AdminUsers/edit/([0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->processEdit($id);
                        }
                        , 'post');

                Route::add('/AdminUsers/ban',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->banUser();
                        }
                        , 'post');

                Route::add('/AdminUsers/ban',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->banUser();
                        }
                        , 'post');

                Route::add('/AdminUsers/delete/([0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->deleteUser($id);
                        }
                        , 'get');

                Route::add('/AdminUsers/filter',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\UserController();
                            $controlador->processFilter();
                        }
                        , 'get');

                Route::add('/AdminProducts',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->seeAdminProducts();
                        }
                        , 'get');

                Route::add('/AdminProducts/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->seeAdd();
                        }
                        , 'get');

                Route::add('/AdminProducts/add',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->processAdd();
                        }
                        , 'post');

                Route::add('/AdminProducts/edit/([0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->seeEdit($id);
                        }
                        , 'get');

                Route::add('/AdminProducts/edit/([0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->processEdit($id);
                        }
                        , 'post');

                Route::add('/AdminProducts/ban',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->banProduct();
                        }
                        , 'post');

                Route::add('/AdminProducts/delete/([0-9]+)',
                        function ($idProduct) {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->deleteProduct($idProduct);
                        }
                        , 'get');

                Route::add('/AdminProducts/filter',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\ProductController();
                            $controlador->processFilter();
                        }
                        , 'get');

                Route::add('/AdminLogs',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\LogController();
                            $controlador->seeLogs();
                        }
                        , 'get');

                Route::add('/AdminLogs/filter',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\LogController();
                            $controlador->processFilter();
                        }
                        , 'get');

                Route::add('/AdminOrders',
                        function () {
                            $controlador = new \Com\Daw2\Controllers\OrderController();
                            $controlador->seeAdminOrders();
                        }
                        , 'get');

                Route::add('/AdminOrders/edit/([0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\OrderController();
                            $controlador->seeEdit($id);
                        }
                        , 'get');

                Route::add('/AdminOrders/edit/([0-9]+)',
                        function ($id) {
                            $controlador = new \Com\Daw2\Controllers\OrderController();
                            $controlador->processEdit($id);
                        }
                        , 'post');

                Route::add('/AdminOrders/delete/([0-9]+)',
                        function ($idOrder) {
                            $controlador = new \Com\Daw2\Controllers\OrderController();
                            $controlador->deleteOrder($idOrder);
                        }
                        , 'get');
            }
        } else {
            Route::add('/Login',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->seeLogin();
                    }
                    , 'get');

            Route::add('/Favorites',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->seeLogin();
                    }
                    , 'get');

            Route::add('/CustomProduct',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->seeLogin();
                    }
                    , 'get');

            Route::add('/Register',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->processRegister();
                    }
                    , 'post');

            Route::add('/Login',
                    function () {
                        $controlador = new \Com\Daw2\Controllers\UserController();
                        $controlador->processLogin();
                    }
                    , 'post');
        }


        Route::pathNotFound(
                function () {
                    header("Location: /");
                }
        );

        Route::run();
    }
}
