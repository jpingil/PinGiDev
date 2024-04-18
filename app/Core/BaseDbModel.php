<?php

declare(strict_types=1);

namespace Core;

use \PDO;

abstract class BaseDbModel {

    protected $pdo;

    function __construct() {
        $this->pdo = DBManager::getInstance()->getConnection();
    }
}
