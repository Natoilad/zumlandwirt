<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';

class Workloadimg {
        
        public static int $SIZE_W = 600;
        public static int $SIZE_H = 200;
        public static int $BORDER_MIN = 50;
        
        public function outputImg() {
                $pdo = DbUtils::openDbAndReturnPdoStatic();
                $workload = DbUtils::getConfigValue($pdo, 'workload', 0);
                                
                header("Content-Type: image/png");
                
                $my_img = @imagecreatefrompng(__DIR__ . "/../img/workload.png");
                
                if(!$my_img)
                {
                    /* Erzeuge ein schwarzes Bild */
                    $im  = imagecreatetruecolor(150, 30);
                    $bgc = imagecolorallocate($im, 255, 255, 255);
                    $tc  = imagecolorallocate($im, 0, 0, 0);

                    imagefilledrectangle($im, 0, 0, 150, 30, $bgc);

                    // error message
                    imagestring($my_img, 1, 5, 5, 'Fehler beim Laden des Bilder',$tc);
                }
                

		$black = imagecolorallocate($my_img, 0, 0, 0);

                // Let's use white for the image
                $col_ellipse = imagecolorallocate($my_img, 255, 255,255);

                $xpos = round(self::$SIZE_W / 100.0 * $workload);
                if ($xpos < self::$BORDER_MIN) {
                        $xpos = self::$BORDER_MIN;
                } else if ($xpos > (self::$SIZE_W - self::$BORDER_MIN)) {
                        $xpos = self::$SIZE_W - self::$BORDER_MIN;
                }
                
                // Draw the circle.
                imageellipse($my_img, $xpos, self::$SIZE_H / 2 + 30, 45, 45, $col_ellipse);
                imageellipse($my_img, $xpos, self::$SIZE_H / 2 + 30, 46, 46, $col_ellipse);
                imageellipse($my_img, $xpos, self::$SIZE_H / 2 + 30, 47, 47, $col_ellipse);
                imageellipse($my_img, $xpos, self::$SIZE_H / 2 + 30, 48, 48, $col_ellipse);
                imageellipse($my_img, $xpos, self::$SIZE_H / 2 + 30, 49, 49, $col_ellipse);
                imageellipse($my_img, $xpos, self::$SIZE_H / 2 + 30, 50, 50, $col_ellipse);
                imagesetthickness($my_img,10);
                imageline($my_img, 0, self::$SIZE_H / 2 + 30, self::$SIZE_W, self::$SIZE_H / 2 + 30, $col_ellipse);
                imagesetthickness($my_img,1);
                
		imagepng( $my_img );
		imagecolordeallocate( $my_img, $black );
                imagecolordeallocate( $my_img, $col_ellipse );
		imagedestroy( $my_img );
        }
}

echo (new Workloadimg())->outputImg();
