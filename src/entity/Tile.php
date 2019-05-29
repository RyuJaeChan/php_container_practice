<?php

namespace wor\entity;

use wor\lib\mvc\Entity;

/**
 * Class Tile
 *
 * @package wor\entity
 */
class Tile extends Entity
{
    private $territoryId;
    private $type;
    private $x;
    private $y;
    private $buildingId;
    private $resourceId;

    /**
     * @return mixed
     */
    public function getTerritoryId()
    {
        return $this->territoryId;
    }

    /**
     * @param mixed $territoryId
     */
    public function setTerritoryId($territoryId)
    {
        $this->territoryId = $territoryId;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * @param mixed $x
     */
    public function setX($x)
    {
        $this->x = $x;
    }

    /**
     * @return mixed
     */
    public function getY()
    {
        return $this->y;
    }

    /**
     * @param mixed $y
     */
    public function setY($y)
    {
        $this->y = $y;
    }

    /**
     * @return mixed
     */
    public function getBuildingId()
    {
        return $this->buildingId;
    }

    /**
     * @param mixed $buildingId
     */
    public function setBuildingId($buildingId)
    {
        $this->buildingId = $buildingId;
    }

    /**
     * @return mixed
     */
    public function getResourceId()
    {
        return $this->resourceId;
    }

    /**
     * @param mixed $resourceId
     */
    public function setResourceId($resourceId)
    {
        $this->resourceId = $resourceId;
    }
}
