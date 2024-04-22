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

    public function seeLoginRegister(): void {
        $data = [
            'section' => 'LoginRegister'
        ];

        $this->view->showViews(array('templates/Header.php', 'LoginRegister.php', 'templates/Footer.php'), $data);
    }

    public function processRegister(): void {
        $errors = $this->checkRegister($_POST);
        if (empty($errors)) {
            $userModel = new \Com\Daw2\Models\UserModel();
            $userModel->register($_POST);
            $user = $userModel->getUserByEmail($_POST['email']);
            if (is_null($user)) {
                $errors['loginErrors'] = 'Unexpected error';
            } else {
                $_SESSION['user'] = $user;
                header('Location: /AboutMe');
            }
        }

        $data = [
            'section' => 'LoginRegister',
            'errors' => $errors,
            'data' => filter_var($_POST, FILTER_SANITIZE_SPECIAL_CHARS)
        ];

        $this->view->showViews(array('templates/Header.php', 'LoginRegister.php', 'templates/Footer.php'), $data);
    }

    private function checkRegister(array $data): array {
        $errors = [];
        if (!isset($data['userName']) || !isset($data['email']) ||
                !isset($data['pass']) || !isset($data['pass2'])) {
            $errors['registerErrors'] = 'There are empty values.';
        } else {
            if (!filter_var($data['userName'], FILTER_SANITIZE_STRING) ||
                    !filter_var($data['pass'], FILTER_SANITIZE_EMAIL) ||
                    !filter_var($data['pass'], FILTER_SANITIZE_STRING) ||
                    !filter_var($data['pass2'], FILTER_SANITIZE_STRING)) {
                $errors['registerErrors'] = 'Invalid data.';
            } else {
                $userModel = new \Com\Daw2\Models\UserModel();

                if (!is_null($userModel->getUserByEmail($data['email']))) {
                    $errors['registerErrors'] = 'That email is already in use.';
                } else {
                    if ($data['pass'] !== $data['pass2']) {
                        $errors['registerErrors'] = "Passwords don't match.";
                    }
                }
            }
        }
        return $errors;
    }
    
    public function logout() :void{
        
    }
}
