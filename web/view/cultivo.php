<html>

<head>
    <title>Mi Cultivo</title>
    <input id="lblTitulo" type="hidden" value="cultivo">
    <meta charset="utf-8">

    <?php 
          require("../plantilla/menu.php");
     ?>

    <script type="text/javascript" src="../Scripts/DataTable/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../Scripts/DataTable/datatables.min.css"/>
    <script src="../Scripts/datepicker.min.js" type="text/javascript"></script>
    <link href="../Content/datepicker.min.css" rel="stylesheet" type="text/css" />

    <script src="../scripts/Aplicacion/jsAjax.js"></script>
    <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
    <script src='../scripts/Aplicacion/class/jsClassEspecie.js'></script>
    <script src='../scripts/Aplicacion/class/jsClassLago.js'></script>
    <script src='../scripts/Aplicacion/class/jsClassCultivo.js'></script>
    <script src='../scripts/Aplicacion/jsCultivo.js'></script>

</head>

<body class="bg-light">

   


    <hr>
    <div class="py-5 container">
        <div class="row">

            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h5>Mi cultivo</h5>
                    </div>
                    <div class="card-body">
                      
                        <div class="form-group">
                            <label for="ddlLago">Lago</label>
                            <select id="ddlLago" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="ddlEspecie">Especie</label>
                            <select id="ddlEspecie" class="form-control"></select>
                        </div>
                        <div class="form-group">
                            <label for="txtFechaInicio">Fecha inicio</label>
                            <input type="text"  id="txtFechaInicio" class="form-control limpiar">
                        </div>
                        <div class="form-group">
                            <label for="txtFechaFinaliza">Fecha finalización</label>
                            <input type="text"  id="txtFechaFinaliza" class="form-control limpiar">
                        </div>

                        <div class="form-group">
                            <button id="btnEnviar" class="btn btn-primary"
                                type="button">Guardar</button>
                                <button id="btnLimpiar" class="btn btn-secondary" type="button">Limpiar</button>
                                
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <div class="list-group">

                    <a id="btnConfiguracion" class="list-group-item list-group-item-action">
                        <img width="18px" src="../svg/si-glyph-pencil.svg" /> Mis Configuraciones
                    </a>
                </div>

            </div>

        </div>
    </div>


    <div class="modal" id="modal" tabindex="-1"  style="overflow-y: scroll;" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Mis cultivos</h5>
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
                <th>Lago</th>
                <th>Tipo pez</th>
                <th>Fecha inicio</th>
                <th>Fecha finalización</th>
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

  <input type="hidden" id="txtID" value="" hidden/>
  <span id="pnMensaje"></span>

</body>
<?php 
require("../plantilla/pie.php");
?>

</html>