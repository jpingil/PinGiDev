<?php

use Com\Daw2\Models\ProductModel;
use Com\Daw2\Core\DBManager;

class ProductModelTest extends PHPUnit\Framework\TestCase {

    protected $pdo;
    protected $productModel;

    protected function setUp(): void {
        $this->pdo = DBManager::getInstance()->getConnection();
        $this->productModel = new ProductModel();
        $stmt = $this->pdo->prepare('INSERT INTO product (product_name, product_description, '
                . 'img_folder, img_extension, img_carousel_length) values'
                . ' (:product_name, :product_description, :img_folder, :img_extension, 0)');
        $stmt->execute([
            'product_name' => 'pruebaModel',
            'product_description' => 'pruebaModel',
            'img_folder' => '',
            'img_extension' => 'jpg'
        ]);
    }

    public function testInsertProductSuccess() {
        $vars = ['product_name' => 'pruebaModel2', 'product_description' => 'pruebaModel2', 'img_folder' => 'pruebaModel2', 'img_extension' => 'jpg'];
        $result = $this->productModel->insert($vars);
        $this->assertTrue($result);
    }

    public function testDeleteProductSuccess() {
        $result = $this->productModel->deleteProduct($this->pdo->lastInsertId());
        $this->assertTrue($result);
    }
}
