<html>

<head>
    <title>Importar</title>
    <meta charset="UTF-8">

    <?php 
         require("../plantilla/menu.php");
     ?>

    <script src="../scripts/Aplicacion/jsAjax.js"></script>
    <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
    <script src='../scripts/Aplicacion/jsClassSonda.js'></script>
    <script src='../scripts/Aplicacion/jsImportar.js'></script>
    

    <style>
        #tdResultado tr {
            cursor: pointer;
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
                        <h5>Importar</h5> <label id="lblImportar"></label>
                    </div>
                    <div class="card-body">
                    <div class="table-responsive">
                        <div class="form-group">
                            <table class="table table-bordered" id="tabla"></table>
                        </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcionLago"></label>
                            <textarea charset="UTF-8" type="text" class="form-control limpiar" id="txtImportar" rows="10"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <button id="btnEnviar" class="btn btn-primary" type="button">Enviar</button>
                            <!--<button id="btnLimpiar" class="btn btn-secondary" type="button">Limpiar</button>-->
                            <a  id="btnPlantilla" type="button" class="btn btn-default">
                                 <img src="../svg/documento.png" width="30px">
                                  Plantilla
                            </a>
                            <a for="fileToUpload" class="btn btn-default">
                                <img width="30px" src="../svg/file.png" /> Cargar
                            </a>
                            <input type="file" name="fileToUpload" id="fileToUpload" hidden>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <div class="list-group">
                    <a id="btnPersona" go="Persona" class="list-group-item list-group-item-action opcion">
                        <img width="24px" src="../svg/group_users.png" /> Persona
                    </a>
                    <a id="btnUsuario" go="Usuario" class="list-group-item list-group-item-action opcion">
                        <img width="24px" src="../svg/man-user.png" /> Usuario
                    </a>
                    <a id="btnLago" go="Lago" class="list-group-item list-group-item-action opcion">
                        <img width="24px" src="../svg/lake.png" /> Lago
                    </a>
                    <a id="btnSensor" go="Sensor" class="list-group-item list-group-item-action opcion">
                        <img width="24px" src="../svg/sensor.png" /> Sensor
                    </a>
                    <a id="btnSondeo" go="Sondeo" class="list-group-item list-group-item-action opcion">
                        <img width="24px" src="../svg/variable-graphic.png" /> Sondeo
                    </a>
                </div>

            </div>

        </div>
    </div>

    <div id="pnMensaje"></div>

    <div class="modal" id="modalLago" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mis lagos</h5>
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
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Geolocalización</th>
                                <th>Area</th>
                                <th>Altitud</th>
                                <th>Cant.Peces</th>
                                <th>Profundidad</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tdResultado"></tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th></th>
                                <th style="text-align:left"></th>
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

    <input type="text" id="txtTipo" value="" hidden />
</body>

</html>