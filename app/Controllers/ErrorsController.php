<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Controllers;

/**
 * Description of ErrorsController
 *
 * @author jorge
 */
class ErrorsController extends \Com\Daw2\Core\BaseController{

    function error404(): void {
        http_response_code(404);
        $data = ['titulo' => 'Error 404'];
        $data['texto'] = '404. File not found';
        $this->view->showViews(array('templates/header.view.php', 'Error.php', 'templates/footer.view.php'), $data);
    }

    function error405(): void {
        http_response_code(405);
        $data = ['titulo' => 'Error 405'];
        $data['texto'] = '405. Method not allowed';

        $this->view->showViews(array('templates/header.view.php', 'Error.php', 'templates/footer.view.php'), $data);
    }
}
