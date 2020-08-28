<?php
$speed       = 300000;
$sun_mercury = 579000000;
$sun_earth   = 150000000;
$sun_mars    = 230000000;

$cul_mercury = round((($sun_mercury/$speed)*(1/60)),2);
$cul_earth   = round((($sun_earth/$speed)*(1/60)),2);
$cul_mars    = round((($sun_mars/$speed)*(1/60)),2);


switch ($_POST['planet']){
    case mercury :
        echo "Travel time from Sun to mercury : ".$cul_mercury."&nbsp minutes";
        break;
    case earth :
        echo "Travel time from Sun to earth : ".$cul_earth."&nbsp minutes";
        break;
    case mars :
        echo "Travel time from Sun to mars : ".$cul_mars."&nbsp minutes";
        break;
}
