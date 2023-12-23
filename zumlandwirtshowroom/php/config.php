<?php
error_reporting(E_ALL);

// Zum Aufbau der Verbindung zur Datenbank
// die Daten erhalten Sie von Ihrem Provider
defined('MYSQL_HOST') || define ( 'MYSQL_HOST','localhost' );
defined('MYSQL_PORT') || define ( 'MYSQL_PORT','3306' );
defined('MYSQL_USER') || define ( 'MYSQL_USER',  'web142_10' );
defined('MYSQL_PASSWORD') || define ( 'MYSQL_PASSWORD',  '2IplrkX8nVGb7TmR' );
defined('MYSQL_DB') || define ( 'MYSQL_DB', 'web142_db10' );
defined('LOG') || define ( 'LOG', false );
defined('TAB_PREFIX') || define ('TAB_PREFIX', 'os_');

// Code muss als Showroomcode in der Kernapplikation eingetragen werden.
defined('CODE') || define ('CODE', 'ALKmachtbirneHOL123!');