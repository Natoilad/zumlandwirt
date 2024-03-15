<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/imager.php';
require_once __DIR__ . '/utils/dbutils.php';

class TitleImage extends Imager {
        public function getTitleImage() {
                $pdo = DbUtils::openDbAndReturnPdoStatic();
                
                $sql = "SELECT image from %images% WHERE tag=?";
                $r = DbUtils::fetchSqlAll($pdo, $sql, array('TITLE'));
                if ((count($r) == 0) || is_null($r[0]['image']) || ($r[0]['image'] == '-')) {
                        self::outputEmptyImage();
                } else {
                        $this->outputImage($r[0]['image']);
                }
        }
}

(new TitleImage())->getTitleImage();
