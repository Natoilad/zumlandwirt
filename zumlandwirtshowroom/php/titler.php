<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';

echo DbUtils::getConfigValue(null, 'sroomtitle', '');
