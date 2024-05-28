<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Controllers;

/**
 * Description of LogController
 *
 * @author usuario
 */
class LogController extends \Com\Daw2\Core\BaseController {
    /*
     * Function to generate a log in the database and verify if this log was generated
     */

    public function generateLog(int $idUser, string $actionName): bool {
        $actionModel = new \Com\Daw2\Models\ActionModel();
        $action = $actionModel->getActionIdByName($actionName);
        if (!is_null($action)) {
            $logModel = new \Com\Daw2\Models\LogModel();
            if ($logModel->insertLog($idUser, $action['id_action'])) {
                return true;
            }
        }

        return false;
    }

    public function seeLogs(array $data = null): void {
        $userModel = new \Com\Daw2\Models\UserModel();
        $logModel = new \Com\Daw2\Models\LogModel();
        $actionModel = new \Com\Daw2\Models\ActionModel();
        $styles = ['Admin'];

        $data['styles'] = $styles;
        $data['section'] = 'AdminLogs';
        $data['users'] = $userModel->getAll();
        $data['actions'] = $actionModel->getAll();
        $data['dates'] = $logModel->getDates();

        if (empty($data['logs'])) {
            $data['logs'] = $logModel->getAll();
        }


        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminLogs.php', 'templates/Footer.php'), $data);
    }

    public function processFilter(): void {
        $errors = $this->checkFilter();
        if (empty($errors)) {
            $logModel = new \Com\Daw2\Models\LogModel();
            $logs = $logModel->getFilterLogs($_GET);
            $data['logs'] = $logs;
            $data['input'] = $_GET;
            $this->seeLogs($data);
        } else {
            $data['errors'] = $errors;
            $this->seeLogs($data);
        }
    }

    private function checkFilter(): array {
        $errors = [];

        if (!empty($_GET['id_user'])) {
            $userModel = new \Com\Daw2\Models\UserModel();
            if (!filter_var($_GET['id_user'], FILTER_VALIDATE_EMAIL)) {
                $error['id_user'] = 'This is a invalid user.';
            }

            if (is_null($userModel->getUserById($_GET['id_user']))) {
                $error['id_user'] = "That user doesn't exist";
            }
        }

        if (!empty($_GET['id_actions'])) {
            $actionModel = new \Com\Daw2\Models\ActionModel();
            if (!filter_var($_GET['id_action'], FILTER_VALIDATE_INT)) {
                $error['id_action'] = 'This is a invalid action.';
            }

            if (is_null($actionModel->getActionById($_GET['id_action']))) {
                $error['id_action'] = 'This action doesn´t exist';
            }
        }

        if (!empty($_GET['log_date'])) {
            $logModel = new \Com\Daw2\Models\LogModel();
            if (preg_match("/^\d{4}-\d{2}-\d{2}$/", $_GET['log_date'])) {
                $error['log_date'] = 'This is a invalid date.';
            }

            if (is_null($logModel->getLogsByDate($_GET['log_date']))) {
                $error['log_date'] = 'The indicated date has no records.';
            }
        }

        return $errors;
    }
}
