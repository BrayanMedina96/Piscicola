<html lang="en">

<head>
     <title>
          Login
     </title>
     <link rel="icon" href="../svg/fish.png">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link href="../content/bootstrap.min.css" rel="stylesheet" />
     <link href="../content/bootstrap.css" rel="stylesheet" />
     <link href="../content/aqua.css" rel="stylesheet" />

     <script src="../scripts/jquery-3.3.1.min.js"></script>
     <script src="../scripts/popper.min.js"></script>
     <script src="../scripts/bootstrap.min.js"></script>
     <script src='../scripts/Aplicacion/jsTipoDocumento.js'></script>
     <script src="../scripts/Aplicacion/jsLogin.js"></script>
     <script src="../scripts/Aplicacion/jsAjax.js"></script>
     <script src="../scripts/Aplicacion/jsUtilidad.js"></script>
     <script src="../scripts/Aplicacion/jsPersonaUsuario.js"></script>
     <script src="../scripts/Aplicacion/jsLocalStorage.js"></script>
     <?php
          include "../utilidad/login.php";
        ?>


     <nav style=" background: linear-gradient(0.25turn, orange, orange, #FFF86A5B);" class="navbar navbar-expand-md navbar-dark fixed-top bg-secondary">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
               aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarsExampleDefault">
               <ul class="navbar-nav mr-auto">

                    <li id="home" class="nav-item active">
                         <a class="nav-link go" go="../view/login.php"><strong>AQUA</strong></a>
                    </li>
               </ul>
          </div>
     </nav>
</head>

<body class="bg-light" onload="deshabilitaRetroceso()">
     <hr>
     <form action="login.php" method="get">
          <div class="container col-sm-12">
               <div class="row">


                    <div class="col-sm-4">
                         <!--  <img src="../svg/pez.png"  class="img-fluid rounded" alt="Cinque Terre"> -->
                    </div>

                    <div class="col-sm-4">

                         <div id="ajustar"><br> <br> <br> <br></div>

                         <div class="form-group form-inline">
                              <div class="col-sm-7" style="text-align: left;">
                                   <h6 id="txtTitulo">Inicia sesión</h6>
                              </div>
                              <div class="col-sm-5" style="text-align: right;">
                                   <a id="btnCrearCuenta" href="#">Crea una cuenta</a>
                                   <a id="btnLogin" href="#" hidden>Inicia sesión</a>
                              </div>
                         </div>

                         <div class="form-group registrar">
                              <select id="ddlTipoDocumento" class="form-control" required="">
                              </select>
                         </div>

                         <div class="form-group registrar">
                              <input type="text" id="txtNumeroDocumento" class="form-control"
                                   placeholder="Número Documento" required="">
                         </div>
                         <div class="form-group registrar">
                              <input type="text" id="txtNombre" class="form-control" placeholder="Nombre" required="">
                         </div>
                         <div class="form-group registrar">
                              <input type="text" id="txtApelldio" class="form-control" placeholder="Apellido"
                                   required="">
                         </div>
                         <div class="form-group registrar">
                              <input type="text" id="txtNombreComercial" class="form-control"
                                   placeholder="Nombre Comercial" required="">
                         </div>
                         <div class="form-group">
                              <input type="text" id="txtUsuario" class="form-control login" placeholder="Usuario"
                                   required="">
                         </div>

                         <div class="input-group mb-3">
                              <input type="password" id="txtPassword" class="form-control login"
                                   placeholder="Contraseña" required="">
                              <div class="input-group-append">
                                   <span class="input-group-text">
                                        <img id="btnOjo" src="../svg/ojo-cerrado.png" go="no" style="width:24px">
                                   </span>
                              </div>
                         </div>

                         <div class="form-group">
                              <div class="progress">
                                   <div id="pnSeguridad" class="progress-bar">
                                        <lable id="lblSeguridad"></lable>
                                   </div>
                              </div>
                         </div>


                         <div id="pnPassword" class="form-group registrar">
                              <input type="password" id="txtPasswordConfirmar" class="form-control"
                                   placeholder="Confirmar contraseña" required="">
                         </div>

                         <button id="btnEnviar" class="btn btn-lg btn-primary btn-block" type="Submit">Inicia
                              sesión</button>

                         <div id="pnCircular" style="display: none;" class="form-group">
                              <button type="button" style="font-size:10px" class="cicular"></button>
                         </div>

                         <button id="btnEnviar2" type="submit" hidden></button>
                         <label id="lblTiempo" class="btn btn-lg btn-secondary  btn-block" hidden>00:00</label>



                    </div>

               </div>

               <input id="txtUsuariohd" name="txtUsuariohd" type="hidden" value="0">
               <input id="txtToken" name="txtToken" type="hidden" value="0">
               <input id="txtNombreUsuario" name="txtNombreUsuario" type="hidden" value="0">
               <input id="hdCambioPass" name="hdCambioPass" type="hidden" value="0">


               <input id="txtIntento" type="hidden" value="1">
               <input id="txtUser" type="hidden" value="0">

               <div id="pnMensaje"></div>
               <p class="mt-5 mb-3 text-muted text-center">© 2019</p>

     </form>


</body>

</html>