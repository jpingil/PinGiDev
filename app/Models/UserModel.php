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

    private const SELECT_FROM_ALL = 'SELECT u.*, r.*, s.* FROM user u INNER JOIN rol r ON u.id_rol = r.id_rol'
            . ' INNER JOIN status s ON u.id_status = s.id_status';

    public function getAll(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM_ALL);
        return $stmt->fetchAll();
    }

    public function login(string $email, string $pass): ?array {
        $user = $this->getUserByEmail($email);
        if (!is_null($user)) {
            if (password_verify($pass, $user['pass'])) {
                unset($user['pass']);
                return $user;
            }
        }
        return null;
    }

    public function register(array $vars): bool {
        if (!isset($vars['id_rol'])) {
            $vars['id_rol'] = 1;
        }

        $stmt = $this->pdo->prepare('INSERT INTO user (user_name, pass, email, id_rol, id_status) '
                . 'VALUES (:user_name, :pass, :email, :id_rol, 0)');
        return $stmt->execute(
                        [
                            'user_name' => $vars['user_name'],
                            'pass' => password_hash($vars['pass'], PASSWORD_DEFAULT),
                            'email' => $vars['email'],
                            'id_rol' => $vars['id_rol']
                        ]
        );
    }

    public function updateStatus(int $id, int $id_status): bool {
        $stmt = $this->pdo->prepare('UPDATE user SET id_status = :id_status WHERE id_user = :id_user');
        return $stmt->execute(
                        [
                            'id_status' => $id_status,
                            'id_user' => $id
                        ]
        );
    }

    public function updateUser(int $idUser, array $vars): bool {
        $stmt = $this->pdo->prepare('UPDATE user SET user_name = :user_name, email = :email, pass = :pass, id_rol = :id_rol WHERE id_user = :id_user');

        return $stmt->execute([
                    'user_name' => $vars['user_name'],
                    'email' => $vars['email'],
                    'pass' => password_hash($vars['pass'], PASSWORD_DEFAULT),
                    'id_user' => $idUser,
                    'id_rol' => $vars['id_rol']
        ]);
    }

    public function getUserByEmail(string $email): ?array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM_ALL . ' WHERE u.email = ?');
        $stmt->execute([$email]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        return null;
    }

    public function getUserById(int $id): ?array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM_ALL . ' WHERE u.id_user = ?');
        $stmt->execute([$id]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        return null;
    }
}
