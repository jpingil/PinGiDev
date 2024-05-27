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

    //`order` because order is a word reserved
    private const SELECT_ALL = 'SELECT * FROM `order` o INNER JOIN product p ON o.id_product = p.id_product '
            . 'INNER JOIN user u ON o.id_user = u.id_user';

    public function getAll(): array {
        $stmt = $this->pdo->query(self::SELECT_ALL);
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

    public function update(array $vars): bool {
        $stmt = $this->pdo->prepare("UPDATE `order` SET "
                . "id_user = :id_user, "
                . "id_product = :id_product, order_description = :order_description "
                . "WHERE id_order = :id_order");
        return $stmt->execute([
                    'id_user' => $vars['id_user'],
                    'order_description' => $vars['order_description'],
                    'id_product' => $vars['id_product'],
                    'id_order' => $vars['id_order']
        ]);
    }

    public function getOrderById($idOrder): ?array {
        $stmt = $this->pdo->prepare(self::SELECT_ALL . ' WHERE id_order = ?');
        $stmt->execute([$idOrder]);
        if ($row = $stmt->fetch()) {
            return $row;
        }

        return null;
    }

    public function deleteOrder(int $idOrder): bool {
        $stmt = $this->pdo->prepare("DELETE FROM `order` WHERE id_order = ?");
        return $stmt->execute([$idOrder]);
    }
}
