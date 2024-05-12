<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Models;

/**
 * Description of FavoriteModel
 *
 * @author usuario
 */
class FavoriteModel extends \Com\Daw2\Core\BaseDbModel {

    private const SELECT_FROM_FAVS = 'SELECT * FROM favorites f INNER JOIN product'
            . ' p ON f.id_product = p.id_product INNER JOIN user u ON u.id_user = f.id_user';

    /**
     * 
     * @param int $idProduct id of the product that we want see if is favorite
     * @return bool if this query have a row, this query is true and the product is fav
     */
    public function isFav(int $idUser, int $idProduct): bool {
        $stmt = $this->pdo->prepare(self::SELECT_FROM_FAVS . ' WHERE f.id_product = :id_product AND f.id_user = :id_user');
        $stmt->execute([
            'id_product' => $idProduct,
            'id_user' => $idUser
        ]);
        if ($row = $stmt->fetch()) {
            return true;
        }
        return false;
    }

    /**
     * Function to get the user favorites products
     * @param int $idUser or null and the id will be the session user id
     * @return array
     */
    public function getFavsByIdUser(int $idUser = null): array {
        if (is_null($idUser)) {
            $idUser = $_SESSION['user']['id_user'];
        }
        $stmt = $this->pdo->prepare(self::SELECT_FROM_FAVS . ' WHERE f.id_user = ?');
        $stmt->execute([$idUser]);
        return $stmt->fetchAll();
    }

    public function insertFav(int $idProduct, int $idUser = null): bool {
        if (is_null($idUser)) {
            $idUser = $_SESSION['user']['id_user'];
        }
        $stmt = $this->pdo->prepare('INSERT INTO favorites (id_user, id_product) VALUES (:id_user, :id_product)');
        return $stmt->execute([
                    'id_user' => $idUser,
                    'id_product' => $idProduct
        ]);
    }

    public function deleteFav(int $idProduct, int $idUser = null): bool {
        if (is_null($idUser)) {
            $idUser = $_SESSION['user']['id_user'];
        }
        $stmt = $this->pdo->prepare('DELETE FROM favorites WHERE id_user = :id_user'
                . ' AND id_product = :id_product');
        return $stmt->execute([
                    'id_user' => $idUser,
                    'id_product' => $idProduct
        ]);
    }
}
