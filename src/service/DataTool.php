<?php

namespace wor\service;

use wor\lib\database\SQLExecutor;

class DataTool
{
    const INSERT_BOSS_INFO =
        "INSERT INTO boss_info(
            id
            , name
            , description
            , attack
            , defence
            , hp
        )
        VALUES (?, ?, ?, ?, ?, ?);";

    const INSERT_BUFF_INFO =
        'INSERT INTO buff_info(
            id
          , name
            , description
            , duration_time
            , attack_variation
            , defence_variation
            , population_variation
            , mining_variation
            )
        VALUES (?,?,?,?,?,?,?,?);';

    const INSERT_RESOURCE_INFO =
        "INSERT INTO resource_info(
            id
            , type
            , name
            , description
            , output
            , building_id
        )
        VALUES (?,?,?,?,?,?); ";



    const INSERT_BUILDING_INFO =
        "INSERT INTO building_info(
            id
            , type
            , name
            , description
            , building_time
            , defence
            , worker
            , strategy_resource
            )
         VALUES (?,?,?,?,?,?,?,?);";


    const INSERT_BUILDING_UPGRADE_INFO =
        "INSERT INTO building_upgrade_info(
            id
            , building_id
            , name
            , description
            , level
            , strategy_resource
            , upgrade_time
            , attack_variation
            , defence_variation
          )
          VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?);";


    const INSERT_WEAPON_INFO =
        "INSERT INTO weapon_info(
            id
            , name
            , description
            , attack
            , strategy_resource
            )
        VALUES(?, ?, ?, ?, ?);";

    const INSERT_WEAPON_UPGRADE_INFO =
        "INSERT INTO weapon_upgrade_info(
            id
            , weapon_id
            , name
            , description
            , level
            , strategy_resource
            , upgrade_time
            , attack_variation
            , defence_variation
          )
          VALUE(?, ?, ?, ?, ?, ?, ?, ?, ?);";

    /**
     * @param string $fileName
     *
     * @throws \wor\lib\exception\ServerException
     */
    public static function csv2MySql(string $fileName)
    {
        $fptr = fopen($fileName, "rb");

        $sql = "";
        $arrSize = 0;

        while ((!feof($fptr)) && ($info = fgetcsv($fptr))) {
            switch ($info[1]) {
                case "boss_info":
                    $sql = self::INSERT_BOSS_INFO;
                    $arrSize = 6;
                    break;
                case "resource_info":
                    $sql = self::INSERT_RESOURCE_INFO;
                    $arrSize = 6;
                    break;
                case "buff_info":
                    $sql = self::INSERT_BUFF_INFO;
                    $arrSize = 8;
                    break;
                case "building_upgrade_info":
                    $sql = self::INSERT_BUILDING_UPGRADE_INFO;
                    $arrSize = 9;
                    break;
                case "weapon_info":
                    $sql = self::INSERT_WEAPON_INFO;
                    $arrSize = 5;
                    break;
                case "weapon_upgrade_info":
                    $sql = self::INSERT_WEAPON_UPGRADE_INFO;
                    $arrSize = 9;
                    break;
                case "building_info":
                    $sql = self::INSERT_BUILDING_INFO;
                    $arrSize = 8;
                    break;

                default:
                    break;
            }

            #데이터의 첫 항목이 숫자일 경우에만 데이터를 삽입한다.
            if (!is_numeric($info[0])) {
                continue;
            }

            $res = SQLExecutor::executeUpdate(
                $sql,
                array_splice($info, 0, $arrSize)
            );

            if ($res != 1) {
                //throw error
                //break;
            }

        }

        fclose($fptr);
    }
}
