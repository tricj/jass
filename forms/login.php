<?php
require "template.php";

class Form extends Template {
    function execute(){
        // Handle the login form here

        $this->setError("an error", "something wasnt set");
        $this->setData("some data", "42");
    }
}
?>
