<?php

class Base64 
{

    private $variable;
    
    public function __construct($var)
    {
        if(!isset($var))
        {
            die(); 
        }

        $this->variable=$var;
       
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