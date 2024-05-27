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

    public function seeLogin(array $errors = null, array $postData = null): void {
        $styles = ['Login'];
        $jss = ['LoginRegister'];

        $data = [
            'styles' => $styles,
            'section' => 'Login',
            'jss' => $jss
        ];
        if (!is_null($errors) && !empty($errors)) {
            $data['errors'] = $errors;
        }
        if (!is_null($postData) && !empty($postData)) {
            $data['data'] = $postData;
        }

        $this->view->showViews(array('templates/Header.php', 'Login.php', 'templates/Footer.php'), $data);
    }

    public function seeRegister(array $errors = null, array $postData = null): void {
        $styles = ['Login'];
        $jss = ['LoginRegister'];

        $data = [
            'styles' => $styles,
            'section' => 'Login',
            'jss' => $jss
        ];
        if (!is_null($errors) && !empty($errors)) {
            $data['errors'] = $errors;
        }
        if (!is_null($postData) && !empty($postData)) {
            $data['data'] = $postData;
        }

        $this->view->showViews(array('templates/Header.php', 'Register.php', 'templates/Footer.php'), $data);
    }

    /**
     * Fetch function to display login or register depending on the json received from the onclicks (LoginRegister.js)
     * @return void
     */
    public function seeLoginRegister(): void {
        $postData = json_decode(file_get_contents("php://input"), true);
        $view = '';

        if (isset($postData['view'])) {
            if ($postData['view'] == 'Login' || $postData['view'] == 'Register') {
                $view = $postData['view'];
            } else {
                $view = 'Error';
            }
        } else {
            $view = 'Error';
        }

        echo json_encode($view);
    }

    public function processRegister(): void {
        $errors = $this->checkRegister();
        if (empty($errors)) {
            $userModel = new \Com\Daw2\Models\UserModel();
            if ($userModel->register($_POST)) {
                $user = $userModel->getUserByEmail($_POST['email']);
                if (is_null($user)) {
                    $errors['register'] = 'Unexpected error';
                } else {
                    $logController = new \Com\Daw2\Controllers\LogController();
                    if ($logController->generateLog($user['id_user'], 'register')) {
                        $_SESSION['user'] = $user;
                    } else {
                        $errors['register'] = 'Unexpected error';
                    }

                    header('Location: /');
                }
            } else {
                $errors['register'] = 'Unexpected error.';
            }
        }


        $postData = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->seeRegister($errors, $postData);
    }

    private function checkRegister(array $user = null, bool $defaultUser = false): array {
        $errors = [];

        if ($defaultUser) {
            if (empty($_POST['user_name']) ||
                    empty($_POST['pass']) || empty($_POST['pass2'])) {
                $errors['register'] = 'There are empty values.';
            }
        }

        if (!preg_match('/^[a-zA-Z0-9_]{4,15}$/', $_POST['user_name'])) {
            $errors['register'] = 'The username can only contain numbers, '
                    . 'letters, underscores, and must be between 4 and 15 characters.';
        }

        if (!$defaultUser) {
            if (empty($_POST['user_name']) || empty($_POST['email']) ||
                    empty($_POST['pass']) || empty($_POST['pass2'])) {
                $errors['register'] = 'There are empty values.';
            }
            
            if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['register'] = 'The email is not valid.';
            }

            $userModel = new \Com\Daw2\Models\UserModel();
            if (is_null($user)) {
                if (!is_null($userModel->getUserByEmail($_POST['email']))) {
                    $errors['register'] = 'That email is already in use.';
                }
            } else {
                $updateUser = $userModel->getUserByEmail($_POST['email']);
                if (($updateUser['email'] !== $user['email']) && (!is_null($updateUser))) {
                    $errors['register'] = 'That email is already in use.';
                }
            }

            if (isset($_POST['id_rol'])) {
                $rolModel = new \Com\Daw2\Models\RolModel();
                $_POST['id_rol'] = intval($_POST['id_rol']);
                if (is_null($rolModel->getRolById($_POST['id_rol'])) && !empty($_POST['id_rol'])) {
                    $errors['register'] = 'The rol is not valid.';
                }
            }
        }

        if (!preg_match('/^.{8,18}$/', $_POST['pass'])) {
            $errors['register'] = 'The password must be between 8 and 18 characters long.';
        }
        if ($_POST['pass'] !== $_POST['pass2']) {
            $errors['register'] = 'The passwords must match.';
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
                $logController = new \Com\Daw2\Controllers\LogController();
                if ($logController->generateLog($user['id_user'], 'login')) {
                    $_SESSION['user'] = $user;
                } else {
                    $errors['login'] = 'Unexpected error.';
                }
                header('Location: /');
            }
        }

        $this->seeLogin($errors);
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
        try {
            $logController = new \Com\Daw2\Controllers\LogController();
            $logController->generateLog($_SESSION['user']['id_user'], 'logout');
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }
        header('Location: /Login');
    }

    public function seeUsers(array $data = null): void {
        $userModel = new \Com\Daw2\Models\UserModel();
        $users = $userModel->getAll();

        $data['jss'] = ['Fetch', 'HeaderNav'];
        $data['section'] = 'AdminUsers';
        $data['users'] = $users;

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminUsers.php', 'templates/Footer.php'), $data);
    }

    public function seeAdd(array $data = null, bool $readonly = false): void {
        $rolModel = new \Com\Daw2\Models\RolModel();

        $styles = ['AddAdmins'];

        $data['styles'] = $styles;
        $data['section'] = 'AdminUsers';
        $data['rols'] = $rolModel->getAll();

        if (empty($data['title'])) {
            $data['title'] = 'Add User';
        }

        if (empty($data['action'])) {
            $data['action'] = '/AdminUser/add';
        }

        if ($readonly) {
            $data['readonly'] = true;
        }



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

    public function seeEdit(int $id, bool $readonly = false): void {
        $userModel = new \Com\Daw2\Models\UserModel();
        $user = $userModel->getUserById($id);
        if ($user) {
            $data = [];
            $data['input'] = $user;
            $data['title'] = 'Edit User';
            $data['action'] = '/AdminUser/edit';
            if ($readonly) {
                $data['action'] = '/Edit';
            }
            $this->seeAdd($data, $readonly);
        } else {
            Header('Location: /AdminUsers');
        }
    }

    public function processEdit(int $id, bool $defaultUser = false): void {
        $userModel = new \Com\Daw2\Models\UserModel();
        $errors = $this->checkRegister($userModel->getUserById($id), $defaultUser);
        if (empty($errors)) {
            if ($defaultUser) {
                $_POST['email'] = $_SESSION['user']['email'];
            }
            $userModel->updateUser($id, $_POST);
            if (!$defaultUser) {
                header('Location: /AdminUsers');
            }

            header('Location: /');
        }

        $data = [];
        $data['title'] = 'Edit User';
        $data['action'] = '/AdminUser/edit';
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $data['errors'] = $errors;
        if ($defaultUser) {
            $data['action'] = '/Edit';
            $data['readonly'] = true;
            $data['input']['email'] = $_SESSION['user']['email'];
            $data['input']['id_rol'] = $_SESSION['user']['id_rol'];
        }
        $this->seeAdd($data);
    }

    /**
     * Fetch function to ban users
     * @return void
     */
    public function banUser(): void {
        $success = false;
        $action = 'ban';
        $userBan = 1;

        //Get fetch data
        $json_data = file_get_contents('php://input');

        // True to make it an asoaciative array
        $data = json_decode($json_data, true);
        $idUser = intval($data['id_user']);
        $message = $this->verifyUser($idUser);
        if (empty($message)) {
            $userModel = new \Com\Daw2\Models\UserModel();
            $user = $userModel->getUserById($idUser);

            if ($userModel->isUserBan($idUser)) {
                $userBan = 0;
                $action = 'noBan';
            }

            if ($userModel->updateUserBan($idUser, $userBan)) {
                $success = true;
            }
        } else {
            $response['message'] = $message;
        }

        $response = [
            'success' => $success,
            'action' => $action
        ];

        echo json_encode($response);
    }

    public function deleteUser($idUser): void {
        $idUser = intval($idUser);
        $message = $this->verifyUser($idUser);

        if (empty($message)) {
            $userModel = new \Com\Daw2\Models\UserModel();

            if ($userModel->deleteUser($idUser)) {
                $message = [
                    'class' => 'success',
                    'message' => 'The user was delete.'
                ];
            }
        }

        $data = [];
        $data['message'] = $message;
        $this->seeUsers($data);
    }

    private function verifyUser(int $idUser): ?array {
        $message = [];

        if (filter_var($idUser, FILTER_VALIDATE_INT)) {
            if ($_SESSION['user']['id_user'] === $idUser) {
                $message = [
                    'class' => 'warning',
                    'message' => 'You can´t ban or delete yourself'
                ];
            } else {
                $userModel = new \Com\Daw2\Models\UserModel();
                $user = $userModel->getUserById($idUser);

                if (is_null($user)) {
                    $message = [
                        'class' => 'danger',
                        'message' => 'This user doesn´t exists.'
                    ];
                }
            }
        }

        return $message;
    }
}
