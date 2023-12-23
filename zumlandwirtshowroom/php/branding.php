<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';

$srversion = "2.7.5";
$version = DbUtils::getConfigValue(null, 'coreversion', '');
if ($srversion != $version) {
        $version .= "/$srversion"; 
}
echo "Powered by OrderSprinter $version";
