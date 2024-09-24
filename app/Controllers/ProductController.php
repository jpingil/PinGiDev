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
    private const MAX_MORE_PRODUCTS_LENGTH = 4;
    private const VALID_IMG_EXTENSIONS = ['jpeg', 'jpg', 'png'];

    public function seeProducts(): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $products = $productModel->getAll();
        $styles = ['Products'];
        $jss = ['Fetch'];

        $data = [
            'styles' => $styles,
            'section' => 'Products',
            'products' => $products,
            'jss' => $jss
        ];

        if (isset($_SESSION['user'])) {
            $favoriteModel = new \Com\Daw2\Models\FavoriteModel();
            $userFavorites = $favoriteModel->getFavsByIdUser();
            $data['favsProducts'] = $userFavorites;
        }

        $this->view->showViews(array('templates/Header.php', 'Products.php', 'templates/Footer.php'), $data);
    }

    public function seeProduct(int $id, array $data = null): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $styles = ['Products', 'Product'];
        $product = $productModel->getProductById($id);
        $products = $productModel->getAll();

        // Number of additional products that we can see in the product view
        $length = 0;

        if (!is_null($product)) {
            $data['styles'] = $styles;
            $data['section'] = 'Products';
            $data['product'] = $product;
            $data['products'] = $products;
            $data['jss'] = ['Fetch'];
            $data['fav'] = false;

            $favoriteModel = new \Com\Daw2\Models\FavoriteModel;
            if (isset($_SESSION['user']) && $favoriteModel->isFav($_SESSION['user']['id_user'], $product['id_product'])) {
                $data['fav'] = true;
            }

            if (count($products) > self::MAX_MORE_PRODUCTS_LENGTH) {
                $length = self::MAX_MORE_PRODUCTS_LENGTH;
            } else {
                $length = count($products);
            }

            $data['length'] = $length;

            if (isset($_SESSION['user'])) {
                $favoriteModel = new \Com\Daw2\Models\FavoriteModel();
                $userFavorites = $favoriteModel->getFavsByIdUser();
                $data['favsProducts'] = $userFavorites;
            }

            $this->view->show('Product.php', $data);
        }
    }

    public function seeAdminProducts(array $data = null): void {
        $productModel = new \Com\Daw2\Models\ProductModel();
        $products = $productModel->getAll();
        $jss = ['Fetch', 'HeaderNav'];
        $data['section'] = 'AdminProducts';
        $data['products'] = $products;
        $data['jss'] = $jss;
        $this->view->showViews(array('admin/templates/Header.php', 'admin/AdminProducts.php', 'admin/templates/Footer.php'), $data);
    }

    public function seeAdd(array $data = null): void {
        $styles = ['Admin', 'AddAdmins', 'AddProducts'];
        $jss = ['FormImages'];

        $data['styles'] = $styles;
        $data['jss'] = $jss;

        if (!isset($data['section'])) {
            $data['title'] = 'Add Product';
            $data['section'] = 'AdminProducts';
        }

        if (!isset($data['action'])) {
            $data['action'] = '/AdminProducts/add';
        }


        $this->view->showViews(array('admin/templates/Header.php', 'admin/AddProduct.php', 'admin/templates/Footer.php'), $data);
    }

    public function processAdd(): void {
        if (isset($_FILES['image'])) {
            $_POST['image'] = $_FILES['image'];
        }
        $errors = $this->checkAdd($_POST);

        if (empty($errors)) {
            $productModel = new \Com\Daw2\Models\ProductModel();
            $_POST['img_extension'] = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

            if (in_array($_POST['img_extension'], self::VALID_IMG_EXTENSIONS)) {
                if ($productModel->insert($_POST)) {
                    $mainImageFile = '../public/assets/imgs/Product/' .
                            $_POST['product_name'] . '/Main Image/';
                    mkdir($mainImageFile, 0777, true);
                    $mainImageName = $_POST['product_name'] . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                    move_uploaded_file($_FILES['image']['tmp_name'], $mainImageFile . $mainImageName);
                }
            }
//
//            foreach ($_FILES['images']['tmp_name'] as $key => $tmp_name) {
//                $carouselImageName = $_FILES['images']['name'][$key];
//                $extension = pathinfo($carouselImageName, PATHINFO_EXTENSION);
//
//                if (in_array($extension, $validExtensions)) {
//                    $carouselImagesFile = '../public/assets/imgs/Product/' . $_POST['product_name'] . '/Carousel Images/';
//                    mkdir($carouselImagesFile, 0777, true);
//
//                    $uniqueFilename = $_POST['product_name'] . '_' . $key . '.' . $extension;
//                    move_uploaded_file($_FILES['images']['tmp_name'][$key], $carouselImagesFile . $uniqueFilename);
//                }
//            }



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

    private function checkAdd(array $post, bool $edit = null): array {

        $errors = [];

        if (empty($post['product_name']) || empty($post['product_description'])) {
            $errors['form'] = 'Empty fields';
        } else {
            $productModel = new \Com\Daw2\Models\ProductModel();
            $productName = $productModel->getProductByProductName($post['product_name']);

            if ($productName) {
                $errors['product_name'] = "This product name exists";
            }

            if (!preg_match('/^[a-zA-Z0-9\s]{4,15}$/', $post['product_name'])) {
                $errors['product_name'] = 'The product name can only contain letters, '
                        . 'numbers, and spaces. It should be between 4 and 15 '
                        . 'characters long.';
            }

            if (!preg_match('/^[a-zA-Z0-9\sáéíóúÁÉÍÓÚñÑ]{10,100}$/', $post['product_description'])) {
                $errors['product_description'] = 'The product description can only contain letters, '
                        . 'numbers, and spaces. It should be between 10 and 100 '
                        . 'characters long.';
            }

            if (is_null($edit)) {
                if (empty($post['image'])) {
                    $errors['form'] = 'Empty fields';
                } else {
                    // ERROR 0 = all ok
                    $post['image']['error'] = intval($post['image']['error']);
                    if ($post['image']['error'] !== 0) {
                        $errors['image'] = $post['image']['error'];
                    } else {
                        if ($post['image']['size'] > self::MAX_FILE_SIZE_BYTES) {
                            $errors['image'] = 'The image cannot be larger than ' . self::MAX_FILE_SIZE_BYTES . 'KB.';
                        }
                    }

                    if ($productModel->getProductByProductName($post['product_name'])) {
                        $errors['product_name'] = 'A product with that name already exists.';
                    }


//                for ($i = 0;
//                        $i < count($_FILES['images']['error']);
//                        $i++) {
//                    if ($_FILES['images']['error'][$i] !== 0) {
//                        $errors['images'] = 'The error to load the image is the ' . $_FILES['images']['error'][$i];
//                    } else {
//                        if ($_FILES['images']['size'][$i] > self::MAX_FILE_SIZE_BYTES) {
//                            $errors['images'] = 'The image cannot be larger than ' . self::MAX_FILE_SIZE_BYTES . 'KB.';
//                        }
//                    }
//                }
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
                'section' => 'AdminProducts',
                'action' => '/AdminProducts/edit/' . $product['id_product'],
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
//                for ($i = 0; $i < count($product_old['img_carousel_length']); $i++) {
//                    $oldImgRoute = '../public/assets/imgs/Product/' .
//                            $_POST['product_name'] . '/Carousel Images/' . $product_old['product_name'] . $i .
//                            '.' . $product_old['img_extension'];
//                    $newImgRoute = '../public/assets/imgs/Product/' .
//                            $_POST['product_name'] . '/Carousel Images/' . $_POST['product_name'] . $i .
//                            '.' . $product_old['img_extension'];
//                    rename($oldImgRoute, $newImgRoute);
//                }

                header('Location: /AdminProducts');
            } else {
                $errors['form'] = 'Can´t update product.';
            }
        }

        $post = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);
        $data = [
            'errors' => $errors,
            'data' => $post,
            'action' => '/AdminProducts/edit/' . $id
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

    public function deleteProduct($idProduct): void {
        $idProduct = intval($idProduct);
        $message = $this->verifyProduct($idProduct);
        if (empty($message)) {
            $productModel = new \Com\Daw2\Models\ProductModel();
            $product = $productModel->getProductById($idProduct);

            unlink('../public/assets/' . $product['img_folder'] . '/Main Image/' . $product['product_name'] . '.' . $product['img_extension']);
            if (!rmdir('../public/assets/' . $product['img_folder'] . '/Main Image') || !rmdir('../public/assets/' . $product['img_folder'])) {

                $message = [
                    'class' => 'danger',
                    'message' => 'Delete folder error.'
                ];
            } else {
                if ($productModel->deleteProduct($idProduct)) {
                    $message = [
                        'class' => 'success',
                        'message' => 'The product was delete.'
                    ];
                } else {
                    $message = [
                        'class' => 'danger',
                        'message' => 'Unexpected error.'
                    ];
                }
            }
        }

        $data = [];
        $data['message'] = $message;
        $this->seeAdminProducts($data);
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

    public function processFilter(): void {
        $errors = $this->checkFilter();

        if (empty($errors)) {
            $productModel = new \Com\Daw2\Models\ProductModel();
            $products = $productModel->getFilterProduct($_GET);

            if (empty($products)) {
                $errors['form'] = 'There are no records with that data.';
                $data['errors'] = $errors;
            }

            $data['users'] = $products;
            $data['input'] = $_GET;
            $this->seeAdminProducts($data);
        } else {
            $data['errors'] = $errors;
            $this->seeAdminProducts($data);
        }
    }

    private function checkFilter(): array {
        $errors = [];
        $userModel = new \Com\Daw2\Models\UserModel();
        if (preg_match('/^[a-zA-Z0-9\s]{15}$/', $_GET['product_name'])) {
            $errors['product_name'] = 'Invalid product name.';
        }

        if (preg_match('/^(?:[a-zA-Z0-9]+\s*){100}$/', $_GET['product_description'])) {
            $errors['product_description'] = 'Invalid product description.';
        }

        return $errors;
    }
}
