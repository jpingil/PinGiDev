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

    public function seeAdminOrders(array $data = null): void {
        $orderModel = new \Com\Daw2\Models\OrderModel();
        $styles = ['Admin'];
        $jss = ['Fetch', 'HeaderNav'];

        $data['section'] = 'AdminOrders';
        $data['styles'] = $styles;
        $data['orders'] = $orderModel->getAll();
        $data['jss'] = $jss;

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminOrders.php', 'admin/templates/Footer.php'), $data);
    }

    public function processOrder(int $idProduct) {
        $_POST['id_product'] = $idProduct;
        $_POST['id_user'] = $_SESSION['user']['id_user'];
        $errors = $this->checkOrder($_POST, null, true);
        if (empty($errors)) {
            $orderModel = new \Com\Daw2\Models\OrderModel();
            if ($orderModel->insertOrder($_SESSION['user']['id_user'], $idProduct,
                            $_POST['order_description'])) {
                $logController = new \Com\Daw2\Controllers\LogController();
                $logController->generateLog($_SESSION['user']['id_user'], 'order');
            }
            header('Location: /Products');
        }

        $data = [];
        $data['errors'] = $errors;
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

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AddOrder.php', 'admin/templates/Footer.php'), $data);
    }

    public function seeEdit(int $id): void {
        $orderModel = new \Com\Daw2\Models\OrderModel();
        $order = $orderModel->getOrderById($id);
        if (!is_null($order)) {
            $data = [
                'section' => 'AdminOrders',
                'action' => '/AdminOrders/edit/' . $order['id_order'],
                'title' => 'Edit Order',
                'input' => $order,
            ];

            $this->seeAdd($data);
        }
    }

    public function processEdit(int $idOrder): void {
        $errors = $this->checkOrder($_POST, $idOrder);
        if (empty($errors)) {
            $orderModel = new \Com\Daw2\Models\OrderModel();
            $order = $orderModel->getOrderById($idOrder);
            $userModel = new \Com\Daw2\Models\UserModel();
            $vars = [
                'id_order' => $order['id_order'],
                'id_user' => $_POST['id_user'],
                'id_product' => $_POST['id_product'],
                'order_description' => $_POST['order_description']
            ];
            if ($orderModel->update($vars)) {
                header('Location: /AdminOrders');
            } else {
                $data['errors']['form'] = 'Unexpected error';
            }
        }

        $data = [];
        $data['title'] = 'Edit User';
        $data['action'] = '/AdminOrders/edit/' . $idOrder;
        $data['input'] = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $data['errors'] = $errors;
        $this->seeAdd($data);
    }

    /**
     * 
     * @param bool $addEdit flag to know if we need check idUser
     * @return array
     */
    private function checkOrder(array $post, int $idOrder = null, bool $add = false, bool $edit = false): array {
        $errors = [];

        if (empty($post['order_description'])) {
            $errors['order_description'] = 'Empty description.';
        } else {
            if ($edit || $add) {

                if (!$add) {
                    $orderModel = new \Com\Daw2\Models\OrderModel();
                    $order = $orderModel->getOrderById($idOrder);
                    if (is_null($idOrder)) {
                        $errors['form'] = 'That order doesn´t exist.';
                    }
                }

                if (empty($post['id_user'])) {
                    $errors['email'] = 'Empty email.';
                } else {
                    $userModel = new \Com\Daw2\Models\UserModel();
                    if (is_null($userModel->getUserById($post['id_user']))) {
                        $errors['order_description'] = 'That user doesn´t exist.';
                    }
                }

                if (empty($post['id_product'])) {
                    $errors['product'] = 'Empty product.';
                } else {
                    $productModel = new \Com\Daw2\Models\ProductModel();
                    if (is_null($productModel->getProductById($post['id_product']))) {
                        $errors['product'] = 'This product doesn´t exist.';
                    }
                }
            }

            if (!preg_match('/^[a-zA-Z,. ]{1,200}/', $post['order_description'])) {
                $errors['order_description'] = 'Only letters are allowed, with a maximum of 200 words.';
            }
        }

        return $errors;
    }

    public function deleteOrder($idOrder): void {
        $idOrder = intval($idOrder);
        $message = $this->verifyOrder($idOrder);
        if (empty($message)) {
            $orderModel = new \Com\Daw2\Models\OrderModel();

            if ($orderModel->deleteOrder($idOrder)) {
                $message = [
                    'class' => 'success',
                    'message' => 'The order was delete.'
                ];
            } else {
                $message = [
                    'class' => 'danger',
                    'message' => 'Unexpected error.'
                ];
            }
        }

        $data = [];
        $data['message'] = $message;
        $this->seeAdminOrders($data);
    }

    private function verifyOrder(int $idOrder): ?array {
        $message = [];

        if (filter_var($idOrder, FILTER_VALIDATE_INT) && $idOrder > 0) {
            $orderModel = new \Com\Daw2\Models\OrderModel();
            if (is_null($orderModel->getOrderById($idOrder))) {
                $message = [
                    'class' => 'danger',
                    'message' => 'This order doesn´t exists.'
                ];
            }
        }

        return $message;
    }
}
