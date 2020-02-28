<html>

<head>
    <title>Sonda</title>
    <input id="lblTitulo" type="hidden" value="sonda">
    <meta charset="utf-8">

    <?php 
          require("../plantilla/menu.php");
     ?>

    <script type="text/javascript" src="../Scripts/DataTable/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../Scripts/DataTable/datatables.min.css" />
    <script src="../Scripts/datepicker.min.js" type="text/javascript"></script>
    <link href="../Content/datepicker.min.css" rel="stylesheet" type="text/css" />

    <script src="../scripts/Aplicacion/jsAjax.js"></script>
    <script src='../scripts/Aplicacion/jsUtilidad.js'></script>

    <script src='../scripts/Aplicacion/jsClassCultivo.js'></script>
    <script src='../scripts/Aplicacion/jsClassSonda.js'></script>
    <script src='../scripts/Aplicacion/jsSonda.js'></script>

    <style>
        .only-timepicker .datepicker--nav,
        .only-timepicker .datepicker--content {
            display: none;
        }

        .only-timepicker .datepicker--time {
            border-top: none;
        }
    </style>


</head>

<body class="bg-light">

    <hr>
    <div class="py-5 container">
        <div class="row">

            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h5>Sonda</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="ddlCultivo">Cultivo</label>
                            <select id="ddlCultivo" class="form-control"></select>
                        </div>

                        <div class="form-row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="txtFecha">Fecha</label>
                                    <input type="text" data-range="true" data-language='en' data-multiple-dates="2"
                                        data-multiple-dates-separator=" - " class="form-control" id="txtFecha"
                                        required="">
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group">
                                    <label for="txtHora">Hora</label>
                                    <input type="text" class="form-control" id="txtHora" required="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="txtTempAmbiente">Temperatura ambiente</label>
                            <input type="number" class="form-control limpiar" id="txtTempAmbiente" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtTempEstanque">Temperatura estanque</label>
                            <input type="number" class="form-control limpiar" id="txtTempEstanque" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtOxigeno">Oxigeno disuelto</label>
                            <input type="number" class="form-control limpiar" id="txtOxigeno" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtPh">PH</label>
                            <input type="number" class="form-control limpiar" id="txtPh" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtCondElectrica">Conductividad Electrica</label>
                            <input type="number" class="form-control limpiar" id="txtCondElectrica" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtAmonioNH3">Amonio NH3</label>
                            <input type="number" class="form-control limpiar" id="txtAmonioNH3" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtAmonioNH4">Amonio NH4</label>
                            <input type="number" class="form-control limpiar" id="txtAmonioNH4" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtNitrito">Nitrito</label>
                            <input type="number" class="form-control limpiar" id="txtNitrito" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtAlcalinidad">Alcalinidad</label>
                            <input type="number" class="form-control limpiar" id="txtAlcalinidad" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtPecesMuertos">Peces muertos</label>
                            <input type="number" class="form-control limpiar" id="txtPecesMuertos" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtObservacion">Observación</label>
                            <textarea charset="UTF-8" type="text" class="form-control limpiar" id="txtObservacion"
                                rows="3" required=""></textarea>
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
                    <div class="card">
                        <div class="card-header">Información</div>
                        <div class="card-body">
                            <li> Puede utilizar los campos cultivo, fecha y hora para aplicar un filtro al momento de
                                consultar los registros. </li>
                            <li> Puede utilizar el campo de fecha para realizar filtro entre rangos.</li>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>


    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" style="max-width:1600px" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Sonda</h5>
                    <button id="btnCerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input class="form-control" id="myInput" type="text" placeholder="Buscar en la tabla:">
                    <table id="Tabla" class="table table-bordered table-striped" style="display:none;">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Cultivo</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>T. Ambiente</th>
                                <th>T. estanque</th>
                                <th>Oxigeno</th>
                                <th>PH</th>
                                <th>C. Electrica</th>
                                <th>NH3</th>
                                <th>NH4</th>
                                <th>Nitrito</th>
                                <th>Alcalinidad</th>
                                <th>Peces muertos</th>
                                <th>Observación</th>
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
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <input type="text" id="txtID" value="" hidden />
</body>
<?php 
require("../plantilla/pie.php");
?>

</html>