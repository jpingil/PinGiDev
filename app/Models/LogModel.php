<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Models;

/**
 * Description of LogModel
 *
 * @author usuario
 */
class LogModel extends \Com\Daw2\Core\BaseDbModel {

    public function insertLog(int $idUser, int $idAction): bool {
        $stmt = $this->pdo->prepare('INSERT INTO logs(log_date, id_actions, id_user) '
                . 'VALUES (NOW(), :id_actions, :id_user)');
        return $stmt->execute([
                    'id_user' => $idUser,
                    'id_actions' => $idAction
        ]);
    }

    public function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM logs l INNER JOIN user u ON l.id_user '
                . '= u.id_user INNER JOIN actions a ON l.id_actions = a.id_actions');
        return $stmt->fetchAll();
    }
}
