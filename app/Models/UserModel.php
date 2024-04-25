<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Models;

/**
 * Description of UserModel
 *
 * @author usuario
 */
class UserModel extends \Com\Daw2\Core\BaseDbModel {

    private const SELECT_FROM_ALL = 'SELECT u.*, r.*, s.* FROM user u INNER JOIN rol r ON u.id_rol = r.id'
            . ' INNER JOIN status s ON u.id_status = s.id';

    public function getAll(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM_ALL);
        return $stmt->fetchAll();
    }

    public function getUserByEmail(string $email): ?array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM_ALL . ' WHERE u.email = ?');
        $stmt->execute([$email]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        return null;
    }

    public function login(string $email, string $pass): ?array {
        $user = $this->getUserByEmail($email);
        if (!is_null($user)) {
            if (password_verify($pass, $user['pass'])) {
//            if ($pass === $user['pass']) {
                unset($user['pass']);
                return $user;
            }
        }
        return null;
    }

    public function register(array $vars) {
        $stmt = $this->pdo->prepare('INSERT INTO User (user_name, pass, email, id_rol, id_status) '
                . 'VALUES (:userName, :pass, :email, 1, 0)');
        $stmt->execute(
                [
                    'userName' => $vars['userName'],
//                    'pass' => $vars['pass'],
                    'pass' => password_hash($vars['pass'], PASSWORD_DEFAULT),
                    'email' => $vars['email']
                ]
        );
    }
}
