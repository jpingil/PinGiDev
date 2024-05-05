<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

declare(strict_types=1);

namespace Com\Daw2\Controllers;

/**
 * Controller class whith user methods
 * 
 * @author jpingil
 */
class AboutMeController extends \Com\Daw2\Core\BaseController {

    public function seeAbouMe() :void{
        $styles = ['AboutMe'];
        
        $data = [
            'styles' => $styles,
            'section' => 'AboutMe'
        ];
        
        $this->view->showViews(array('templates/Header.php', 'AboutMe.php', 'templates/Footer.php'), $data);
    }

}
