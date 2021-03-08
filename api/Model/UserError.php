<?php

class UserError
{
    private static $instance;

    private $error_code=array(
                               "23505"=>"23505",
                               "23503"=>"23503"
                             );

    private $error=array(
                        "23505"=>"Ya existe un registro con estas características.",
                        "23503"=>"Está siendo usado en otro registro o tabla."
                               );

    public function getError($code, $message) {

        
        if( array_search($code,$this->error_code,true) )
        {
                $result=$this->error[ array_search($code,$this->error_code,true) ] ;

        }else{

                $result=$code."-".$message;
        }

        
        return $result;
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

}


?>