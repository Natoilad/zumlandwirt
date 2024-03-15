<?php

class Imager {
        protected function outputImage(string $imgDataInBase64) {
		header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		header("Pragma: no-cache");
		header("Expires: Mon, 20 Dec 1998 01:00:00 GMT" );
		header('Content-Type: ' . image_type_to_mime_type(IMAGETYPE_PNG));

                $img = base64_decode($imgDataInBase64);
                $php_img = imagecreatefromstring($img);

                imagesavealpha($php_img, true);
                $color = imagecolorallocatealpha($php_img, 0, 0, 0, 127);

                imagepng($php_img, NULL);
                imagecolordeallocate( $php_img,$color );
                imagedestroy($php_img);		
	}
        
        protected function outputEmptyImage() {
		$my_img = imagecreate( 1,1 );
		$background = imagecolorallocate( $my_img, 0, 0, 255 );
		imagecolortransparent($my_img, $background);
		header( "Content-type: image/png" );
		imagepng( $my_img );
		imagecolordeallocate( $my_img,$background );
		imagedestroy( $my_img );
	}
}
