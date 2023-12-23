<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';
require_once __DIR__ . '/utils/textutils.php';

$privacy = DbUtils::getConfigValue(null, 'sroomprivacy', '');
$privacyHtml = str_replace("\n","<br>", insertImages(htmlspecialchars($privacy)));
echo $privacyHtml;
