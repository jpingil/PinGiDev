<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */
declare(strict_types=1);

namespace Com\Daw2\Controllers;

/**
 * Description of FavoriteController
 *
 * @author usuario
 */
class FavoriteController extends \Com\Daw2\Core\BaseController {

    public function seeFavorites(): void {
        $jss = ['Fetch'];
        $styles = ['Products'];
        $favoriteModel = new \Com\Daw2\Models\FavoriteModel();

        $data = [
            'styles' => $styles,
            'section' => 'Favorites',
            'favorites' => $favoriteModel->getFavsByIdUser(),
            'jss' => $jss
        ];
        $this->view->showViews(array('templates/Header.php', 'Favorites.php', 'templates/Footer.php'), $data);
    }

    public function changeFav(): void {
        $success = false;
        $actionName = '';

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

                if ($favoriteModel->isFav($_SESSION['user']['id_user'],$idProduct)) {
                    if ($favoriteModel->deleteFav($idProduct)) {
                        $success = true;
                        $actionName = 'noFav';
                    }
                } else {
                    if ($favoriteModel->insertFav($idProduct)) {
                        $success = true;
                        $actionName = 'fav';
                    }
                }

//                if ($actionName !== '') {
//                    $logController = new \Com\Daw2\Controllers\LogController();
//                    $logController->generateLog($_SESSION['user']['id_user'], $actionName);
//                }
            }
        }
        $response = ['success' => $success, 'action' => $actionName];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
