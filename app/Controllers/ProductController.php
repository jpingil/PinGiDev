<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

declare(strict_types=1);

namespace Com\Daw2\Controllers;

/**
 * Description of ProductController
 *
 * @author jorge
 */
class ProductController extends \Com\Daw2\Core\BaseController {

    private const MAX_FILE_SIZE_BYTES = 512000 * 2;

    public function seeProducts(): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $products = $productModel->getAll();
        $styles = ['Products'];

        $data = [
            'styles' => $styles,
            'section' => 'Products',
            'products' => $products,
        ];

        if (isset($_SESSION['user'])) {
            $favoriteModel = new \Com\Daw2\Models\FavoriteModel();
            $userFavorites = $favoriteModel->getFavsByIdUser();
            $data['favsProducts'] = $userFavorites;
        }

        $this->view->showViews(array('templates/Header.php', 'Products.php', 'templates/Footer.php'), $data);
    }

    public function seeProduct(int $id): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $styles = ['Product'];
        $product = $productModel->getProductById($id);
        if (!is_null($product)) {
            $data = [
                'stlyles' => $styles,
                'section' => 'Products',
                'product' => $product
            ];
        }

        $this->view->showViews(array('templates/Header.php', 'Product.php', 'templates/Footer.php'), $data);
    }

    public function seeAdminProducts(array $data = null): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $products = $productModel->getAll();
        $jss = ['Fetch'];
        $data['section'] = 'AdminProducts';
        $data['products'] = $products;
        $data['jss'] = $jss;
        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminProducts.php', 'templates/Footer.php'), $data);
    }

    public function seeAdd(array $data = null): void {
        $styles = ['AddAdmins', 'AddProducts'];

        $data['styles'] = $styles;
        $data['js'] = 'FormImages';

        if (!isset($data['section'])) {
            $data['title'] = 'Add Product';
            $data['section'] = '/AdminProducts/add';
        }


        $this->view->showViews(array('admin/templates/Header.php', 'admin/AddProduct.php', 'templates/Footer.php'), $data);
    }

    public function processAdd(): void {
        $errors = $this->checkAdd();

        if (empty($errors)) {
            $productModel = new \Com\Daw2\Models\ProductModel();
            $validExtensions = ['jpeg', 'jpg', 'png'];
            $_POST['img_extension'] = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
            $_POST['img_carousel_length'] = count($_FILES['images']['name']);

            if (in_array($_POST['img_extension'], $validExtensions)) {
                if ($productModel->insert($_POST)) {
                    $mainImageFile = '../public/assets/imgs/Product/' .
                            $_POST['product_name'] . '/Main Image/';
                    mkdir($mainImageFile, 0777, true);
                    $mainImageName = $_POST['product_name'] . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['image']['tmp_name'], $mainImageFile . $mainImageName);
                }
            }

            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
                $carouselImageName = $_FILES['images']['name'][$key];
                $extension = pathinfo($carouselImageName, PATHINFO_EXTENSION);

                if (in_array($extension, $validExtensions)) {
                    $carouselImagesFile = '../public/assets/imgs/Product/' . $_POST['product_name'] . '/Carousel Images/';
                    mkdir($carouselImagesFile, 0777, true);

                    $uniqueFilename = $_POST['product_name'] . '_' . $key . '.' . $extension;
                    move_uploaded_file($_FILES['images']['tmp_name'][$key], $carouselImagesFile . $uniqueFilename);
                }
            }



            header('Location: /AdminProducts');
        }

        unset($_POST['image'], $_POST['images']);
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $data = [
            'errors' => $errors,
            'data' => $post
        ];
        $this->seeAdd($data);
    }

    public function checkAdd(bool $edit = null): array {

        $errors = [];

        if (empty($_POST['product_name']) || empty($_POST['product_description'])) {
            $errors['form'] = 'Empty fields';
        } else {
            if (!preg_match('/^[a-zA-Z0-9\s]{4,15}$/', $_POST['product_name'])) {
                $errors['product_name'] = 'The product name can only contain letters, '
                        . 'numbers, and spaces. It should be between 4 and 15 '
                        . 'characters long.';
            }
            if (!preg_match('/^(?:[a-zA-Z0-9]+\s*){5,100}$/', $_POST['product_description'])) {
                $errors['product_description'] = 'The product name can only contain letters, '
                        . 'numbers, and spaces. It should be between 4 and 15 '
                        . 'characters long.';
            }

            if (is_null($edit)) {
                // ERROR 0 = all ok
                if ($_FILES['image']['error'] !== 0) {
                    $errors['image'] = $_FILES['image']['error'];
                } else {
                    if ($_FILES['image']['size'] > self::MAX_FILE_SIZE_BYTES) {
                        $errors['image'] = 'The image cannot be larger than ' . self::MAX_FILE_SIZE_BYTES . 'KB.';
                    }
                }

                for ($i = 0;
                        $i < count($_FILES['images']['error']);
                        $i++) {
                    if ($_FILES['images']['error'][$i] !== 0) {
                        $errors['images'] = 'The error to load the image is the ' . $_FILES['images']['error'][$i];
                    } else {
                        if ($_FILES['images']['size'][$i] > self::MAX_FILE_SIZE_BYTES) {
                            $errors['images'] = 'The image cannot be larger than ' . self::MAX_FILE_SIZE_BYTES . 'KB.';
                        }
                    }
                }
            }
        }
        return $errors;
    }

    public function seeEdit(int $id): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $product = $productModel->getProductById($id);

        if (!is_null($product)) {
            $data = [
                'section' => '/AdminProducts/edit/' . $product['id_product'],
                'title' => 'Edit Product',
                'data' => $product,
            ];

            $this->seeAdd($data);
        }
    }

    public function processEdit(int $id): void {
        $errors = $this->checkAdd($edit = true);
        if (empty($errors)) {
            $productModel = new \Com\Daw2\Models\ProductModel();
            $product_old = $productModel->getProductById($id);
            $_POST['id_product'] = $id;
            if ($productModel->update($_POST)) {

                //Change direcory  name
                rename(('../public/assets/imgs/Product/' .
                        $product_old['product_name']), ('../public/assets/imgs/Product/' .
                        $_POST['product_name']));

                //Change main img name
                $oldImgRoute = '../public/assets/imgs/Product/' .
                        $_POST['product_name'] . '/Main Image/' . $product_old['product_name'] .
                        '.' . $product_old['img_extension'];
                $newImgRoute = '../public/assets/imgs/Product/' .
                        $_POST['product_name'] . '/Main Image/' . $_POST['product_name'] .
                        '.' . $product_old['img_extension'];
                rename($oldImgRoute, $newImgRoute);

                //Change carousel imgs names
                for ($i = 0; $i < count($product_old['img_carousel_length']); $i++) {
                    $oldImgRoute = '../public/assets/imgs/Product/' .
                            $_POST['product_name'] . '/Carousel Images/' . $product_old['product_name'] . $i .
                            '.' . $product_old['img_extension'];
                    $newImgRoute = '../public/assets/imgs/Product/' .
                            $_POST['product_name'] . '/Carousel Images/' . $_POST['product_name'] . $i .
                            '.' . $product_old['img_extension'];
                    rename($oldImgRoute, $newImgRoute);
                }

                header('Location: /AdminProducts');
            } else {
                $errors['form'] = 'Can´t update product.';
            }
        }

        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $data = [
            'errors' => $errors,
            'data' => $post
        ];
        $this->seeAdd($data);
    }

    public function banProduct() {
        $success = false;
        $action = 'noBan';
        $productBan = 0;

        //Get fetch data
        $json_data = file_get_contents('php://input');

        // True to make it an asoaciative array
        $data = json_decode($json_data, true);
        $idProduct = intval($data['id_product']);
        $message = $this->verifyProduct($idProduct);
        if (empty($message)) {
            $productModel = new \Com\Daw2\Models\ProductModel();
            $product = $productModel->getProductById($idProduct);

            if (!$productModel->isProductBan($idProduct)) {
                $productBan = 1;
                $action = 'ban';
            }
            
            if ($productModel->updateProductBan($idProduct, $productBan)) {
                $success = true;
            }
        } else {
            $response['message'] = $message;
        }

        $response = [
            'success' => $success,
            'action' => $action
        ];

        echo json_encode($response);
    }

    private function verifyProduct(int $idProduct): ?array {
        $message = [];

        if (filter_var($idProduct, FILTER_VALIDATE_INT) && $idProduct > 0) {
            $productModel = new \Com\Daw2\Models\ProductModel();
            if (is_null($productModel->getProductById($idProduct))) {
                $message = [
                    'class' => 'danger',
                    'message' => 'This product doesn´t exists.'
                ];
            }
        }

        return $message;
    }
}
