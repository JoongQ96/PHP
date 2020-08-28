<?php
// p4
error_reporting(E_ALL);
ini_set("display_errors", 1);


class PException extends Exception {
}

class ExceptionTest {
    public function ThrowException() {
        try {
            throw new PException();
        } catch (PException $e) {
            echo "PException <br>";
            throw $e;
        } catch (Exception $e) {
            echo "Exception <br>";
        } finally {
            echo "Finally <br>";
        }
    }
}

$obj = new ExceptionTest();
$obj->ThrowException();




