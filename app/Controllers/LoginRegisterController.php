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

    public function seeLoginRegister(array $errores = null): void {
        $data = [
            'section' => 'LoginRegister'
        ];
        if (!is_null($errors) && !empty($errors)) {
            $data['errors'] = $errors;
        }
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

        $this->seeLoginRegister($errors);
    }

    private function checkRegister(array $data): array {
        $errors = [];
        if (empty($data['userName']) || empty($data['email']) ||
                empty($data['pass']) || empty($data['pass2'])) {
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

    public function processLogin() {
        $errors = $this->checkLogin($_POST);

        if (empty($errors)) {
            $userModel = new \Com\Daw2\Models\UserModel();
            $user = $userModel->getUserByEmail($_POST['email']);
            if (is_null($user)) {
                $errors['login'] = 'There is no registered user with this data.';
            } else {
                $_SESSION['user'] = $user;
                header('Location:/AboutMe');
            }
        }

        $this->seeLoginRegister($errors);
    }

    private function checkLogin(array $data): array {
        $errors = [];

        if (empty($data['email']) || empty($data['pass'])) {
            $errors['login'] = 'There are empty values.';
        } else {
            if (!filter_var($data['email'], FILTER_SANITIZE_EMAIL)) {
                $errors['login'] = 'Invalid data.';
            }
        }

        return $errors;
    }

    public function logout(): void {
        session_destroy();
        header('Location:/LoginRegister');
    }
}
