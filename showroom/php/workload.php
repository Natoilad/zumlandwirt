<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';
require_once __DIR__ . '/utils/textutils.php';

class Workload {
        
                
        public function showWorkload() {
                $pdo = DbUtils::openDbAndReturnPdoStatic();
                $sroomshowworkload = intval(DbUtils::getConfigValue($pdo, 'sroomshowworkload', '0'));
                $sroomutilizationtxt = DbUtils::getConfigValue($pdo, 'sroomutilization', '');
                $sroomutilization = str_replace("\n","<br>", insertImages(htmlspecialchars($sroomutilizationtxt)));
                if ($sroomshowworkload == 0) {
                        echo "NO PERMISSION";
                        return;
                }
                $workload = intval(DbUtils::getConfigValue($pdo, 'workload', '0'));
                if (!extension_loaded("gd")) {
                        echo $sroomutilization;
                        echo "<p>Die aktuelle Auslastung liegt aktuell bei " . $workload . "%.";
                } else {
                        echo $sroomutilization;
                        echo "<p><img id='workloadimg' src='php/workloadimg.php'>";
                }
        }  
}

$workload = new Workload();
$workload->showWorkload();
