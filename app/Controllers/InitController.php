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
        $styles = ['Init'];
        $data = ['styles' => $styles];
        $data['section'] = 'Init';
        
        $this->view->showViews(array('templates/Header.php', 'Init.php', 'templates/Footer.php'), $data);
    }
}
