<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

declare(strict_types=1);

namespace Com\Daw2\Controllers;

/**
 * Description of CustomProductController
 *
 * @author jorge
 */
class CustomProductController extends \Com\Daw2\Core\BaseController {

    public function seeCustomProduct(): void {
        $data = [
            'section' => 'CustomProduct'
        ];

        $this->view->showViews(array('templates/Header.php', 'CustomProduct.php', 'templates/Footer.php'), $data);
    }
}
