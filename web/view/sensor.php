<html>

<head>
  <title>Sensor</title>
  <input id="lblTitulo" type="hidden" value="sensor">
  <meta charset="utf-8">
  <?php 
    require("../plantilla/menu.php");
    ?>

  <script type="text/javascript" src="../scripts/DataTable/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../scripts/DataTable/datatables.min.css" />
  <script src="../scripts/datepicker.min.js" type="text/javascript"></script>
  <link href="../content/datepicker.min.css" rel="stylesheet" type="text/css" />

  <script src="../scripts/Aplicacion/jsAjax.js"></script>
  <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
  <script src='../scripts/Aplicacion/class/jsClassMarca.js'></script>
  <script src='../scripts/Aplicacion/class/jsClassSensor.js'></script>
  <script src='../scripts/Aplicacion/class/jsClassLago.js'></script>
  <script src='../scripts/Aplicacion/jsSensor.js'></script>


</head>

<body class="bg-light">




  <hr>
  <div class="py-5 container">
    <div class="row">

      <div class="col-md-9">

        <div class="card">
          <div class="card-header">
            <h5><img width="24px" src="../svg/sensor.png" /> Registro de sondas</h5>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="txtNombre">Nombre</label>
              <input type="text" class="form-control limpiar" id="txtNombre">
            </div>
            <div class="form-group">
              <label for="txtCodigo">Código</label>
              <input type="text" class="form-control limpiar" id="txtCodigo">
            </div>
            <div class="form-group">
              <label for="txtDescripcion">Descripción</label>
              <textarea type="text" class="form-control limpiar" id="txtDescripcion"></textarea>
            </div>

            <div class="form-group">
              <label for="ddlMarca">Marca</label>
              <select id="ddlMarca" class="form-control limpiarddl"></select>
            </div>

            <div class="form-group">
              <label for="txtFecha">Fecha mantenimiento</label>
              <input type="text" class="form-control limpiar" id="txtFecha">
            </div>
            <div class="form-group">
              <label for="txtRepetir">Repetir cada <em>(días)</em></label>
              <input type="number" class="form-control limpiar" id="txtRepetir" value="0">
            </div>
            <div class="form-group">
              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input estado limpiarchk" id="chkEstado" name="chkEstado">
                <label class="custom-control-label" for="chkEstado">Activo</label>
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

          <a id="btnSensor" class="list-group-item list-group-item-action">
            <img width="18px" src="../svg/si-glyph-pencil.svg" /> Mis sondas
          </a>
        </div>

      </div>

    </div>
  </div>




  <div class="modal" id="modalSensor" tabindex="-1" style="overflow-y: scroll;" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Mis sondas</h5>
          <button id="btnCerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <input class="form-control" id="myInput" type="" placeholder="Buscar en la tabla:">
          <br>
          <div class="table-responsive">
            <table id="Tabla" class="table table-bordered table-striped" style="display:none;">
              <thead>
                <tr>
                  <th></th>
                  <th>Nombre</th>
                  <th>Descripción</th>
                  <th>Código</th>
                  <th>Fecha Mantenimiento</th>
                  <th>Repetir cada</th>
                  <th>Estado</th>
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


        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>

  <input type="hidden" id="txtSensorID" value="" hidden />
  <div id="pnMensaje"></div>

</body>
<?php 
require("../plantilla/pie.php");
?>

</html>