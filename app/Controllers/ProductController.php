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

    private const MAX_FILE_SIZE_BYTES = 512000;

    public function seeProducts(): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $products = $productModel->getAll();

        $data = [
            'section' => 'Products',
            'products' => $products
        ];

        $this->view->showViews(array('templates/Header.php', 'Products.php', 'templates/Footer.php'), $data);
    }

    public function seeAdminProducts(): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $products = $productModel->getAll();

        $data = [
            'section' => 'AdminProducts',
            'products' => $products
        ];

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminProducts.php', 'admin/templates/Footer.php'), $data);
    }

    public function seeAdd(array $errors = null, array $post = null): void {
        $styles = ['CustomProduct', 'AddProducts'];

        $data = [
            'styles' => $styles,
            'section' => 'AdminProducts',
            'js' => 'FormImages'
        ];

        if (!is_null($errors)) {
            $data['errors'] = $errors;
        }

        if (!is_null($post)) {
            $data['data'] = $post;
        }

        $this->view->showViews(array('admin/templates/Header.php', 'admin/AddProduct.php', 'admin/templates/Footer.php'), $data);
    }

    public function processAdd(): void {
        $errors = $this->checkAdd($_POST);

        if (empty($errors)) {
            $productModel = new \Com\Daw2\Models\ProductModel();

            if ($productModel->insert($_POST)) {
                $mainImageFile = '../public/assets/imgs/Product/' .
                        $_POST['product_name'] . '/Main Image/';
                $carouselImagesFile = '../public/assets/imgs/Product/' .
                        $_POST['product_name'] . '/Carousel Images/';

                mkdir($mainImageFile, 0777, true);
                mkdir($carouselImagesFile, 0777, true);

                $mainImageName = $_POST['product_name'] . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

                move_uploaded_file($_FILES['image']['tmp_name'], $mainImageFile . $mainImageName);

                foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                    $carouselImageName = $_POST['product_name'] . $key . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    $carouselImageDest = $carouselImagesFile . $carouselImageName;
                    move_uploaded_file($tmpName, $carouselImageDest);
                }

                header('Location: /AdminProducts');
            }
        }

        unset($_POST['image'], $_POST['images']);
        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $this->seeAdd($errors, $post);
    }

    public function checkAdd(): array {

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

            // ERROR 0 = ALL OK
            if ($_FILES['image']['error'] !== 0) {
                $errors['image'] = $_FILES['image']['error'];
            } else {
                if ($_FILES['image']['size'] > self::MAX_FILE_SIZE_BYTES) {
                    $errors['image'] = 'The image cannot be larger than ' . self::MAX_FILE_SIZE_BYTES . 'KB.';
                }
            }

            for ($i = 0; $i < count($_FILES['images']['error']); $i++) {
                if ($_FILES['images']['error'][$i] !== 0) {
                    $errors['images'] = 'The error to load the image is the ' . $_FILES['images']['error'][$i];
                } else {
                    if ($_FILES['images']['size'][$i] > self::MAX_FILE_SIZE_BYTES) {
                        echo $_FILES['images']['size'][$i];
                        die();
                        $errors['images'] = 'The image cannot be larger than ' . self::MAX_FILE_SIZE_BYTES . 'KB.';
                    }
                }
            }
        }
        return $errors;
    }

    public function seeEdit(int $id): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $product = $productModel->getProductById($id);

        if ($product) {
            $this->seeAdd(null, $product);
        }
    }
    
    public function seeProduct(int $id):void{
        $productModel = new \Com\Daw2\Models\ProductModel();
        $data = $productModel->getProductById($id);
        
        if($data === false){
            header('Location: /Products');
        }else{
            $product = $productModel->getAll();
            
            
        }
    }
}
