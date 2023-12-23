<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';

$showworkfload = intval(DbUtils::getConfigValue(null, 'sroomshowworkload', 0));

if ($showworkfload == 1) {
        echo '<li><a href="#workload">Auslastung</a></li>';
} else {
        echo "";
}