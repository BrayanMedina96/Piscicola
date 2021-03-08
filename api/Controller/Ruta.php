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
           'Usuario_PUTactualizarAPP' => 'actualizarAPP'  ,
           'Usuario_PUTactualizarPassword' => 'actualizarPassword'  ,
           'Usuario_GETseguridad' => 'seguridad',
           'Usuario_GETperfil' => 'perfil',
           'Usuario_POSTimportar'=>'importar',
           'TipoDocumento_GET' => 'consultar',
           'PersonaUsuario_POST' => 'guardar',
           'PersonaUsuario_GET'=>  'consultar',
           'PersonaUsuario_POSTCrearUsuario'=>  'CrearUsuario',
           'PersonaUsuario_GETconsultarMiUsuario'=>  'consultarMiUsuario',
           'Persona_GETconsultarUN' => 'consultarUN',
           'Persona_POSTimportar'=>'importar', 
           'Lago_POST'=>'guardar',
           'Lago_PUT'=>'actualizar',
           'Lago_GET'=>'consultar',
           'Lago_DELETE'=>'eliminar',
           'Lago_POSTimportar'=>'importar', 
           'Marca_GET'=>'consultar',
           'Marca_POST'=>'guardar',
           'Marca_DELETE'=>'eliminar',
           'Marca_PUT'=>'actualizar',
           'Sensor_POST'=>'guardar',
           'Sensor_POSTimportar'=>'importar', 
           'Sensor_GET'=>'consultar',
           'Sensor_PUT'=>'actualizar',
           'Sensor_DELETE'=>'eliminar',
           'Especie_GET'=>'consultar',
           'LagoSensor_POST'=>'guardar',
           'LagoSensor_PUT'=>'actualizar',
           'LagoSensor_GET'=>'consultar',
           'LagoSensor_DELETE'=>'eliminar',
           'Sonda_POSTimportar'=>'importar',
           'Sonda_POST'=>'guardar',
           'Sonda_PUT'=>'actualizar',
           'Sonda_GET'=>'consultar',
           'Sonda_DELETE'=>'eliminar',
           'Sonda_GETgetParametros'=>'getParametros',
           'Dashboard_GETvariable'=>'variable',
           'Dashboard_POST'=>'guardar',
           'Dashboard_GET'=>'consultar',
           'Dashboard_GETconsultarSonda'=>'consultarSonda',
           'Dashboard_DELETE'=>'eliminar',
           'Material_GET'=>'consultar',
           'Email_GET'=>'consultar',
           'Email_POST'=>'guardar',
           'Seguridad_POST'=>'guardar',
           'Seguridad_POSTgurdarRestriccion'=>'gurdarRestriccion',
           'Seguridad_GET'=>'consultar',
           'Seguridad_GETgetPerfil'=>'getPerfil',
           'Seguridad_GETgetFormulario'=>'getFormulario',
           'Seguridad_GETgetCampo'=>'getCampo',
           'Seguridad_GETgetAccion'=>'getAccion',
           'Seguridad_PUT'=>'actualizar',
           'Seguridad_DELETE'=>'eliminar',
           'TipoLago_POST'=>'guardar',
           'TipoLago_PUT'=>'actualizar',
           'TipoLago_GET'=>'consultar',
           'TipoLago_DELETE'=>'eliminar',
           'Cultivo_POST'=>'guardar',
           'Cultivo_PUT'=>'actualizar',
           'Cultivo_GET'=>'consultar',
           'Cultivo_GETSonda'=>'consultarSonda',
           'Cultivo_DELETE'=>'eliminar',
           'Prediccion_GET'=>'consultar',
           'Rango_GET'=>'consultar',
           'Rango_GETgetRecomendado'=>'getRecomendado',
           'Rango_GETgetRangoSensor'=>'getRangoSensor',
           'Rango_POST'=>'guardar',
           'Rango_POSTrangoSensor'=>'rangoSensor',
           'Rango_PUT'=>'actualizar',
           'Rango_DELETE'=>'eliminar',
           'Rango_DELETEeliminarSondaRango'=>'eliminarSondaRango',
           
        );

       return $this->ruta;
    }


}




?>