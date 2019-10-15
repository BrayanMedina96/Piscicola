<html lang="en">
   <head>
  
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link href="../content/bootstrap.min.css" rel="stylesheet" />
        <link href="../content/bootstrap.css" rel="stylesheet" />
        <script src="../scripts/jquery-3.3.1.min.js"></script>
        <script src="../scripts/bootstrap.min.js"></script>
        <script src='../scripts/Aplicacion/jsTipoDocumento.js'></script>
        <script src="../scripts/Aplicacion/jsLogin.js"></script>
        <script src="../scripts/Aplicacion/jsAjax.js"></script>
        <script src="../scripts/Aplicacion/jsUtilidad.js"></script>
        <script src="../scripts/Aplicacion/jsPersonaUsuario.js"></script>
        <?php
          include "../utilidad/login.php";
        ?>
   </head>
  <body onload="deshabilitaRetroceso()">
<hr>
<form action="login.php" method="get">
<div class="container col-md-12">
    <div class="row">


       <div class="offset-2 col-md-4">
            <img src="../Captura.jpg" width="500px" class="rounded" alt="Cinque Terre">
                
      
       </div>

        <div class=" col-md-4">
                <br>
                <br>
                <br>
          <div class="form-group form-inline">
               <div class="col-md-7" style="text-align: left;" >
                <h4 id="txtTitulo" >Inicia sesión</h4> 
           </div>
           <div class="col-md-5" style="text-align: right;">
                <a id="btnCrearCuenta" href="#"  >Crea una cuenta</a> 
                <a id="btnLogin" href="#" hidden>Inicia sesión</a> 
           </div>    
        </div>

       <div class="form-group registrar">
           <select  id="ddlTipoDocumento" class="form-control"  required="">
           </select>
       </div>
         
      <div class="form-group registrar">
           <input type="text" id="txtNumeroDocumento" class="form-control" placeholder="Numero Documento" required="">
      </div>
      <div class="form-group registrar">
           <input type="text" id="txtNombre" class="form-control" placeholder="Nombre" required="">
      </div>
      <div class="form-group registrar">
          <input type="text" id="txtApelldio" class="form-control" placeholder="Apellido" required="">
      </div>
      <div class="form-group">
           <input type="text" id="txtUsuario" class="form-control login" placeholder="Usuario" required="" >
      </div>

      <div class="form-group">
          <input type="password" id="txtPassword" class="form-control login" placeholder="Contraseña" required="">
      </div>

      <div class="form-group registrar">
          <input type="password" id="txtPasswordConfirmar" class="form-control" placeholder="Confirmar contraseña" required="">
      </div>

      <button id="btnEnviar" class="btn btn-lg btn-primary btn-block" type="button">Inicia sesión</button>
      <button id="btnEnviar2"  type="submit" hidden></button>



    </div>

</div>

<input id="txtUsuariohd" name="txtUsuariohd" type="hidden" value="0">
<input id="txtToken" name="txtToken" type="hidden" value="0">
<input id="txtNombreUsuario" name="txtNombreUsuario" type="hidden" value="0">

<input id="txtIntento" type="hidden" value="0">
<div id="pnMensaje"></div>
<p class="mt-5 mb-3 text-muted text-center">© 2019</p>

</form>


</body>
</html>