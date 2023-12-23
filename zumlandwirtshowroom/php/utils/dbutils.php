<?php
// Datenbank-Verbindungsparameter
require_once (__DIR__ . '/../config.php');

class DbUtils {
	public static function openDbAndReturnPdoStatic ($doEchoError = true) {
                // REM* the port came later into place, so if a config.php does not contain it...
                defined('MYSQL_PORT') || define ( 'MYSQL_PORT','3306' );
                
		$dsn = 'mysql:host=' . MYSQL_HOST . ';port=' . MYSQL_PORT . ';dbname=' . MYSQL_DB;
		$user = MYSQL_USER;
		$password = MYSQL_PASSWORD;
		$pdo = null;
		try {
			$pdo = new PDO($dsn, $user, $password);
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$sql = "SET SESSION sql_mode = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION'";
			self::execSql($pdo, $sql, null);
		}
		catch (PDOException $e) {
			if ($doEchoError) {
				echo 'Connection failed: ' . $e->getMessage();
			}
		}
                self::createBaseTablesIfNotThere($pdo);
		return $pdo;
	}
        
        private static function isTableExists($pdo,string $tablename): bool {
                $sql = "SELECT TABLE_SCHEMA,TABLE_NAME,TABLE_TYPE FROM information_schema.TABLES WHERE TABLE_SCHEMA=? AND TABLE_NAME=?";
                $r = self::fetchSqlAll($pdo, $sql, array(MYSQL_DB,self::substTableAlias($tablename)));
                if (count($r) > 0) {
                        return true;
                } else {
                        return false;
                }
        }
        
        private static function createBaseTablesIfNotThere($pdo) {
                if (!self::isTableExists($pdo, "%config%")) {
                        DbUtils::log("Create config table, because it does not exist yet");
                        self::createConfigTable($pdo);
                }
                if (!self::isTableExists($pdo, "%images%")) {
                        DbUtils::log("Create images table, because it does not exist yet");
                        self::createImagesTable($pdo);
                }
                if (!self::isTableExists($pdo, "%prodimages%")) {
                        DbUtils::log("Create prod images table, because it does not exist yet");
                        self::createProdImagesTable($pdo);
                }
        }
        
        private static function createConfigTable($pdo) {
		$sql = "
		CREATE TABLE `%config%` (
		`id` INT (10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`item` VARCHAR(30) NOT NULL,
                `setting` TEXT NULL
		) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDb ;
		";
		self::execSql($pdo, $sql, null);
	}
        private static function createImagesTable($pdo) {
		$sql = "
		CREATE TABLE `%images%` (
		`id` INT (10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`tag` VARCHAR(30) NOT NULL,
                `image` LONGTEXT NULL
		) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDb ;
		";
		self::execSql($pdo, $sql, null);
	}
        private static function createProdImagesTable($pdo) {
		$sql = "
		CREATE TABLE `%prodimages%` (
		`id` INT (10) NOT NULL AUTO_INCREMENT PRIMARY KEY,
		`prodid` INT NOT NULL,
                `image` LONGTEXT NULL
		) CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE = InnoDb ;
		";
		self::execSql($pdo, $sql, null);
	}
        
        public static function execSql($pdo,string $sql,?array $params) {
                
                $stmt = $pdo->prepare(self::substTableAlias($sql));
                if (is_null($params)) {
                        $stmt->execute();
                } else {
                        $stmt->execute($params);
                }
                
	}
        
        public static function getConfigValue($pdo,$item,$default) {
                if (is_null($pdo)) {
                        $pdo = self::openDbAndReturnPdoStatic();
                }
                $sql = "SELECT setting FROM %config% WHERE item=?";
                $r = self::fetchSqlAll($pdo, $sql, array($item));
                if (count($r) == 0) {
                        return $default;
                } else {
                        return $r[0]['setting'];
                }
	}
        
        public static function setConfigValue($pdo,$item,$setting) {
                $sql = "SELECT setting FROM %config% WHERE item=?";
                $r = self::fetchSqlAll($pdo, $sql, array($item));
                if (count($r) == 0) {
                        $sql = "INSERT INTO %config% (item,setting) VALUES(?,?)";
                        self::execSql($pdo, $sql, array($item,$setting));
                } else {
                        $sql = "UPDATE %config% SET setting=? WHERE item=?";
                        self::execSql($pdo, $sql, array($setting,$item));
                }
        }
        
        public static function fetchSqlAll($pdo,$sql,$params = null) {
                $stmt = $pdo->prepare(self::substTableAlias($sql));
                if (is_null($params)) {
                        $stmt->execute();
                } else {
                        $stmt->execute($params);
                }
                return ($stmt->fetchAll(PDO::FETCH_ASSOC));
                
	}
        
	public function testDbAccess($host,$dbname,$user,$pass) {
		$dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;
		$password = $pass;
		$pdo = null;
		try {
			$pdo = new PDO($dsn, $user, $password);
			$pdo ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			//
		}
		if ($pdo != null) {
			return true;
		} else {
			return false;
		}
	}
	
	public static function substTableAlias($sql) {
                $cnv = array(
                    "%config%" => TAB_PREFIX . 'config',
                    "%images%" => TAB_PREFIX . 'images',
                    "%prodimages%" => TAB_PREFIX . 'prodimages'
                );
	
		return strtr($sql,$cnv);			
	}
        
        public static function log($txt) {
                error_log($txt);
        }
}