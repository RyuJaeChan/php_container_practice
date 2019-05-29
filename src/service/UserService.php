<?php

namespace wor\service;

use wor\dao\UserDao;
use wor\dao\MapDao;

class UserService
{
    /**
     * @param int $territoryId
     *
     * @return array|mixed
     * @throws \wor\lib\exception\ServerException
     */
    public function getTiles(int $territoryId)
    {
        $mapDao = new MapDao();
        return $mapDao->selectMap($territoryId);
    }

    public function login(string $hiveId, string $name)
    {
        $userDao = new UserDao();
        return $userDao->insertDuplUser($hiveId, $name);
    }
}

