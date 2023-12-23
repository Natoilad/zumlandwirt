<?php

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/utils/dbutils.php';
require_once __DIR__ . '/products.php';

$products = new Products();
echo $products->getProds(Products::$KIND_FOOD);
