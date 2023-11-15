<html>

<head>
    <title>Importar</title>
    <input id="lblTitulo" type="hidden" value="importar">
    <meta charset="UTF-8">

    <?php 
         require("../plantilla/menu.php");
     ?>

    <script src="../scripts/Aplicacion/jsAjax.js"></script>
    <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
    <script src='../scripts/Aplicacion/jsPersona.js'></script>
    <script src='../scripts/Aplicacion/class/jsClassSonda.js'></script>
    <script src='../scripts/Aplicacion/class/jsClassLago.js'></script>
    <script src='../scripts/Aplicacion/class/jsClassSensor.js'></script>
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
                        <div id="pnCultivo" hidden class="form-group">
                            <label for="ddlCultivo">Lago</label>
                            <select id="ddlCultivo" class="form-control">
                                <option></option>
                            </select>
                        </div>
                        <div class="table-responsive">
                            <div class="form-group">
                                <table class="table table-bordered" id="tabla"></table>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="txtDescripcionLago"></label>
                            <textarea charset="UTF-8" type="text" disabled class="form-control limpiar" id="txtImportar"
                                rows="10" required></textarea>
                        </div>
                        <div class="form-group">
                            <button id="btnEnviar" class="btn btn-primary" type="button">Enviar</button>
                            <button id="btnLimpiar" class="btn btn-secondary" type="button">Limpiar</button>

                            <label for="fileToUpload" class="btn btn-info">
                                <img width="20px" src="../svg/file.png" /> Cargar
                            </button>

                            <input type="file" name="fileToUpload" id="fileToUpload" hidden>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <div class="form-group">
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
                            <img width="24px" src="../svg/sensor.png" /> Sonda
                        </a>
                        <a id="btnSondeo" go="Sondeo" class="list-group-item list-group-item-action opcion">
                            <img width="24px" src="../svg/variable-graphic.png" /> Medición
                        </a>
                    </div>

                </div>
                <div class="form-group">
                    <div class="card">
                        <div class="card-header">Ayuda</div>
                        <div class="card-body">
                            <a id="btnPlantilla" type="button" class="btn btn-default">
                                <img src="../svg/documento.png" width="30px">
                                Plantilla
                            </a>
                        </div>

                    </div>
                </div>

            </div>

        </div>
    </div>

    <div id="pnMensaje"></div>


    <div id="pnMensaje"></div>

    <input type="text" id="txtTipo" value="" hidden />

</body>
<?php 
require("../plantilla/pie.php");
?>

</html>