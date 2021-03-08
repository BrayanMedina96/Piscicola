<html>

<head>
    <title>Seguridad</title>
    <input id="lblTitulo" type="hidden" value="seguridad">
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
    <script src='../scripts/Aplicacion/class/jsClassSeguridad.js'></script>
    <script src='../scripts/Aplicacion/jsSeguridad.js'></script>



</head>

<body class="bg-light">

    <hr>
    <div class="py-5 container">
        <div class="row">

            <div class="col-md-9">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                           <h5>Seguridad</h5> <em></em> <label id="lblEstado"></label>
                        </div>
                    </div>

                    <div class="card-body">

                        <div id="pnCrearPerfil" class="">
                            <div class="form-group">
                                <label for="txtNombre">Perfil</label>
                                <input type="text" class="form-control perfil" id="txtNombre" required>
                            </div>
                            <div class="form-group">
                                <label for="txtNombre">Descripción</label>
                                <textarea type="text" class="form-control perfil" id="txtDescripcion" required></textarea>
                            </div>
                        </div>

                        <div id="pnCrearPermiso" class="d-none">

                            <div class="form-group">
                                <label for="txtNombre">Perfil</label>
                                 <select class="form-control limpiar" id="ddlPerfil"></select>
                            </div>

                            <div class="form-group">
                                <label for="txtNombre">Formulario</label>
                                <div class="input-group mb-3 usuario contrasenia">
                                    <select class="form-control limpiar" id="ddlFormulario"></select>
                                    <div id="btnOcultar" title="Ocultar formulario" data-toggle="tooltip" class="input-group-append">
                                        <span class="input-group-text">
                                            <img  id="btnOjo" src="../svg/ojo-cerrado.png" go="no" style="width:24px">
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="txtNombre">Campo</label>
                                 <select class="form-control limpiar" id="ddlCampo"></select>
                            </div>

                            <div class="form-group">
                                <label for="txtNombre">Acción</label>
                                 <select class="form-control limpiar" id="ddlAccion"></select>
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

                <div class="list-group">

                    <a id="btnPerfil" class="list-group-item list-group-item-action">
                        <img width="18px" src="../svg/si-glyph-pencil.svg" />Perfil
                    </a>

                    <a id="btnPermisos" class="list-group-item list-group-item-action">
                        <img width="18px" src="../svg/si-glyph-pencil.svg" />Permisos
                    </a>

                    <a id="btnConfiguracion" class="list-group-item list-group-item-action">
                        <img width="18px" src="../svg/si-glyph-bullet-list-2.svg" />Mi configuración
                    </a>

                </div>

            </div>

        </div>
    </div>


    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mis restricciones</h5>
                    <button id="btnCerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <input class="form-control" id="myInput" type="text" placeholder="Buscar en la tabla:">
                    <table id="Tabla" class="table table-bordered table-striped" style="display:none;">
                        <thead>
                            <tr>
                                <th>Perfil</th>
                                <th>Formulario</th>
                                <th>Campo</th>
                                <th>Acción</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="tdResultado"></tbody>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th style="text-align:left"></th>
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
     <div id="pnMensaje"></div>
    <input type="text" id="textLagoSensorID" value="" hidden />

    

</body>
<?php 
require("../plantilla/pie.php");
?>

</html>