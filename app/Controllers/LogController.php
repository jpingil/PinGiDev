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
            if ($logModel->insertLog($idUser, $action['id_actions'])) {
                return true;
            }
        }

        return false;
    }

    public function getAll(): void {
        $styles = ['Admin'];
        $logModel = new \Com\Daw2\Models\LogModel();
        $data = [
            'styles' => $styles,
            'section' => 'AdminLogs',
            'logs' => $logModel->getAll()
        ];

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminLogs.php', 'templates/Footer.php'), $data);
    }
}
