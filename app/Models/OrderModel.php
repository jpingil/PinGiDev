<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Models;

/**
 * Description of OrderModel
 *
 * @author usuario
 */
class OrderModel extends \Com\Daw2\Core\BaseDbModel {

    public function getAll(): array {
        //`order` because order is a word reserved
        $stmt = $this->pdo->query('SELECT * FROM `order` o INNER JOIN product p ON o.id_product = p.id_product '
                . 'INNER JOIN user u ON o.id_user = u.id_user');
        return $stmt->fetchAll();
    }

    public function insertOrder(int $idUser, int $idProduct, string $orderDescription): bool {
        //`order` because order is a word reserved
        $stmt = $this->pdo->prepare('INSERT INTO `order` (id_user, id_product, order_description) '
                . 'VALUES (:id_user, :id_product, :order_description)');
        return $stmt->execute([
                    'id_user' => $idUser,
                    'id_product' => $idProduct,
                    'order_description' => $orderDescription
        ]);
    }
}
