<?php
// p6
error_reporting(E_ALL);
ini_set("display_errors", 1);

class myCustomException extends Exception {}

function doStuff() {
    try {
        throw new InvalidArgumentException("You are doing it wrong!", 112);
    } catch (Exception $e) {
        throw new MyCustomException("Something happened!", 911, $e);
    }
}

try {
    doStuff();
} catch (Exception $e) {
    do {
        printf("%s:%d %s (%d) [%s]<br>", $e->getFile(), $e->getLine(),
        $e->getMessage(), $e->getCode(), get_class($e));
    } while($e = $e->getPrevious());
}


