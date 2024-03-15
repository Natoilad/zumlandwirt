<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/imager.php';
require_once __DIR__ . '/utils/dbutils.php';

class ProdImage extends Imager {
        public function getProdImage(int $prodid) {
                $pdo = DbUtils::openDbAndReturnPdoStatic();
                
                $sql = "SELECT image from %prodimages% WHERE prodid=?";
                $r = DbUtils::fetchSqlAll($pdo, $sql, array($prodid));
                if ((count($r) == 0) || is_null($r[0]['image']) || ($r[0]['image'] == '-')) {
                        self::outputEmptyImage();
                } else {
                        $this->outputImage($r[0]['image']);
                }
        }
}

if (isset($_GET['id'])) {
        $prodid = intval($_GET['id']);
        (new ProdImage())->getProdImage($prodid);
}