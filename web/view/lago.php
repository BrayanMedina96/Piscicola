<html>

<head>
  <title>Lago</title>
  <meta charset="utf-8">

  <?php 
         require("../plantilla/menu.php");
     ?>
  <script type="text/javascript" src="../Scripts/DataTable/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../Scripts/DataTable/datatables.min.css" />

  <script src="../scripts/Aplicacion/jsAjax.js"></script>
  <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
  <script src='../scripts/Aplicacion/jsClassLago.js'></script>
  <script src='../scripts/Aplicacion/jsClassMaterial.js'></script>
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
            <h5> Registro de lagos</h5>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="txtNombre">Nombre</label>
              <input type="text" class="form-control limpiar" id="txtNombreLago" maxlength="50" required>
            </div>
            <div class="form-group">
              <label for="txtNombre">Descripción</label>
              <textarea type="text" class="form-control limpiar" id="txtDescripcionLago" maxlength="100"
                required></textarea>
            </div>

            <div class="input-group">
              <div class="input-group-prepend">
                <div onclick="getLocation()" class="input-group-text" id="btnGeolocalizacion">
                  <img width="18px" src="../svg/planet-earth.png" />
                </div>
              </div>
              <input type="text" id="txtGeolocalizacion" class="form-control limpiar"
                placeholder="Geolocalización: Latitud ; Longitud">
            </div>

            <div class="form-group">
              <label for="txtArea">Área <em>(m<sup>2</sup>)</em></label>
              <input type="number" class="form-control limpiar" id="txtArea">
            </div>
            <div class="form-group">
              <label for="txtAltitud">Altitud <em>(m)</em></label>
              <input type="number" class="form-control limpiar" id="txtAltitud">
            </div>
            <div class="form-group">
              <label for="txtCantidadPeces">Catidad de peces</label>
              <input type="number" class="form-control limpiar" id="txtCantidadPeces">
            </div>
            <div class="form-group">
              <label for="txtProfundidad">Profundidad <em>(cm)</em></label>
              <input type="number" class="form-control limpiar" id="txtProfundidad">
            </div>
            <div class="form-group">
              <label for="ddlTipoLago">Tipo</label>
              <select id="ddlTipoLago" class="form-control"></select>
            </div>
            <div class="form-group">
              <button id="btnEnviar" class="btn btn-primary" type="button">Guardar</button>
              <button id="btnLimpiar" class="btn btn-secondary" type="button">Limpiar</button>

              <span id="pnMensaje"></span>
            </div>
          </div>
        </div>

      </div>

      <div class="col-md-3">

        <div class="list-group">
          <a id="btnLago" class="list-group-item list-group-item-action">
            <img width="18px" src="../svg/si-glyph-pencil.svg" /> Mis lagos
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