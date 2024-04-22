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

    public function getUserByEmail(string $email): ?array {
        $stmt = $this->pdo->prepare('SELECT * FROM User WHERE email = :email');
        $stmt->execute([$email]);
        if ($row = $stmt->fetch()) {
            return $row;
        } else {
            return null;
        }
    }

    public function register(array $vars) {
        $stmt = $this->pdo->prepare('INSERT INTO User (user_name, pass, email, id_rol) '
                . 'VALUES (:userName, :pass, :email, 1)');
        $stmt->execute(
                [
                    'userName' => $vars['userName'],
                    'pass' => password_hash($vars['pass'], PASSWORD_DEFAULT),
                    'email' => $vars['email']
                ]
        );
    }
}
