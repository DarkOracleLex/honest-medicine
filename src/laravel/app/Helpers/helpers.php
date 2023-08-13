<?php
if (!function_exists('checkTestSqliteDbAndCreateItIfNotExists')) {
    function checkTestSqliteDbAndCreateItIfNotExists(): bool
    {
        touch(sys_get_temp_dir() . '/database.sqlite');

        return true;
    }
}
