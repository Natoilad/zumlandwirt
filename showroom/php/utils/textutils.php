<?php

// In PHP 8 not necessary anymore, but m,any users are still on PHP 7.x
function doesStartsWith(string $text,string $needle ):bool {
     $length = strlen( $needle );
     return substr( $text, 0, $length ) === $needle;
}

function insertImages(string $text):string {
        $out = array();
        $lines = explode("\n", $text);
        foreach ($lines as $aLine) {
                $trimmedLined = trim($aLine);
                if (doesStartsWith($trimmedLined, "BILD:")) {
                        $imgInfo = substr($trimmedLined, strlen("BILD:"));
                        $imgInfoParts = explode(";", $imgInfo);
                        $imgFileName = trim($imgInfoParts[0]);
                        $classTxt = "";
                        if (count($imgInfoParts) > 1) {
                                $imgClass = trim($imgInfoParts[1]);
                                $classTxt = " class='$imgClass' ";
                        }
                        $out[] = "<img src='bilder/$imgFileName' $classTxt />";
                } else {
                        $out[] = $aLine;
                }
        }
        return implode("\n",$out);
}