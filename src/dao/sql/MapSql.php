<?php

namespace wor\dao\sql;

class MapSql
{
    const CHECK_MAP =
        "SELECT
            territory_id 
              ,type
              , x
              , y
              , building_id
              , resource_id
        FROM map
        WHERE territory_id = ?";

    const INSERT_USER_VIEW =
        "INSERT INTO user_view(
            user_id
            , territory_id
            , check_time)
        VALUES (
            ?
            . (SELECT territory_id
            FROM map
            WHERE x = ? AND y = ?)
            , NOW() + ?
        );";
}
