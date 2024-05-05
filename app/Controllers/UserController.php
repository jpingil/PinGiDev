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
        $styles = ['LoginRegister'];

        $data = [
            'styles' => $styles,
            'section' => 'LoginRegister'
        ];
        if (!is_null($errors) && !empty($errors)) {
            $data['errors'] = $errors;
        }
        if (!is_null($postData) && !empty($postData)) {
            $data['data'] = $postData;
        }

        $this->view->showViews(array('templates/Header.php', 'LoginRegister.php', 'templates/Footer.php'), $data);
    }

    public function processRegister(): void {
        $errors = $this->checkRegister();
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

    private function checkRegister(bool $edit = false): array {
        $errors = [];

        if (empty($_POST['user_name']) || empty($_POST['email']) ||
                empty($_POST['pass']) || empty($_POST['pass2'])) {
            $errors['register'] = 'There are empty values.';
        } else {
            if (!preg_match('/^[a-zA-Z0-9_]{4,15}$/', $_POST['user_name'])) {
                $errors['register'] = 'The username can only contain numbers, '
                        . 'letters, underscores, and must be between 4 and 15 characters.';
            }
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['register'] = 'The email is not valid.';
            }

            $userModel = new \Com\Daw2\Models\UserModel();
            if (!$edit) {
                if (!is_null($userModel->getUserByEmail($_POST['email']))) {
                    $errors['register'] = 'That email is already in use.';
                }
            }

            if (!preg_match('/^.{8,18}$/', $_POST['pass'])) {
                $errors['register'] = 'The password must be between 8 and 18 characters long.';
            }
            if ($_POST['pass'] !== $_POST['pass2']) {
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

    public function seeUsers(array $banRemoveWarnings = null): void {
        $userModel = new \Com\Daw2\Models\UserModel();
        $users = $userModel->getAll();

        $data['section'] = 'AdminUsers';
        $data['users'] = $users;
        $data = [
            'section' => 'AdminUsers',
            'users' => $users
        ];

        if (!is_null($banRemoveWarnings)) {
            $data['banRemoveWarnings'] = $banRemoveWarnings;
        }

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminUsers.php', 'templates/Footer.php'), $data);
    }

    public function seeAdd(array $data = null): void {
        $styles = ['AddAdmins'];

        $data['styles'] = $styles;
        $data['section'] = 'AdminUsers';

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AddUsers.php', 'templates/Footer.php'), $data);
    }

    public function processAdd(): void {
        $errors = $this->checkRegister();

        if (empty($errors)) {
            $userModel = new \Com\Daw2\Models\UserModel();
            $userModel->register($_POST);

            header('Location: /AdminUsers');
        }

        $data = [];
        $data['errors'] = $errors;
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->seeAdd($data);
    }

    public function seeEdit(int $id): void {
        $userModel = new \Com\Daw2\Models\UserModel();
        $user = $userModel->getUserById($id);
        if ($user) {
            $data = [];
            $data['input'] = $user;
            $this->seeAdd($data);
        } else {
            Header('Location: /AdminUsers');
        }
    }

    public function processEdit(int $id): void {
        
        
    }

//    public function banUser() {
//        $success = false;
//        $action = '';
//
//        //Get fetch data
//        $json_data = file_get_contents('php://input');
//
//        // True to make it an asoaciative array
//        $data = json_decode($json_data, true);
//        $idUser = intval($data['id_user']);
//
//        if (filter_var($idUser, FILTER_VALIDATE_INT)) {
//            $userModel = new \Com\Daw2\Models\UserModel();
//            $user = $userModel->getUserById($idUser);
//
//            if (!is_null($user)) {
//                
//            }
//        }
//        $banRemoveWarnings = [];
//
//        if ($id === $_SESSION['user']['id_user']) {
//            $banRemoveWarnings = [
//                'class' => 'warning',
//                'message' => "You can't ban yourself"
//            ];
//        } else {
//            $userModel = new \Com\Daw2\Models\UserModel();
//            $user = $userModel->getUserById($id);
//            $ban = 0;
//            if ($user['id_status'] == 0) {
//                $ban = 1;
//            } else {
//                if ($user['id_status'] == 1) {
//                    $ban = 0;
//                }
//            }
//
//            if ($userModel->updateStatus($id, $ban)) {
//                $banRemoveWarnings = [
//                    'class' => 'success',
//                    'message' => 'User status changed.'
//                ];
//            } else {
//                $banRemoveWarnings = [
//                    'class' => 'danger',
//                    'message' => 'Error changing user status.'
//                ];
//            }
//        }
//        $this->seeUsers($banRemoveWarnings);
//    }
}
