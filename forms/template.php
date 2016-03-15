<?php

abstract class Template {
    var $formHandler;
    function __construct($formHandler){
        $this->formHandler = $formHandler;
    }

    protected function setError($name, $value){
        $this->formHandler->setError($name, $value);
    }

    protected function setData($name, $value){
        $this->formHandler->setData($name, $value);
    }

    abstract function execute();
}
?>
