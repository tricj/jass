<?php

new FormHandler();

/**
 *
 * Entry point for form handling API
 *
 */
class FormHandler {
    var $data = array();
    var $err = array();
    var $forms = array("login" => "login.php",
                       "signup" => "signup.php");
    var $formClassPath;

    function __construct(){
        if($this->checkURL()){
            $this->handleForm();
        }
        print $this->generateOutput();
    }

    private function checkURL(){
        if(isset($_REQUEST['q'])){
            $q = $_REQUEST['q'];
            if(in_array($q, array_keys($this->forms))){
                $this->setData("q", $q);
                $this->formClassPath = $this->forms[$q];
            } else {
                $this->setError("q", "Invalid form selection");
            }
        } else {
            $this->setError("q", "No form selected");
        }

        return !$this->errorsExist();
    }

    /**
     * Imports the associated class and proceeds with execution
     */
    private function handleForm(){
        // TODO: Error handling - invalid paths / class not existing
        include "forms/" . $this->formClassPath;
        $f = new Form($this);
        $f->execute();
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

    public function setData($name, $value){
        $this->data[$name] = $value;
    }

    public function setError($name, $value){
        $this->err[$name] = $value;
    }

    public function errorsExist(){
        return !empty($this->err);
    }

}
?>
