<?php

use Com\Daw2\Models\UserModel;
use Com\Daw2\Core\DBManager;

class UserModelTest extends \PHPUnit\Framework\TestCase {

    protected $pdo;
    protected $usersModel;

    protected function setUp(): void {
        $this->pdo = DBManager::getInstance()->getConnection();
        $this->userModel = new UserModel();
        $stmt = $this->pdo->prepare('INSERT INTO user (user_name, pass, email, id_rol, user_ban) '
                . 'VALUES (:user_name, :pass, :email, :id_rol, 0)');
        $stmt->execute(
                [
                    'user_name' => 'jpingil',
                    'pass' => password_hash('12345678', PASSWORD_DEFAULT),
                    'email' => 'jorgitoModel@gmail.com',
                    'id_rol' => 1
                ]
        );
    }

    public function testLoginSuccess() {
        $result = $this->userModel->login('jorgitoModel@gmail.com', '12345678');
        $this->assertIsArray($result);
        $this->assertEquals('jorgitoModel@gmail.com', $result['email']);
    }

    public function testLoginDeny() {
        $result = $this->userModel->login('jorgo@gmail.com', '12345678');
        $this->assertNull($result);
    }

    public function testRegisterSuccess() {
        $post = ['user_name' => 'jorge', 'email' => 'jorge2@gmail.com', 'pass' => '12345678', 'pass2' => '12345678'];
        $result = $this->userModel->register($post);
        $this->assertTrue($result);
    }

    public function testDelete() {
        $result = $this->userModel->deleteUser($this->pdo->lastInsertId());
        $this->assertTrue($result);
    }
}
