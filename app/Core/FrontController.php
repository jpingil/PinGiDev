<?php

namespace Com\Daw2\Core;

use Steampixel\Route;

class FrontController {

    static function main() {

        Route::add('/',
                function () {
                    $controlador = new \Com\Daw2\Controllers\AboutMeController();
                    $controlador->seeView();
                }
                , 'get');
    }
}
