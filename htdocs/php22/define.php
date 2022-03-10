<?php
define('TAX', 1.05);  // 消費税
define('TAX', 1.08);  // 消費税変更
 
$price = 100;
 
print $price . '円の税込み価格は' . $price * TAX . '円です';
?>