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

    private const SELECT_FROM_JOIN = 'SELECT * FROM logs l INNER JOIN user u ON l.id_user '
            . '= u.id_user INNER JOIN actions a ON l.id_action = a.id_action';

    public function insertLog(int $idUser, int $idAction): bool {
        $stmt = $this->pdo->prepare('INSERT INTO logs(log_date, id_action, id_user) '
                . 'VALUES (NOW(), :id_action, :id_user)');
        return $stmt->execute([
                    'id_user' => $idUser,
                    'id_action' => $idAction
        ]);
    }

    public function getAll(): array {
        $stmt = $this->pdo->query('SELECT * FROM logs l INNER JOIN user u ON l.id_user '
                . '= u.id_user INNER JOIN actions a ON l.id_action = a.id_action order by log_date desc');
        return $stmt->fetchAll();
    }

    /**
     * Function to get the element for pagination
     * @return array all elements with the limit
     */
    public function getAllPagination(int $numberStart, int $numberElements): array {
        $stmt = $this->pdo->prepare('SELECT * FROM logs l INNER JOIN user u ON l.id_user '
                . '= u.id_user INNER JOIN actions a ON l.id_action = a.action LIMIT ?, ? order by log_date desc');
        $stmt->exeucte([$numberStart, $numberElements]);
        return $stmt->fetchAll();
    }

    public function getDates(): array {
        $stmt = $this->pdo->query('SELECT DISTINCT DATE(log_date) as date
        FROM logs
        WHERE log_date BETWEEN (SELECT MIN(log_date) FROM logs) AND (SELECT MAX(log_date) FROM logs)
        ORDER BY log_date desc');

        return $stmt->fetchAll();
    }

    public function getFilterLogs(array $vars): array {
        $sql = self::SELECT_FROM_JOIN;
        $conds = [];
        $params = [];

        if (!empty($vars['id_user'])) {
            $conds[] = 'l.id_user = :id_user';
            $params['id_user'] = intval($vars['id_user']);
        }

        if (!empty($vars['id_action'])) {
            $conds[] = 'l.id_action = :id_action';
            $params['id_action'] = intval($vars['id_action']);
        }

        if (!empty($vars['log_date'])) {
            $conds[] = 'DATE(l.log_date) = :log_date';
            $params['log_date'] = $vars['log_date'];
        }

        if (!empty($conds)) {
            $sql .= ' WHERE ' . implode(' AND ', $conds);
        }

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function getLogsByDate(string $logDate): ?array {
        //Date() because the log_date have dates and hours.
        $stmt = $this->pdo->prepare(self::SELECT_FROM_JOIN . ' WHERE DATE(log_date) = :log_date');
        $stmt->execute([$logDate]);
        if ($row = $stmt->fetch()) {
            return $row;
        }

        return null;
    }
}
