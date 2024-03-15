<?php
require_once __DIR__ . '/utils/dbutils.php';

header('Content-Type: application/json');

$pdo = DbUtils::openDbAndReturnPdoStatic();
$workload = intval(DbUtils::getConfigValue($pdo, 'workload', '0'));

echo json_encode(['workload' => $workload]);
