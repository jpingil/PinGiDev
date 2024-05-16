<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Controllers;

/**
 * Description of InitController
 *
 * @author jorge
 */
class InitController extends \Com\Daw2\Core\BaseController {

    public function see() {
        $productModel = new \Com\Daw2\Models\ProductModel();

        $jss = ['LogoRepeat'];
        $styles = ['Init'];

        $data = [
            'section' => 'Init',
            'styles' => $styles,
            'products' => $productModel->getSomeProducts(),
            'jss' => $jss
        ];

        $this->view->showViews(array('templates/Header.php', 'Init.php', 'templates/Footer.php'), $data);
    }
}
