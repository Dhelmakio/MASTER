<?php
$p = 100000;
$i = .166;
$n = 36;

$amort = $p*(($i*(1+$i)^36))/(1+$i)^36-1;
$amo =100000*(14/36);
echo $amort;
?>