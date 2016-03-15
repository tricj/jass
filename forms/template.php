<?php

abstract class Template {
    var $formHandler;
    function __construct($formHandler){
        $this->formHandler = $formHandler;
    }

    abstract function execute();
}
?>
