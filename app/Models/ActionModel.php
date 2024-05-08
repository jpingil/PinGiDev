<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Models;

/**
 * Description of ActionModel
 *
 * @author usuario
 */
class ActionModel extends \Com\Daw2\Core\BaseDbModel {

    public function getActionIdByName(string $actionName): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM actions WHERE actions_name = ?');
        $stmt->execute([$actionName]);
        if ($idAction = $stmt->fetch()) {
            return $idAction;
        }

        return null;
    }
}
