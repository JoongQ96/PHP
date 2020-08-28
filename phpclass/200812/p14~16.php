<?php
interface Red {
    public function printRed();
}
interface Green {
    public function printGreen();
}
interface Blue {
    public function printBlue();
}
interface Color extends Red, Green, Blue{
    public function printColor();
}
interface Black {
    public function printBlack();
}
class Printer implements Color, Black {
    public function printRed(){
        echo "빨간색 출력!!<br>";
    }
    public function printGreen(){
        echo "녹색 출력!!<br>";
    }
    public function printBlue(){
        echo "파랑색 출력!!<br>";
    }
    public function printColor(){
        echo "<br>--컬러모드 출력--<br>";
        $this->printRed();
        $this->printGreen();
        $this->printBlue();
    }
    public function printBlack(){
        echo "<br>--흑백모드 출력--<br>";
        echo "검정색 출력!!!";
    }
}

$InkJetColorPrinter = new Printer();
$InkJetColorPrinter->printColor();
$InkJetColorPrinter->printBlack();




