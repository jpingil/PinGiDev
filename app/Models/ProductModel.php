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
    private const ROUTE_IMG_FOLDER = 'imgs/Product/';

    /**
     * Function to verify if product exists in the database
     * 
     * @param int $id product id 
     * @return bool
     */
    public function exists(int $idProduct): bool {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE id_product = ?');
        $stmt->execute([$idProduct]);
        if ($row = $stmt->fetch()) {
            return true;
        }
        return false;
    }

    public function getAll(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM);
        return $stmt->fetchAll();
    }

    public function getSomeProducts(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM . ' LIMIT 3');
        return $stmt->fetchAll();
    }

    public function insert(array $vars): bool {
        $stmt = $this->pdo->prepare('INSERT INTO product (product_name, product_description, '
                . 'img_folder, img_extension, img_carousel_length, product_ban) values'
                . ' (:product_name, :product_description, :img_folder, :img_extension, 0, 0)');
        return $stmt->execute([
                    'product_name' => $vars['product_name'],
                    'product_description' => $vars['product_description'],
                    'img_folder' => self::ROUTE_IMG_FOLDER . $vars['product_name'],
                    'img_extension' => $vars['img_extension']
        ]);
    }

    public function update(array $vars): bool {
        $stmt = $this->pdo->prepare('UPDATE product set product_name = :product_name, '
                . 'product_description = :product_description, img_folder = :img_folder WHERE id_product = :id_product');
        return $stmt->execute([
                    'product_name' => $vars['product_name'],
                    'product_description' => $vars['product_description'],
                    'img_folder' => self::ROUTE_IMG_FOLDER . $vars['product_name'],
                    'id_product' => $vars['id_product']
        ]);
    }

    public function isProductBan(int $idProduct): bool {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE id_product = ? and product_ban = 1');
        $stmt->execute([$idProduct]);
        if ($row = $stmt->fetch()) {
            return true;
        }
        return false;
    }

    public function updateProductBan(int $idProduct, int $banProduct): bool {
        $stmt = $this->pdo->prepare('UPDATE product SET product_ban = :product_ban WHERE id_product = :id_product');
        return $stmt->execute([
                    'id_product' => $idProduct,
                    'product_ban' => $banProduct
        ]);
    }

    public function deleteProduct(int $idProduct): bool {
        $stmt = $this->pdo->prepare('DELETE FROM product WHERE id_product = ?');
        return $stmt->execute([$idProduct]);
    }

    public function getFilterProduct(array $vars): array {
        $sql = self::SELECT_FROM;
        $conds = [];
        $params = [];

        if (!empty($vars['product_name'])) {
            $conds[] = 'product_name LIKE :product_name';
            $params['product_name'] = '%' . $vars['product_name'] . '%';
        }

        if (!empty($conds)) {
            $sql .= ' WHERE ' . implode(' AND ', $conds);
        }

        $sql .= ' ORDER BY id_product';

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($params);

        echo $sql;
        var_dump($vars);
        die();

        return $stmt->fetchAll();
    }

    public function getProductById(int $idProduct): ?array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE id_product = ?');
        $stmt->execute([$idProduct]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        return null;
    }

    public function getProductByProductName(string $productName): ?array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE product_name = ?');
        $stmt->execute([$productName]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        return null;
    }
}
