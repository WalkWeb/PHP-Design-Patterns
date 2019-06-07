<?php

include_once __DIR__ . '/../vendor/autoload.php';

use Patterns\Decorator\Product;
use Patterns\Decorator\PartnerProductDecorator;


$product = new Product(100, 200);
$partnerProduct = new PartnerProductDecorator($product, 10, -20);

var_dump($partnerProduct->getBuyPrice());  // 110
var_dump($partnerProduct->getSellPrice()); // 160
