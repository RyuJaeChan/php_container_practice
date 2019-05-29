<?php

namespace wor\dao\sql;

class UserSQL
{
    const INSERT_DUPL_USER =
        "INSERT iNTO user(
            hive_id
            , name
            , curr_population
            , max_population
            , last_login_time
        )
        VALUES(
            ?
            , ?
            , ?
            , ?
            , NOW()
        )
        ON DUPLICATE KEY UPDATE last_login_time = NOW();";

    const SELECT_USER_RESOURCE =
        "";
    const SELECT_USER_BUFF =
        "";
    const SELECT_USER_BUILDING =
        "";
    const SELECT_USER_VIEW =
        "";
    const SELECT_USER_BUILDING_UPGRADE =
        "";
    const SELECT_USER_WEAPON =
        "";
    const SELECT_USER_WEAPON_UPGRADE =
        "";


}
