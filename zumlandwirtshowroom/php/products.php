<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';
require_once __DIR__ . '/prodimage.php';

class Products {
        public static $KIND_FOOD = 0;
        public static $KIND_DRINK = 1;
        
        public static $FORMAT_TABLE = 1;
        public static $FORMAT_CARDS = 0;
        
        private static $templateFolder = __DIR__ . "/../templates/";
        
        public function getProds(int $kind) : string {
                $pdo = DbUtils::openDbAndReturnPdoStatic();
                $format = intval(DbUtils::getConfigValue($pdo, 'sroomprodview', '0'));
                
                if ($format == self::$FORMAT_CARDS) {
                        return $this->getProdsAsCards($pdo,$kind);
                } else {
                        return $this->getProdsAsList($pdo,$kind);
                }
        }
        
        private function getProdsDueToTemplate($pdo,int $kind,string $template,string $startStr,string $endStr):string {
                $decpoint = DbUtils::getConfigValue($pdo, 'decpoint', '.');
                $currency = DbUtils::getConfigValue($pdo, 'currency', '');
                $html = $startStr;
                $prods = json_decode(DbUtils::getConfigValue($pdo, 'products', ''),true);
                foreach($prods as $aProd) {
                        if (intval($aProd['kind']) == $kind) {
                                $html .= $this->fillPlaceholder($template, $aProd, $currency, $decpoint);
                        }
                }
                $html .= $endStr;
                return $html;
        }
        
        private function getProdsAsCards($pdo,int $kind):string {
                $template = file_get_contents(self::$templateFolder . "prodcard.txt");
                return $this->getProdsDueToTemplate($pdo,$kind, $template, '', '');
        }
        
        private function getProdsAsList($pdo,int $kind):string {
                $template = file_get_contents(self::$templateFolder . "prodlistentry.txt");
                $begin = '<table class="prodtable">';
                $begin .= "<tr><th>Artikel<th>Preis (ab)</tr>";
                return $this->getProdsDueToTemplate($pdo,$kind, $template, $begin, '</table>');
        }
        
        private static function fillPlaceholder(string $template,array $aProd,string $currency,string $decpoint): string {
                $entry = str_replace('{PRODUCTIMG}', '<img src="php/prodimage.php?id=' . $aProd['id'] . '" alt="Produktbild" />', $template);
                $entry = str_replace('{PRODUCTNAME}', $aProd['longname'], $entry);
                $entry = str_replace('{PRODUCTDESCRIPTION}', $aProd['description'], $entry);
                $entry = str_replace('{PRODUCTPRICE}', str_replace('.', $decpoint, $aProd['price']) . " $currency", $entry);
                return $entry;
        }
}
