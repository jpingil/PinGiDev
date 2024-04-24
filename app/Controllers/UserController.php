<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Controllers;

/**
 * Description of UserController
 *
 * @author usuario
 */
class UserController extends \Com\Daw2\Core\BaseController {

    public function seeUsers(): void {
        $userModel = new \Com\Daw2\Models\UserModel();
        $users = $userModel->getAll();

        $data = [
            'section' => 'AdminUsers',
            'users' => $users
        ];

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminUsers.php', 'admin/templates/Footer.php'), $data);
    }

    public function seeAdd(): void {
        $userModel = new \Com\Daw2\Models\UserModel();
        $users = $userModel->getAll();

        $data = [
            'section' => 'AdminUsers',
            'users' => $users
        ];
        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminUsers.php', 'admin/templates/Footer.php'), $data);
    }
}
