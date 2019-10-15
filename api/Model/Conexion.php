<?php

include ("Config/Config.php");

class Conexion 
{

    private static $instance;
    private $servidor;
    private $port;
    private $user;
    private $dbname;
    private $password;


    public function __construct()
    {
        $this->servidor=SERVER;
        $this->port=PORT;
        $this->user=USER;
        $this->dbname=DATABASE;
        $this->password=PASSWORD;
    }
    

    public function cnn()
    {

       try
       {
          $stringCnn="pgsql:dbname=$this->dbname;host=$this->servidor";
          $conexion =new PDO($stringCnn,$this->user, $this->password);
       
       }
       catch(PDOException $e)
       {
          print "Error:" . $e->getMessage() . "<br/>";
          die();
       }
        
        return $conexion;
          
    }

    public static function getInstance()
    {
        if (!self::$instance instanceof self) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function cerrar($conexion)
    {
        $conexion=null;
    }
    

}


?>