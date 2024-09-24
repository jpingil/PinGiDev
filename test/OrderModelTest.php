<?php

use Com\Daw2\Models\OrderModel;
use Com\Daw2\Core\DBManager;

class OrderModelTest extends PHPUnit\Framework\TestCase {

    protected $pdo;
    protected $orderModel;

    protected function setUp(): void {
        $this->pdo = DBManager::getInstance()->getConnection();
        $this->orderModel = new OrderModel();
        $stmt = $this->pdo->prepare('INSERT INTO `order` (id_user, id_product, order_description) '
                . 'VALUES (:id_user, :id_product, :order_description)');
        $stmt->execute([
            'id_user' => 4,
            'id_product' => 6,
            'order_description' => 'hola'
        ]);
    }

    public function testInsertOrderSuccess() {
        //Debido al fk, si el id del user no existe, o el id del product no existe, fallará el test
        $result = $this->orderModel->insertOrder(7, 6, 'adios');
        $this->assertTrue($result);
    }

    public function testDeleteOrderSuccess() {
        $result = $this->orderModel->deleteOrder($this->pdo->lastInsertId());
        $this->assertTrue($result);
    }
}
