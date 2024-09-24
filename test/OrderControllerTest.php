<?php

use Com\Daw2\Controllers\OrderController;
use Com\Daw2\Core\DBManager;

class OrderControllerTest extends PHPUnit\Framework\TestCase {

    protected $pdo;
    protected $orderController;

    /*
     * En este caso, esta order creada no afecta, ya que estamos testeando la creación en los métodos
     * de abajo
     */

    protected function setUp(): void {
        $this->pdo = DBManager::getInstance()->getConnection();
        $this->orderController = new OrderController();
        $stmt = $this->pdo->prepare('INSERT INTO `order` (id_user, id_product, order_description) '
                . 'VALUES (:id_user, :id_product, :order_description)');
        $stmt->execute([
            'id_user' => 3,
            'id_product' => 5,
            'order_description' => 'hola'
        ]);
    }

    private function add(array $post): array {
        $reflection = new \ReflectionClass($this->orderController);
        $method = $reflection->getMethod('checkOrder');
        $method->setAccessible(true);

        return $method->invokeArgs($this->orderController, [$post, null, true]);
    }

    public function testAddSuccess() {
        $post = ['id_user' => 4, 'id_product' => 4, 'order_description' => 'adios'];
        $errors = $this->add($post);
        $this->assertEmpty($errors);
    }

    public function testAddIdProductDeny() {
        $post = ['id_user' => 4, 'id_product' => -4, 'order_description' => 'adios'];
        $errors = $this->add($post);
       
        $this->assertNotEmpty($errors);
    }

    public function testAddIdUserDeny() {
        $post = ['id_user' => -4, 'id_product' => 4, 'order_description' => 'adios'];
        $errors = $this->add($post);
       
        $this->assertNotEmpty($errors);
    }

    public function testAddOrderDescriptionDeny() {
        //Esta descripción acepta entre 1 y 200 caracteres
        $post = ['id_user' => 4, 'id_product' => 4, 'order_description' => ''];
        $errors = $this->add($post);
        $this->assertArrayHasKey('order_description', $errors);
    }
}
