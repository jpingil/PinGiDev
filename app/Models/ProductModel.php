<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

declare(strict_types=1);

namespace Com\Daw2\Models;

/**
 * Description of ProductModel
 *
 * @author usuario
 */
class ProductModel extends \Com\Daw2\Core\BaseDbModel {

    private const SELECT_FROM = 'SELECT * FROM product';
    private const ROUTE_FOLDER_IMGS = 'imgs/Product/';

    public function getAll(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM);
        return $stmt->fetchAll();
    }

    public function insert($vars): bool {
        $stmt = $this->pdo->prepare('INSERT INTO Product (product_name, product_description, folder_imgs) values'
                . ' (:product_name, :product_description, :folder_imgs)');
        return $stmt->execute([
                    'product_name' => $vars['product_name'],
                    'product_description' => $vars['product_description'],
                    'folder_imgs' => self::ROUTE_FOLDER_IMGS . $vars['product_name']
        ]);
    }

    public function getProductById(int $id) {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . 'WHERE id_product = ?');
        return $stmt->execute([$id]);
    }
}
