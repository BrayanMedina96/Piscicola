<html>

<head>
    <title>Rangos</title>
    <input id="lblTitulo" type="hidden" value="sonda">
    <meta charset="utf-8">

    <?php 
          require("../plantilla/menu.php");
     ?>

    <script type="text/javascript" src="../Scripts/DataTable/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../Scripts/DataTable/datatables.min.css" />


    <script src="../scripts/Aplicacion/jsAjax.js"></script>
    <script src='../scripts/Aplicacion/jsUtilidad.js'></script>

    <script src='../scripts/Aplicacion/class/jsClassSensor.js'></script>
    <script src='../scripts/Aplicacion/class/jsClassRango.js'></script>
    <script src='../scripts/Aplicacion/jsRango.js'></script>


</head>

<body class="bg-light">

    <hr>
    <div class="py-5 container">
        <div class="row">

            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h5>Rangos fisico-quimicos</h5>
                    </div>
                    <div class="card-body">

                        <div class="mb-3">
                            <label for="txtDescripcion">Descripción</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"></span>
                                </div>
                                <input type="text" class="form-control text" id="txtDescripcion" required="">

                            </div>
                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="txtTempAmbienteMin">Temperatura ambiente mínima</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">

                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" onchange="estado(this,'txtTempAmbiente')"
                                                    class="custom-control-input" checked="" id="swTemperaturaAmbiente">
                                                <label class="custom-control-label" for="swTemperaturaAmbiente"></label>
                                            </div>
                                        </span>

                                    </div>
                                    <input type="number" class="form-control limpiar number required"
                                        id="txtTempAmbienteMin">

                                </div>
                            </div>


                            <div class="col-md-6 mb-3 apellido">
                                <label for="txtTempAmbienteMax">Temperatura ambiente máxima</label>
                                <input type="number" class="form-control limpiar number required"
                                    id="txtTempAmbienteMax">

                            </div>

                        </div>

                        <div class="row">


                            <div class="col-md-6 mb-3">
                                <label for="txtTempEstanqueMin">Temperatura estanque mínima</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    onchange="estado(this,'txtTempEstanque')" checked=""
                                                    id="swTemperaturaEstanque">
                                                <label class="custom-control-label" for="swTemperaturaEstanque"></label>
                                            </div>
                                        </span>

                                    </div>
                                    <input type="number" class="form-control limpiar number required"
                                        id="txtTempEstanqueMin">

                                </div>
                            </div>


                            <div class="col-md-6 mb-3 apellido">
                                <label for="txtTempEstanqueMax">Temperatura estanque máxima</label>
                                <input type="number" class="form-control limpiar number required"
                                    id="txtTempEstanqueMax">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="txtOxigenoMin">Oxigeno disuelto mínima</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    onchange="estado(this,'txtOxigeno')" checked="" id="swOxigeno">
                                                <label class="custom-control-label" for="swOxigeno"></label>
                                            </div>
                                        </span>

                                    </div>
                                    <input type="number" class="form-control limpiar number required"
                                        id="txtOxigenoMin">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 apellido">
                                <label for="txtOxigenoMax">Oxigeno disuelto máxima</label>
                                <input type="number" class="form-control limpiar number required" id="txtOxigenoMax">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="txtPhMin">PH mínima</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    onchange="estado(this,'txtPh')" checked="" id="swPH">
                                                <label class="custom-control-label" for="swPH"></label>
                                            </div>
                                        </span>

                                    </div>
                                    <input type="number" class="form-control limpiar number required" id="txtPhMin">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 apellido">
                                <label for="txtPhMax">PH máxima</label>
                                <input type="number" class="form-control limpiar number required" id="txtPhMax">
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="txtConductividadMin">Conductividad Electrica mínima</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    onchange="estado(this,'txtConductividad')" checked=""
                                                    id="swConductividad">
                                                <label class="custom-control-label" for="swConductividad"></label>
                                            </div>
                                        </span>

                                    </div>
                                    <input type="number" class="form-control limpiar number required"
                                        id="txtConductividadMin">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 apellido">
                                <label for="txtConductividadMax">Conductividad Electrica máxima</label>
                                <input type="number" class="form-control limpiar number required"
                                    id="txtConductividadMax">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="txtNH3Min">Amonio NH3 mínima</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    onchange="estado(this,'txtNH3')" checked="" id="swNH3">
                                                <label class="custom-control-label" for="swNH3"></label>
                                            </div>
                                        </span>

                                    </div>
                                    <input type="number" class="form-control limpiar number required" id="txtNH3Min">
                                </div>
                            </div>


                            <div class="col-md-6 mb-3 apellido">
                                <label for="txtNH3Max">Amonio NH3 máxima</label>
                                <input type="number" class="form-control limpiar number required" id="txtNH3Max">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="txtNH4Min">Amonio NH4 mínima</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    onchange="estado(this,'txtNH4')" checked="" id="swNH4">
                                                <label class="custom-control-label" for="swNH4"></label>
                                            </div>
                                        </span>

                                    </div>
                                    <input type="number" class="form-control limpiar number required" id="txtNH4Min">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 apellido">
                                <label for="txtNH4Max">Amonio NH4 máxima</label>
                                <input type="number" class="form-control limpiar number required" id="txtNH4Max">
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-6 mb-3">
                                <label for="txtNitritoMin">Nitrito mínima</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    onchange="estado(this,'txtNitrito')" checked="" id="swNitrito">
                                                <label class="custom-control-label" for="swNitrito"></label>
                                            </div>
                                        </span>

                                    </div>
                                    <input type="number" class="form-control limpiar number required"
                                        id="txtNitritoMin">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 apellido">
                                <label for="txtNitritoMax">Nitrito máxima</label>
                                <input type="number" class="form-control limpiar number required" id="txtNitritoMax">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="txtAlcalinidadMin">Alcalinidad mínima</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input"
                                                    onchange="estado(this,'txtAlcalinidad')" checked=""
                                                    id="swAlcalinidad">
                                                <label class="custom-control-label" for="swAlcalinidad"></label>
                                            </div>
                                        </span>

                                    </div>
                                    <input type="number" class="form-control limpiar number required"
                                        id="txtAlcalinidadMin">
                                </div>
                            </div>

                            <div class="col-md-6 mb-3 apellido">
                                <label for="txtAlcalinidadMax">Alcalinidad máxima</label>
                                <input type="number" class="form-control limpiar number required"
                                    id="txtAlcalinidadMax">
                            </div>
                        </div>


                        <div class="form-group">
                            <button id="btnEnviar" class="btn btn-primary" type="button">Guardar</button>
                            <button id="btnLimpiar" class="btn btn-secondary" type="button">Limpiar</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">
                    <div class="list-group">
                        <a id="btnConfiguracion" class="list-group-item list-group-item-action">
                            <img width="18px" src="../svg/si-glyph-pencil.svg" /> Mis registros
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <div class="list-group">
                        <a id="btnRecomendado" class="list-group-item list-group-item-action">
                            <img width="18px" src="../svg/si-glyph-circle-load-left.svg" /> Rangos recomendados
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <div class="list-group">
                        <a id="btnSonda" class="list-group-item list-group-item-action">
                            <img width="18px" src="../svg/sensor.png" /> Sonda
                        </a>
                    </div>
                </div>

                <div class="form-group">
                    <div class="card">
                        <div class="card-header">Información</div>
                        <div class="card-body">
                            <li> Realice la parametrización de las variables físico químicas del estanque definiendo los
                                valores mínimos y máximos para cada una.</li>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="modal" id="modal" tabindex="-1"  style="overflow-y: scroll;" role="dialog">
        <div class="modal-dialog" style="max-width:1600px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rangos fisico-quimicos</h5>
                    <button id="btnCerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input class="form-control" id="myInput" type="" placeholder="Buscar en la tabla:">
                    <div class="table-responsive">
                        <table id="Tabla" class="table table-bordered table-striped" style="display:none;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th colspan="2" class="text-center">Temperatura ambiente</th>

                                    <th colspan="2" class="text-center">Temperatura estanque</th>

                                    <th colspan="2" class="text-center">Oxigeno disuelto</th>

                                    <th colspan="2" class="text-center">PH</th>

                                    <th colspan="2" class="text-center">C. Electrica</th>

                                    <th colspan="2" class="text-center">NH3</th>

                                    <th colspan="2" class="text-center">NH4</th>

                                    <th colspan="2" class="text-center">Nitrito</th>

                                    <th colspan="2" class="text-center">Alcalinidad</th>

                                    <th></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Descripción</th>
                                    <!--T. ambiente-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--T. estanque-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--Oxigeno disuelto-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--PH-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--C. Electrica-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--NH3-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--NH4-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--Nitrito-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--Alcalinidad-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tdResultado"></tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>


    <div class="modal" id="modalSonda" tabindex="-1" style="overflow-y: scroll;" role="dialog">
        <div class="modal-dialog" style="max-width:1000px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sonda</h5>
                    <button id="btnCerrarModalSonda" type="button" class="close" data-dismiss="modalSonda"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="ddlSonda">Sonda</label>
                        <select id="ddlSonda" class="form-control" required="">
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="ddlRango">Rango</label>
                        <select id="ddlRango" class="form-control" required="">
                        </select>
                    </div>

                    <div class="form-group">

                        <button id="btnEnviarSondaRago" class="btn btn-primary" type="button">Guardar</button>

                    </div>

                   

                    <input class="form-control" id="myInputSonda" type="" placeholder="Buscar en la tabla:">
                    <div class="table-responsive">
                        <table id="TablaSonda" class="table table-bordered table-striped" style="display:none;">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th colspan="2" class="text-center">Temperatura ambiente</th>

                                    <th colspan="2" class="text-center">Temperatura estanque</th>

                                    <th colspan="2" class="text-center">Oxigeno disuelto</th>

                                    <th colspan="2" class="text-center">PH</th>

                                    <th colspan="2" class="text-center">C. Electrica</th>

                                    <th colspan="2" class="text-center">NH3</th>

                                    <th colspan="2" class="text-center">NH4</th>

                                    <th colspan="2" class="text-center">Nitrito</th>

                                    <th colspan="2" class="text-center">Alcalinidad</th>

                                    <th></th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th>Sonda</th>
                                    <th>Rango</th>
                                    <!--T. ambiente-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--T. estanque-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--Oxigeno disuelto-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--PH-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--C. Electrica-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--NH3-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--NH4-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--Nitrito-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <!--Alcalinidad-->
                                    <th>Mínima</th>
                                    <th>Máxima</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="tdResultado"></tbody>
                            <tfoot>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="txtID" value="" hidden />
    <span id="pnMensaje"></span>
</body>
<?php 
require("../plantilla/pie.php");
?>

</html>