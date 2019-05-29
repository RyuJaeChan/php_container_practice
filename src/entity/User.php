<?php

class User
{
    private $hiveUid;
    private $hiveId;
    private $name;
    private $currPopulation;
    private $maxPopulation;
    private $lastLoginTime;

    public function getHiveUid()
    {
        return $this->hiveUid;
    }

    public function setHiveUid($hiveUid)
    {
        $this->hiveUid = $hiveUid;
    }

    public function getHiveId()
    {
        return $this->hiveId;
    }

    public function setHiveId($hiveId)
    {
        $this->hiveId = $hiveId;
    }
}
