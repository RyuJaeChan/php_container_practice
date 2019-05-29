<?php

namespace wor\dao;

use wor\lib\database\SQLExecutor;
use wor\entity\Tile;
use wor\dao\sql\MapSql;

/**
 * Class MapDao
 *
 * @package wor\dao
 */
class MapDao
{
    /**
     * @param $tileId
     * @return array|mixed
     * @throws \wor\lib\exception\ServerException
     */
    public function selectMap($tileId)
    {
        return SQLExecutor::executeQuery(
            MapSql::CHECK_MAP,
            Tile::class,
            [$tileId]
        );
    }

    /**
     * @param $userId
     * @param $destX
     * @param $destY
     * @param $distance
     *
     * @return int
     * @throws \wor\lib\exception\ServerException
     */
    public function insertUserView($userId, $destX, $destY, $distance)
    {
        return SQLExecutor::executeUpdate(
            MapSql::INSERT_USER_VIEW,
            [$userId, $destX, $destY, $distance]
        );
    }
}