<html>

<head>
    <title>Usuario</title>
    <input id="lblTitulo" type="hidden" value="usuario">
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
    <script src="../scripts/Aplicacion/jsPersonaUsuario.js"></script>
    <script src='../scripts/Aplicacion/jsClassSeguridad.js'></script>
    <script src='../scripts/Aplicacion/jsTipoDocumento.js'></script>
    <script src="../scripts/Aplicacion/jsLogin.js"></script>

    <script src="../scripts/Aplicacion/jsCrearUsuario.js"></script>


</head>

<body class="bg-light">

    <hr>
    <div class="py-5 container">
        <div class="row">

            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h5>Usuario</h5>
                    </div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="ddlTipoDocumento">Tipo de documento</label>
                            <select id="ddlTipoDocumento" class="form-control" required="">
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="txtNumeroDocumento">Numero de documento</label>
                            <input type="text" id="txtNumeroDocumento" class="form-control"
                                placeholder="Numero Documento" required="">
                        </div>
                        <div class="form-group">
                            <label for="txtNombre">Nombre</label>
                            <input type="text" id="txtNombre" class="form-control" placeholder="Nombre" required="">
                        </div>
                        <div class="form-group">
                            <label for="txtApelldio">Apellido</label>
                            <input type="text" id="txtApelldio" class="form-control" placeholder="Apellido" required="">
                        </div>

                        <div class="form-group">
                            <label for="txtUsuario">Usuario</label>
                            <input type="text" id="txtUsuario" class="form-control login" placeholder="Usuario"
                                required="">
                        </div>

                        <div class="mb-3 usuario perfil">
                            <label for="ddlPerfil">Perfil<span class="text-muted"></span></label>
                            <select id="ddlPerfil" class="form-control perfil" required="">
                            </select>
                        </div>

                        <div class="mb-3 usuario perfil">
                            <label for="txtCorreo">Correo<span class="text-muted"></span></label>
                            <input type="text" id="txtCorreo" class="form-control perfil" required="">
                            
                        </div>

                        <div class="form-group">
                            <button id="btnEnviar" class="btn btn-primary" type="button">Crear usuario</button>
                            <button id="btnLimpiar" class="btn btn-secondary" type="button">Limpiar</button>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-3">

                <div class="card">
                    <div class="card-header">Información</div>
                    <div class="card-body">
                    </div>

                </div>

            </div>

        </div>
    </div>

    <label id="txtTitulo" hidden>Crear una cuenta</label>
    <div id="pnMensaje"></div>
</body>
<?php 
require("../plantilla/pie.php");
?>

</html>