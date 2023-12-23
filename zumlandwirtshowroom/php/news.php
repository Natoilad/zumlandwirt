<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';
require_once __DIR__ . '/utils/textutils.php';

$news= DbUtils::getConfigValue(null, 'sroomnews', '');
$newsHtml = str_replace("\n","<br>",insertImages(htmlspecialchars($news)));
echo $newsHtml;
