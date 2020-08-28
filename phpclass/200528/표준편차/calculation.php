<?php

$var1 = $_POST['1'];
$var2 = $_POST['2'];
$var3 = $_POST['3'];
$var4 = $_POST['4'];
$var5 = $_POST['5'];


$sum = $var1+$var2+$var3+$var4+$var5;
$avg = $sum/5;
$po = pow(10,2);


$variance = (pow(($var1-$avg),2)+pow(($var2-$avg),2)+pow(($var3-$avg),2)
    +pow(($var4-$avg),2)+pow(($var5-$avg),2))/4;

$standard = sqrt($variance);

echo "입력 값 : ".$var1."&nbsp".$var2."&nbsp".$var3."&nbsp".$var4."&nbsp".$var5."<br>";
echo "평균 : ".$avg."<br>";
echo "분산 : ".$variance."<br>" ;
echo "표준편차 : ".round($standard,2)."<br>" ;
