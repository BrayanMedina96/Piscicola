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
           'Persona_GETconsultarUN' => 'consultarUN'      
        );

       return $this->ruta;
    }


}




?>