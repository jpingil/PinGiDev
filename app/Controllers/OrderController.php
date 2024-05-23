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
        $jss = ['Fetch', 'HeaderNav'];
        $data = [
            'section' => 'AdminOrders',
            'styles' => $styles,
            'orders' => $orderModel->getAll(),
            'jss' => $jss
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

    public function seeAdd(array $data = null): void {
        $userModel = new \Com\Daw2\Models\UserModel();
        $productModel = new \Com\Daw2\Models\ProductModel();
        $styles = ['AddAdmins'];

        $data['styles'] = $styles;
        $data['section'] = 'AdminOrders';
        $data['users'] = $userModel->getAll();
        $data['products'] = $productModel->getAll();

        if (empty($data['title'])) {
            $data['title'] = 'Add Order';
        }

        if (empty($data['action'])) {
            $data['action'] = '/AdminOrders/edit';
        }

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AddOrder.php', 'templates/Footer.php'), $data);
    }

    public function seeEdit(int $id): void {
        $orderModel = new \Com\Daw2\Models\OrderModel();
        $order = $orderModel->getOrderById($id);
        if (!is_null($order)) {
            $data = [
                'section' => 'AdminOrders',
                'action' => '/AdminOrders/edit/' . $order['id_product'],
                'title' => 'Edit Order',
                'input' => $order,
            ];

            $this->seeAdd($data);
        }
    }

    public function processEdit(int $id): void {
        $errors = $this->checkOrder();
        if (empty($errors)) {
            $orderModel = new \Com\Daw2\Models\OrderModel();
            $userModel = new \Com\Daw2\Models\UserModel();

            $vars = [
                'id_order' => $id,
                'id_user' => $_POST['id_user'],
                'id_product' => $_POST['id_product'],
                'order_description' => $_POST['order_description']
            ];
            $orderModel->update($vars);
            header('Location: /AdminOrders');
        }

        $data = [];
        $data['title'] = 'Edit User';
        $data['action'] = '/AdminOrders/edit/' . $id;
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $data['errors'] = $errors;
        $this->seeAdd($data);
    }

    /**
     * 
     * @param bool $addEdit flag to know if we need check idUser
     * @return array
     */
    private function checkOrder(bool $addEdit = false): array {
        $errors = [];

        if (empty($_POST['order_description'])) {
            $errors['order_description'] = 'Empty description.';
        } else {
            if ($addEdit) {
                if (empty($_POST['id_user'])) {
                    $errors['email'] = 'Empty email.';
                } else {
                    $userModel = new \Com\Daw2\Models\UserModel();
                    if (is_null($userModel->getUserById($_POST['id_user']))) {
                        $errors['order_description'] = 'That user doesn´t exist.';
                    }
                }

                if (empty($_POST['id_product'])) {
                    $errors['product'] = 'Empty product.';
                } else {
                    $productModel = new \Com\Daw2\Models\ProductModel();
                    if (is_null($productModel->getProductById($_POST['id_product']))) {
                        $errors['product'] = 'This product doesn´t exist.';
                    }
                }
            }

            if (!preg_match('/^[a-zA-Z,. ]{1,200}/', $_POST['order_description'])) {
                $errors['order_description'] = 'Only letters are allowed, with a maximum of 200 words.';
            }
        }

        return $errors;
    }
}
