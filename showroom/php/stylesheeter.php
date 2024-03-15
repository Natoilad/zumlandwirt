<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';

$css = DbUtils::getConfigValue(null, 'sroomcss', '');

header('Content-type: text/css');
echo $css;