<?php

new FormHandler();

class FormHandler{
    var $data = array();
    var $err = array();
    var $forms = array("login", "signup");

    function __construct(){
        if($this->checkURL())
            $this->handleForm();
        print $this->generateOutput();
    }

    private function checkURL(){
        if(isset($_REQUEST['q'])){
            $q = $_REQUEST['q'];
            if(in_array($q, $this->forms)){
                $this->setData("q", $q);
            } else {
                $this->setError("q", "Invalid form selection");
            }
        } else {
            $this->setError("q", "No form selected");
        }

        return $this->errorsExist();
    }

    private function handleForm(){
        // TODO: Handle forms - Ideally as dynamically as possible to avoid large if/switch blocks
    }

    private function generateOutput(){
        if($this->errorsExist()){
            $this->data['success'] = false;
            $this->data['errors'] = $this->err;
        } else {
            $this->data['success'] = true;
        }
        return json_encode($this->data);
    }

    private function setData($name, $value){
        $this->data[$name] = $value;
    }

    private function setError($name, $value){
        $this->err[$name] = $value;
    }

    private function errorsExist(){
        return !empty($this->err);
    }

}
?>
