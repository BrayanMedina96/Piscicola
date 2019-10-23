<html>

<head>
    <title>Importar</title>
    <meta charset="utf-8">

    <?php 
         require("../plantilla/menu.php");
     ?>
    <script type="text/javascript" src="../Scripts/DataTable/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../Scripts/DataTable/datatables.min.css" />

    <script src="../scripts/Aplicacion/jsAjax.js"></script>
    <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
    <script src='../scripts/Aplicacion/jsClassLago.js'></script>
    <script src='../scripts/Aplicacion/jsLago.js'></script>

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
                        <h5>Importar</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="txtDescripcionLago">Descripción</label>
                            <textarea type="text" class="form-control limpiar" id="txtDescripcionLago" maxlength="100"
                                required></textarea>
                        </div>
                        <div class="form-group">
                            <button id="btnEnviar" class="btn btn-primary" type="button">Enviar</button>
                            <button id="btnLimpiar" class="btn btn-secondary" type="button">Limpiar</button>

                            <label for="fileToUpload" class="btn btn-default">
                                <img width="30px" src="../svg/file.png" /> Cargar
                            </label>
                            <input type="file" name="fileToUpload" id="fileToUpload" hidden>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <div class="list-group">
                    <a id="btnLago" class="list-group-item list-group-item-action">
                        <img width="18px" src="../svg/si-glyph-pencil.svg" /> Persona
                    </a>
                    <a id="btnLago" class="list-group-item list-group-item-action">
                        <img width="18px" src="../svg/si-glyph-pencil.svg" /> Usuario
                    </a>
                    <a id="btnLago" class="list-group-item list-group-item-action">
                        <img width="18px" src="../svg/si-glyph-pencil.svg" /> lago
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

    <input type="text" id="txtLagoID" value="" hidden />
</body>

</html>