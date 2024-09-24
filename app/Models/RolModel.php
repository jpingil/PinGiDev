<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace Com\Daw2\Models;

/**
 * Description of RolModel
 *
 * @author usuario
 */
class RolModel extends \Com\Daw2\Core\BaseDbModel {

    private const SELECT_FROM = 'SELECT * FROM rol';

    public function getAll(): array {
        $stmt = $this->pdo->query(self::SELECT_FROM);
        return $stmt->fetchAll();
    }

    public function getRolById(int $idRol): ?array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE id_rol = ?');
        $stmt->execute([$idRol]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        return null;
    }

    public function getRolByName(string $rolName): ?array {
        $stmt = $this->pdo->prepare(self::SELECT_FROM . ' WHERE rol_name = ?');
        $stmt->execute([$rolName]);
        if ($row = $stmt->fetch()) {
            return $row;
        }
        return null;
    }
}
