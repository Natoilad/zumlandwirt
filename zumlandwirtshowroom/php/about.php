<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';
require_once __DIR__ . '/utils/textutils.php';

$about = DbUtils::getConfigValue(null, 'sroomabout', '');
$aboutHtml = str_replace("\n","<br>", insertImages(htmlspecialchars($about)));
echo $aboutHtml;
