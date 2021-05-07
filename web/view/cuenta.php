<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Cuenta</title>
  <input id="lblTitulo" type="hidden" value="cuenta">
  <?php 
          require("../plantilla/menu.php");
  ?>

  <script src="../scripts/datepicker.min.js" type="text/javascript"></script>
  <link href="../content/datepicker.min.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript" src="../scripts/DataTable/datatables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../scripts/DataTable/datatables.min.css" />

  <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
  <script src='../scripts/Aplicacion/jsPersonaUsuario.js'></script>
  <script src='../scripts/Aplicacion/class/jsClassSeguridad.js'></script>
  <script src='../scripts/Aplicacion/jsPersona.js'></script>
  <script src='../scripts/Aplicacion/jsTipoDocumento.js'></script>
  <script src='../scripts/Aplicacion/jsCuenta.js'></script>

  <style>
    #tdResultado tr {
      cursor: pointer;
    }
  </style>
</head>

<body class="bg-light">



  <div class="container">

    <div class="py-5 text-center">
      <hr>
    </div>

    <div class="row">

      <div class="col-md-4 order-md-2 mb-4">

        <ul class="">
          <li id="btnInfoPersonal" class="list-group-item list-group-item-action panelinformacionpersonal">
            <img width="18px" src="../svg/si-glyph-pencil.svg" />
            Información personal
          </li>
          <li id="btnSeguridad" class="list-group-item list-group-item-action panelseguridad">
            <img width="18px" src="../svg/si-glyph-key-2.svg" />
            Seguridad
          </li>
          <li id="btnUsuario"  class="list-group-item list-group-item-action panelusuario" hidden data-toggle="modal"
            data-target="#modalPersona">
            <img width="18px" src="../svg/man-user.png" />
            Usuarios
          </li>
          <li id="btnMiUsuario" class="list-group-item list-group-item-action panelmiusuario" data-toggle="modal"
            data-target="#modalPersona">
            <img width="18px" src="../svg/group_users.png" />
            Mis Usuarios
          </li>
          <li class="list-group-item list-group-item-action panelnotificacioncorreo">
            <div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" class="custom-control-input" id="chekNotificacionCorreo"
                name="chekNotificacionCorreo">
              <label class="custom-control-label" for="chekNotificacionCorreo">Notificación por correo </label>
            </div>
          </li>
          <li class="list-group-item list-group-item-action panelnotificacionmensaje">
            <div class="custom-control custom-checkbox mb-3">
              <input type="checkbox" class="custom-control-input" id="chekNotificacionMensaje"
                name="chekNotificacionMensaje">
              <label class="custom-control-label" for="chekNotificacionMensaje">Notificación por mensaje texto</label>
            </div>

          </li>
        </ul>


      </div>

      <div class="col-md-8 order-md-1">

        <div class="card">

          <div class="card-body">
            <h4 id="lblTitulo" class="mb-3 card-title">Editar mi cuenta</h4>
            <form class="needs-validation" novalidate="">

              <div class="row personal">

                <div class="col-md-6 mb-3 nombre">
                  <label for="txtNombre">Nombre</label>
                  <input type="text" class="form-control nombre" id="txtNombre" placeholder="" value="" required="">
                </div>
                <div class="col-md-6 mb-3 apellido">
                  <label for="txtApellido">Apellido</label>
                  <input type="text" class="form-control apellido" id="txtApellido" placeholder="" value="" required="">
                </div>

              </div>


              <div class="mb-3 personal tipodocumento">
                <label for="username">Tipo documento</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"></span>
                  </div>
                  <select id="ddlTipoDocumento" class="form-control tipodocumento" required="">
                  </select>

                </div>
              </div>

              <div class="mb-3 personal numerodocumento">
                <label for="txtNumeroDocumento">Número de documento</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"></span>
                  </div>
                  <input type="text" class="form-control numerodocumento" id="txtNumeroDocumento" required="">

                </div>
              </div>

              <div class="mb-3 personal email">
                <label for="txtEmail">Email <span class="text-muted">(Optional)</span></label>
                <input type="email" class="form-control email" id="txtEmail" placeholder="you@example.com">
                <div class="invalid-feedback">
                  Please enter a valid email address for shipping updates.
                </div>
              </div>

              <div class="mb-3 personal telefono">
                <label for="txtTelefono">Telefono</label>
                <input type="text" class="form-control telefono" id="txtTelefono" placeholder="" required="">
                <div class="invalid-feedback">
                  Please enter your shipping address.
                </div>
              </div>

              <div class="mb-3 personal telefonoopcional">
                <label for="txtTelefonoOpcional">Telefono 2<span class="text-muted">(Opcional)</span></label>
                <input type="text" class="form-control telefonoopcional" id="txtTelefonoOpcional" placeholder="">
              </div>

              <div class="mb-3 usuario usuarionombre">
                <label for="txtUsuario">Usuario<span class="text-muted"></span></label>
                <input type="text" class="form-control usuarionombre" id="txtUsuario" disabled placeholder="">
              </div>

              <div class="mb-3 usuario perfil">
                <label for="ddlPerfil">Perfil<span class="text-muted"></span></label>
                <select id="ddlPerfil" class="form-control perfil" required="">
                </select>
              </div>

              <div class="mb-3 usuario fechaexpiracion">
                <label for="txtFechaExp">Fecha expiración</label>
                <input required type=" " placeholder="Fecha" class="form-control bloqueo fechaexpiracion" 
                  id="txtFechaExp">
              </div>

              <div id="pnPassword">
              <label for="txtContrasenia">Contraseña<span class="text-muted"></span></label>
                <div class="input-group mb-3 usuario contrasenia">
                  <input type="password" class="form-control contrasenia" id="txtContrasenia" placeholder="">
                  <div class="input-group-append">
                    <span class="input-group-text">
                      <img id="btnOjo" src="../svg/ojo-cerrado.png" go="no" style="width:24px">
                    </span>
                  </div>
                </div>


                <div class="mb-3 usuario contrasenia">
                  <label for="address2">Confirmar contraseña<span class="text-muted"></span></label>
                  <input type="password" class="form-control contrasenia" id="txtContraseniaConfirmar" placeholder="">
                </div>

              </div>

              <div id="pnCambioPassword" class="mb-3 usuario estado d-none">
                  <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input estado" id="chkCambioPassword"
                      name="chkCambioPassword">
                    <label class="custom-control-label" for="chkCambioPassword">Cambio de contraseña</label>
                  </div>
                </div>

              <div class="mb-3 usuario estado">

                <div class="custom-control custom-checkbox mb-3">
                  <input type="checkbox" class="custom-control-input estado" id="chkEstado" name="chkEstado">
                  <label class="custom-control-label" for="chkEstado">Activo</label>
                </div>
              </div>





              <button id="btnEnviar" class="btn btn-primary" type="button">Guardar</button>
              <button id="btnLimpiar" class="btn btn-secondary" type="button">Limpiar</button>
            </form>

          </div>

        </div>



      </div>
    </div>

    <footer class="col-md-12">
      <input type="text" id="txtidPersona" value="" hidden />
      <input type="text" id="txtidUsuario" value="" hidden />
    </footer>
  </div>


  <div class="modal" id="modalPersona" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Usuarios</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

          <input class="form-control" id="myInput" type="text" placeholder="Buscar en la tabla:">
          <table id="Tabla" class="table table-bordered table-striped" style="display:none;">
            <thead>
              <tr>
                <th>Perfil</th>
                <th>Documento</th>
                <th>Usuario</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Estado</th>
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

</body>

<?php 
require("../plantilla/pie.php");
?>

</html>