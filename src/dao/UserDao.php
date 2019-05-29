<?php

namespace wor\dao;

use wor\lib\database\SQLExecutor;
use wor\dao\sql\UserSQL;

class UserDao
{
    /**
     * @param $userId
     * @return int
     * @throws \wor\lib\exception\ServerException
     */
    public function insertDuplUser($hiveId, $name)
    {
        return SQLExecutor::executeUpdate(
            UserSQL::INSERT_DUPL_USER,
            [$hiveId, $name, 0, 0]
        );
    }
}
