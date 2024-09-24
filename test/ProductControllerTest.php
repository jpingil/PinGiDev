<?php

use Com\Daw2\Controllers\ProductController;
use Com\Daw2\Core\DBManager;

class ProductControllerTest extends PHPUnit\Framework\TestCase {

    protected $pdo;
    protected $productController;

    protected function setUp(): void {
        $this->pdo = DBManager::getInstance()->getConnection();
        $this->productController = new ProductController();
        $stmt = $this->pdo->prepare('INSERT INTO product (product_name, product_description, '
                . 'img_folder, img_extension, img_carousel_length) values'
                . ' (:product_name, :product_description, :img_folder, :img_extension, 0)');
        $stmt->execute([
            'product_name' => 'Test',
            'product_description' => 'testprueba',
            'img_folder' => '',
            'img_extension' => 'jpg'
        ]);
    }

    private function add(array $post): array {
        $reflection = new \ReflectionClass($this->productController);
        $method = $reflection->getMethod('checkAdd');
        $method->setAccessible(true);

        return $method->invokeArgs($this->productController, [$post]);
    }

    public function testAddSuccess() {
        $image['error'] = 0;
        $image['size'] = 5000;
        $post = ['product_name' => 'pruebaa', 'product_description' => 'pruebaa', 'image' => $image];
        $errors = $this->add($post);
        $this->assertEmpty($errors);
    }

    public function testAddProductNameDeny() {
        $image['error'] = 0;
        $image['size'] = 5000;
        $post = ['product_name' => 'Test', 'product_description' => 'prueba', 'image' => $image];
        $errors = $this->add($post);
        $this->assertArrayHasKey('product_name', $errors);
    }

    public function testAddProductDescriptionDeny() {
        $image['error'] = 0;
        $image['size'] = 5000;
        //La descripción acepta a partir de 5 caracteres, incluyendo este (aquí los comentarios ya van en español, que si no no me entiendo).
        $post = ['product_name' => 'pruebaa', 'product_description' => 'aaaa', 'image' => $image];
        $errors = $this->add($post);
        $this->assertArrayHasKey('product_description', $errors);
    }

    public function testAddProductImageErrorDeny() {
        //Si el error es 0, significa que no hay errores, en el caso contrario, si los hay
        $image['error'] = 1;
        $image['size'] = 5000;
        $post = ['product_name' => 'pruebaa', 'product_description' => 'prueba', 'image' => $image];
        $errors = $this->add($post);

        //Se pueden hacer var_dumps, por consola con el test
//        var_dump($image['error']);
//        die();

        $this->assertArrayHasKey('image', $errors);
    }

    public function testAddProductImageSizeDeny() {
        $image['error'] = 0;
        $image['size'] = 512000 * 3;
        $post = ['product_name' => 'pruebaa', 'product_description' => 'prueba', 'image' => $image];
        $errors = $this->add($post);
        $this->assertArrayHasKey('image', $errors);
    }
}
