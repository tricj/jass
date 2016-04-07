<?php

new FormHandler();

class FormHandler{
    var $data = array();
    var $err = array();
    var $forms = array("login", "signup");
    var $form;

    function __construct(){
        if($this->checkURL()){
            $this->handleForm();
        }
        print $this->generateOutput();
    }

    private function checkURL(){
        if(isset($_REQUEST['q'])){
            $this->form = $_REQUEST['q'];
            if(in_array($this->form, $this->forms)){
                $this->setData("q", $this->form);
            } else {
                $this->setError("q", "Invalid form selection");
            }
        } else {
            $this->setError("q", "No form selected");
        }

        return !$this->errorsExist();
    }

    private function handleForm(){
        // TODO: Handle forms - Ideally as dynamically as possible to avoid large if/switch blocks
        include "forms/" . $this->form . ".php"; // Include form
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
