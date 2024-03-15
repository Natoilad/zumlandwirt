<?php

require_once 'php/utils/dbutils.php';
require_once 'php/config.php';

class Sync {
        public static function testAccess($data) {
                return self::checkAccessCode($data);
        }
        
        // REM* check for guestcode
        private static function checkAccessCode($data) {
                if (!isset($data["sroomcode"])) {
                        DbUtils::log("No access code transmitted");
                        return array("status" => "ERROR", "msg" => "No Access code transmitted!");
                }

                $transmittedSroomCode = $data["sroomcode"];
                if ($transmittedSroomCode != CODE) {
                        DbUtils::log("Wrong Access code");
                        return array("status" => "ERROR", "msg" => "Wrong Access code!");
                }
                return array("status" => "OK","msg" => "Zugriff möglich");
        }

        public static function updateworkload($pdo,$data) {
                try {
                        $accessCheck = self::checkAccessCode($data);
                        if ($accessCheck["status"] != "OK") {
                                return $accessCheck;
                        }
                        self::insertIntoConfigTable($pdo, $data, 'workload');
                        return array("status" => "OK");
                } catch (Exception $ex) {
                        return array("status" => "ERROR","msg" => $ex->getMessage());
                }
        }
        public static function insertData($pdo,$data) {
		try {
			DbUtils::log("insertData into config table of showroom");
                        
                        $accessCheck = self::checkAccessCode($data);
                        if ($accessCheck["status"] != "OK") {
                                return $accessCheck;
                        }

                        self::insertIntoConfigTable($pdo, $data, 'decpoint');
                        self::insertIntoConfigTable($pdo, $data, 'currency');
                        
			self::insertIntoConfigTable($pdo, $data, 'sroomimpressum');
			self::insertIntoConfigTable($pdo, $data, 'sroomcss');
                        self::insertIntoConfigTable($pdo, $data, 'sroomprivacy');
                        self::insertIntoConfigTable($pdo, $data, 'sroomtitle');
                        self::insertIntoConfigTable($pdo, $data, 'sroomabout');
                        self::insertIntoConfigTable($pdo, $data, 'sroomnews');
                        self::insertIntoConfigTable($pdo, $data, 'sroomfood');
                        self::insertIntoConfigTable($pdo, $data, 'sroomdrinks');
                        self::insertIntoConfigTable($pdo, $data, 'sroomutilization');
                        self::insertIntoConfigTable($pdo, $data, 'types');
                        self::insertIntoConfigTable($pdo, $data, 'products');
                        self::insertIntoConfigTable($pdo, $data, 'sroomprodview');
                        self::insertIntoConfigTable($pdo, $data, 'coreversion');
                        self::insertIntoConfigTable($pdo, $data, 'workload');
                        self::insertIntoConfigTable($pdo, $data, 'sroomshowworkload');
                        
                        self::insertProdImages($pdo, $data,'prodimages');
                        self::insertTitleImg($pdo, $data,'titleimg');

			return array("status" => "OK");
		} catch (Exception $ex) {
			return array("status" => "ERROR","msg" => $ex->getMessage());
		}
	}
        
        private static function insertIntoConfigTable($pdo,$data,$item) {
                if (isset($data[$item])) {
                        if (isset($data[$item])) {
                                DbUtils::setConfigValue($pdo, $item, $data[$item]);
                        }
                }
        }
        
        private static function insertProdImages($pdo,$data,string $item) {
                if (isset($data[$item])) {
                        $prodimages = $data[$item];
                        DbUtils::execSql($pdo, 'DELETE FROM %prodimages%', null);
                        DbUtils::execSql($pdo, 'OPTIMIZE TABLE %prodimages%',null);
                        $sql = "INSERT INTO %prodimages% (prodid,image) VALUES(?,?)";
                        foreach($prodimages as $aProdImg) {
                                DbUtils::execSql($pdo, $sql, array($aProdImg['prodid'],$aProdImg['imagedata']));
                        }
                }
        }
        
        private static function insertTitleImg($pdo,$data,string $item) {
                if (isset($data[$item])) {
                        $titleimg = $data[$item];
                        $tag = "TITLE";
                        DbUtils::execSql($pdo, 'DELETE FROM %images% WHERE tag=?', array($tag));
                        DbUtils::execSql($pdo, 'OPTIMIZE TABLE %images%',null);
                        if (!is_null($titleimg) && ($titleimg !='-')) {
                                $sql = "INSERT INTO %images% (tag,image) VALUES(?,?)";
                                DbUtils::execSql($pdo, $sql, array($tag,$titleimg));
                        }
                }
        }
}
	
if (isset($_POST["data"])) {
	$pdo = DbUtils::openDbAndReturnPdoStatic();

	$data = $_POST["data"];

	$utfdata = base64_decode($data);
	$objFormat = json_decode($utfdata, true);
        
        if (isset($objFormat['test'])) {
                $ret = Sync::testAccess($objFormat);
        } else if (isset($objFormat['updateworkload'])) {
                $ret = Sync::updateworkload($pdo,$objFormat);
        } else {
                $ret = Sync::insertData($pdo,$objFormat);
        }

        echo json_encode($ret);
} else {
        echo json_encode(array("status" => "ERROR","msg" => "No data transmitted!"));
}