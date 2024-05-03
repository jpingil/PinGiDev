<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Controllers;

/**
 * Description of FavoriteController
 *
 * @author usuario
 */
class FavoriteController extends \Com\Daw2\Core\BaseController {

    public function seeFavorites(): void {
        $favoriteModel = new \Com\Daw2\Models\FavoriteModel();
        $data = [
            'favorites' => $favoriteModel->getFavsByIdUser()
        ];
        $this->view->showViews(array('templates/Header.php', 'Favorites.php', 'templates/Footer.php'), $data);
    }

    public function changeFav(): void {
        $success = false;
        $action = '';

        //Get fetch data
        $json_data = file_get_contents('php://input');

        // True to make it an asoaciative array
        $data = json_decode($json_data, true);
        $idProduct = intval($data['id_product']);

        if (filter_var($idProduct, FILTER_VALIDATE_INT)) {
            $productModel = new \Com\Daw2\Models\ProductModel();
            //Verify if this product exists
            if ($productModel->exists($idProduct)) {
                $favoriteModel = new \Com\Daw2\Models\FavoriteModel();

                if ($favoriteModel->isFav($idProduct)) {
                    if ($favoriteModel->deleteFav($idProduct)) {
                        $success = true;
                        $action = 'noFav';
                    }
                } else {
                    if ($favoriteModel->insertFav($idProduct)) {
                        $success = true;
                        $action = 'fav';
                    }
                }
            }
        }
        $response = ['success' => $success, 'action' => $action];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
