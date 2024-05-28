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

    public function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM actions');
        return $stmt->fetchAll();
    }

    public function getActionIdByName(string $actionName): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM actions WHERE action_name = ?');
        $stmt->execute([$actionName]);
        if ($row = $stmt->fetch()) {
            return $row;
        }

        return null;
    }

    public function getActionById($idAction) {
        $stmt = $this->pdo->prepare('SELECT * FROM actions WHERE id_action = ?');
        $stmt->execute([$idAction]);
        if ($row = $stmt->fetch()) {
            return $row;
        }

        return null;
    }
}
