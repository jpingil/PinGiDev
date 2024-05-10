<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Controllers;

/**
 * Description of OrderController
 *
 * @author usuario
 */
class OrderController extends \Com\Daw2\Core\BaseController {

    public function seeAdminOrders(): void {
        $orderModel = new \Com\Daw2\Models\OrderModel();
        $styles = ['Admin'];
        $data = [
            'section' => 'AdminOrders',
            'styles' => $styles,
            'orders' => $orderModel->getAll()
        ];

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminOrders.php', 'templates/Footer.php'), $data);
    }

    public function processOrder(int $idProduct) {
        $error = $this->checkOrder();
        if (empty($error)) {
            $orderModel = new \Com\Daw2\Models\OrderModel();
            if ($orderModel->insertOrder($_SESSION['user']['id_user'], $idProduct, $_POST['description'])) {
                $logController = new \Com\Daw2\Controllers\LogController();
                $logController->generateLog($_SESSION['user']['id_user'], 'order');
            }
            header('Location: /Products');
        }

        $data = [];
        $data['error'] = $error;
        $productController = new \Com\Daw2\Controllers\ProductController();
        $productController->seeProduct($idProduct, $data);
    }

    private function checkOrder(): array {
        $error = [];

        if (empty($_POST['description'])) {
            $error['order'] = 'Empty description.';
        } else {
            if (!preg_match('/^[a-zA-Z,. ]{1,200}/', $_POST['description'])) {
                $error['description'] = 'Only letters are allowed, with a maximum of 200 words.';
            }
        }

        return $error;
    }
}
