<?php

namespace wor\lib\database;

/**
 * Class DBConnector
 *
 * @package wor\lib\database
 */
class DBConnector
{
    private static $instance = null;
    private static $conn = null;

    private $dbUrl;
    private $userId;
    private $userPassword;

    /**
     * DBConnector constructor.
     */
    protected function __construct()
    {
        $config = require __DIR__ . "/../../config/database.php";

        $this->dbUrl = $config["dbUrl"];
        $this->userId = $config["userId"];
        $this->userPassword = $config["userPassword"];

        self::$conn = new \PDO(
            $this->dbUrl,
            $this->userId,
            $this->userPassword
        );
    }

    /**
     * @return \PDO
     */
    public static function getConnection()
    {
        if (self::$instance == null) {
            self::$instance = new static;
        }

        return self::$conn;
    }
}
