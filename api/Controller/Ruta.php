<?php


class Ruta
{

    private $ruta;

    public function __construct()
    {
        
    }

    public function ruta()
    {

       $this->ruta= array(
           'Persona_GET' => 'consultar'  ,
           'Persona_POST' => 'guardar'  ,
           'Persona_DELETE' => 'eliminar'  ,
           'Persona_PUT' => 'actualizar' ,
           'Usuario_GET' => 'consultar'  ,
           'Usuario_GETlogin' => 'login'  ,
           'Usuario_GETconsultarUN' => 'consultarUN',
           'Usuario_POST' => 'guardar'  ,
           'Usuario_DELETE' => 'eliminar'  ,
           'Usuario_PUT' => 'actualizar'  ,
           'Usuario_GETseguridad' => 'seguridad',
           'Usuario_GETperfil' => 'perfil',
           'TipoDocumento_GET' => 'consultar',
           'PersonaUsuario_POST' => 'guardar',
           'PersonaUsuario_GET'=>  'consultar',
           'Persona_GETconsultarUN' => 'consultarUN',
           'Lago_POST'=>'guardar',
           'Lago_PUT'=>'actualizar',
           'Lago_GET'=>'consultar',
           'Lago_DELETE'=>'eliminar',
           'Marca_GET'=>'consultar',
           'Sensor_POST'=>'guardar',
           'Sensor_GET'=>'consultar',
           'Sensor_PUT'=>'actualizar',
           'Sensor_DELETE'=>'eliminar',
           'Especie_GET'=>'consultar',
           'LagoSensor_POST'=>'guardar',
           'LagoSensor_PUT'=>'actualizar',
           'LagoSensor_GET'=>'consultar',
           'LagoSensor_DELETE'=>'eliminar',
           'Sonda_POSTimportar'=>'importar',
           'Dashboard_GETvariable'=>'variable',
           'Dashboard_POST'=>'guardar',
           'Dashboard_GET'=>'consultar',
           'Dashboard_GETconsultarSonda'=>'consultarSonda',
           'Dashboard_DELETE'=>'eliminar',
           'Material_GET'=>'consultar'


        );

       return $this->ruta;
    }


}




?>