<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Controllers;

/**
 * Description of LoginRegisterController
 *
 * @author jorge
 */
class LoginRegisterController extends \Com\Daw2\Core\BaseController {

    public function seeLoginRegister() :void{
        $data = [
            'section' => 'LoginRegister'
        ];

        $this->view->showViews(array('templates/Header.php', 'LoginRegister.php', 'templates/Footer.php'), $data);
    }
}
