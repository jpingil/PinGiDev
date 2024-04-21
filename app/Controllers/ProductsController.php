<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Controllers;

/**
 * Description of ProductController
 *
 * @author jorge
 */
class ProductsController extends \Com\Daw2\Core\BaseController{

    public function seeProducts() :void{
        $data = [
            'section' => 'Products'
        ];
        
        $this->view->showViews(array('templates/Header.php', 'Products.php', 'templates/Footer.php'), $data);
    }
}
