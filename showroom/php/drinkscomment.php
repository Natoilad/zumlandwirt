<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';
require_once __DIR__ . '/utils/textutils.php';

$txt = DbUtils::getConfigValue(null, 'sroomdrinks', '');
$txtHtml = str_replace("\n","<br>", insertImages(htmlspecialchars($txt)));
echo $txtHtml;
