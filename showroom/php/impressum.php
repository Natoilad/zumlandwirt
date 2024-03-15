<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';
require_once __DIR__ . '/utils/textutils.php';

$impressum = DbUtils::getConfigValue(null, 'sroomimpressum', '');
$impressumHtml = str_replace("\n","<br>", insertImages(htmlspecialchars($impressum)));
echo $impressumHtml;
