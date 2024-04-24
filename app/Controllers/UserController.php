<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

declare(strict_types=1);

namespace Com\Daw2\Controllers;

/**
 * Description of UserController
 *
 * @author usuario
 */
class UserController extends \Com\Daw2\Core\BaseController {

    public function seeLoginRegister(array $errors = null, array $postData = null): void {
        $data = [
            'section' => 'LoginRegister'
        ];
        if (!is_null($errors) && !empty($errors)) {
            $data['errors'] = $errors;
        }
        if (!is_null($postData) && !empty($postData)) {
            $data['data'] = $postData;
        }

        //        var_dump($postData);
        //        var_dump($errors);
        //        die();
        $this->view->showViews(array('templates/Header.php', 'LoginRegister.php', 'templates/Footer.php'), $data);
    }

    public function processRegister(): void {
        $errors = $this->checkRegister($_POST);
        if (empty($errors)) {
            $userModel = new \Com\Daw2\Models\UserModel();
            $userModel->register($_POST);
            $user = $userModel->getUserByEmail($_POST['email']);
            if (is_null($user)) {
                $errors['login'] = 'Unexpected error';
            } else {
                $_SESSION['user'] = $user;
                header('Location: /AboutMe');
            }
        }


        $postData = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->seeLoginRegister($errors, $postData);
    }

    private function checkRegister(array $data): array {
        $errors = [];
        if (empty($data['userName']) || empty($data['email']) ||
                empty($data['pass']) || empty($data['pass2'])) {
            $errors['register'] = 'There are empty values.';
        } else {
            if (!preg_match('/^[a-zA-Z0-9_]{4,15}$/', $data['userName'])) {
                $errors['register'] = 'The username can only contain numbers, '
                        . 'letters, underscores, and must be between 4 and 15 characters.';
            }
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['register'] = 'The email is not valid.';
            }

            $userModel = new \Com\Daw2\Models\UserModel();
            if (!is_null($userModel->getUserByEmail($data['email']))) {
                $errors['register'] = 'That email is already in use.';
            }
            if (!preg_match('/^.{8,18}$/', $data['pass'])) {
                $errors['register'] = 'The password must be between 8 and 18 characters long.';
            }
            if ($data['pass'] !== $data['pass2']) {
                $errors['register'] = 'The passwords must match.';
            }
        }
        return $errors;
    }

    public function processLogin() {
        $errors = $this->checkLogin($_POST);

        if (empty($errors)) {
            $userModel = new \Com\Daw2\Models\UserModel();
            $user = $userModel->login($_POST['email'], $_POST['pass']);
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