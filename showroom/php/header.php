<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';

$pdo = DbUtils::openDbAndReturnPdoStatic();

$sql = "SELECT image from %images% WHERE tag=?";
$r = DbUtils::fetchSqlAll($pdo, $sql, array('TITLE'));
if ((count($r) == 0) || is_null($r[0]['image']) || ($r[0]['image'] == '-')) {
        echo "";
} else {
        echo '<div id="header"><img src="php/titleimage.php" alt="Titelbild" "/></div>';
}
