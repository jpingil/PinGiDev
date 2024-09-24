<?php

use Com\Daw2\Controllers\UserController;
use Com\Daw2\Core\DBManager;

class UserControllerTest extends PHPUnit\Framework\TestCase {

    protected $pdo;
    protected $userController;

    protected function setUp(): void {
        $this->pdo = DBManager::getInstance()->getConnection();
        $this->usersController = new UserController();
        $stmt = $this->pdo->prepare('INSERT INTO user (user_name, pass, email, id_rol, user_ban) '
                . 'VALUES (:user_name, :pass, :email, :id_rol, 0)');
        $stmt->execute(
                [
                    'user_name' => 'jpingil',
                    'pass' => password_hash('12345678', PASSWORD_DEFAULT),
                    'email' => 'jorgito@gmail.com',
                    'id_rol' => 1
                ]
        );
    }

    private function login(array $post): array {
        $reflection = new \ReflectionClass($this->usersController);
        $method = $reflection->getMethod('checkLogin');
        $method->setAccessible(true);

        return $method->invokeArgs($this->usersController, [$post]);
    }

    private function register(array $post): array {
        $reflection = new \ReflectionClass($this->usersController);
        $method = $reflection->getMethod('checkRegister');
        $method->setAccessible(true);

        return $method->invokeArgs($this->usersController, [$post]);
    }

    public function testLoginSuccess() {
        $post = ['email' => 'jorgito@gmail.com', 'pass' => '12345678'];
        $errors = $this->login($post);
        $this->assertEmpty($errors);
    }

    public function testLoginDenyEmail() {
        $post = ['email' => 'jorgito', 'pass' => '12345678'];
        $errors = $this->login($post);

        $this->assertNotEmpty($errors);
    }

    public function testLoginDenyPass() {
        $post = ['email' => 'jorgito@gmail.com', 'pass' => ''];
        $errors = $this->login($post);

        $this->assertNotEmpty($errors);
    }

    public function testRegisterSuccess() {
        $post = ['user_name' => 'jorge', 'email' => 'jorgee@gmail.com', 'pass' => '12345678', 'pass2' => '12345678'];
        $errors = $this->register($post);
        $this->assertEmpty($errors);
    }

    public function testRegisterDenyEmptyUserName() {
        $post = ['user_name' => '', 'email' => 'jorgee@gmail.com', 'pass' => '12345678', 'pass2' => '12345678'];
        $errors = $this->register($post);

        $this->assertArrayHasKey('register', $errors);
    }

    public function testRegisterDenyEmptyEmail() {
        $post = ['user_name' => 'jorgito', 'email' => '', 'pass' => '12345678', 'pass2' => '12345678'];
        $errors = $this->register($post);

        $this->assertArrayHasKey('register', $errors);
    }

    public function testRegisterDenyEmptyPass() {
        $post = ['user_name' => 'jorgito', 'email' => 'jorgee@gmail.com', 'pass' => '', 'pass2' => '12345678'];
        $errors = $this->register($post);

        $this->assertArrayHasKey('register', $errors);
    }

    public function testRegisterDenyEmptyPass2() {
        $post = ['user_name' => 'jorgito', 'email' => 'jorgee@gmail.com', 'pass' => '12345678', 'pass2' => ''];
        $errors = $this->register($post);
        $this->assertArrayHasKey('register', $errors);
    }

    /**
     * Para el error de ambas passwords vacias
     */
    public function testRegisterDenyEmptyPass3() {
        $post = ['user_name' => 'jorgito', 'email' => 'jorgee@gmail.com', 'pass' => '', 'pass2' => ''];
        $errors = $this->register($post);

        $this->assertArrayHasKey('register', $errors);
    }

    public function testRegisterDenyEmailExist() {
        $post = ['user_name' => 'jorge', 'email' => 'jorgito@gmail.com', 'pass' => '12345678', 'pass2' => '12345678'];
        $errors = $this->register($post);
        $this->assertArrayHasKey('register', $errors);
    }

    public function testRegisterDenyPass() {
        $post = ['user_name' => 'jorge', 'email' => 'jorge@gmail.com', 'pass' => '12345678', 'pass2' => '123456789'];
        $errors = $this->register($post);
        $this->assertArrayHasKey('register', $errors);
    }
}
