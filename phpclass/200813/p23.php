<?php
$my_item_array = array("samsung","nc","doosan","lg");

$mode = current($my_item_array);    echo "{$mode}<br>";
$mode = key($my_item_array);        echo "{$mode}<br>";
$mode = next($my_item_array); echo "{$mode}<br>";
$mode = next($my_item_array); echo "{$mode}<br>";
$mode = next($my_item_array); echo "{$mode}<br>";
$mode = prev($my_item_array); echo "{$mode}<br>";

next($my_item_array); // move from "doosan" to "lg"

if (($mode = next($my_item_array)) === false)
    echo "true. end of the array<br>";
else
    echo "false<br>";

$mode = reset($my_item_array);  echo "{$mode}<br>";
$mode = key($my_item_array);          echo "{$mode}<br>";
$mode = end($my_item_array);    echo "{$mode}<br>";
$mode = key($my_item_array);          echo "{$mode}<br>";







