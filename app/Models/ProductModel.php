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
    private const SELECT_FROM_FAVS = 'SELECT * FROM favorites f INNER JOIN product'
            . ' p ON f.id_product = p.id_product';
    private const ROUTE_IMG_FOLDER = 'imgs/Product/';

    /**
     * Function to verify if product exists in the database
     * 
     * @param int $id product id 
     * @return bool
     */
    public function exists(int $idProduct): bool {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE id_product = ?');
        return $stmt->execute([
                    'id_product' => $idProduct
        ]);
    }

    public function getAll(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM);
        return $stmt->fetchAll();
    }

    public function insert(array $vars): bool {
        $stmt = $this->pdo->prepare('INSERT INTO product (product_name, product_description, '
                . 'img_folder, img_extension, img_carousel_length) values'
                . ' (:product_name, :product_description, :img_folder, :img_extension, :img_carousel_length)');
        return $stmt->execute([
                    'product_name' => $vars['product_name'],
                    'product_description' => $vars['product_description'],
                    'img_folder' => self::ROUTE_IMG_FOLDER . $vars['product_name'],
                    'img_extension' => $vars['img_extension'],
                    'img_carousel_length' => $vars['img_carousel_length']
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

    public function getProductById(int $id): ?array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE id_product = ?');
        $stmt->execute([$id]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        return null;
    }

    /**
     * 
     * @param int $idProduct id of the product that we want see if is favorite
     * @return bool if this query have a row, this query is true and the product is fav
     */
    public function isFav(int $idProduct): bool {
        $stmt = $this->pdo->prepare(self::SELECT_FROM_FAVS . ' WHERE id_product = ?');
        $stmt->execute([$idProduct]);
        if ($row = $stmt->fetch()) {
            return true;
        }
        return false;
    }

    public function insertFav(int $idProduct, int $id_user = null): bool {
        if (is_null($id_user)) {
            $id_user = $_SESSION['user']['id_user'];
        }
        $stmt = $this->pdo->prepare('INSERT INTO favorites (id_user, id_product) '
                . 'VALUES (:id_user, :id_product)');
        return $stmt->execute([
                    'id_user' => $id_user,
                    'id_product' => $idProduct
        ]);
    }

    public function deleteFav(int $idProduct, int $id_user = null): bool {
        if (is_null($id_user)) {
            $id_user = $_SESSION['user']['id_user'];
        }
        $stmt = $this->pdo->prepare('DELETE FROM favorites WHERE id_user = :id_user'
                . ' AND id_product = :id_product');
        return $stmt->execute([
                    'id_user' => $id_user,
                    'id_product' => $idProduct
        ]);
    }
}
