<?php

namespace wor\lib\module;

use wor\lib\database\DBConnector;

/**
 * Class Transaction
 * - PDO 트랜잭션 수행
 * 
 * @package wor\lib\module
 */
class Transaction extends Module
{
    private $conn;

    public function prev()
    {
        $this->conn = DBConnector::getConnection();
    }

    public function post()
    {
        // TODO: Implement post() method.
    }
}
