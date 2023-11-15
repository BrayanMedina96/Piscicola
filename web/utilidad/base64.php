<?php

class Base64 
{

    private $variable;
    
    public function __construct()
    {
        if(!isset($_GET["MC"]))
        {
            header('Location:../view/login.php');
            die(); 
        }

        $this->variable=$_GET["MC"];
       
    }

    public function getVar()
    {
        return $this->variable;
    }

    public function decodeUsuario()
    {

        $v=(array) json_decode(base64_decode( $this->variable ));
        return $v;

    }



}



?>