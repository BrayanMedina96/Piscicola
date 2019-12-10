<link rel="icon" href="../svg/fish.png">

<link href="../content/bootstrap.min.css" rel="stylesheet" />
<link href="../content/bootstrap.css" rel="stylesheet" />
<script src="../scripts/jquery-3.3.1.min.js"></script>
<script src="../scripts/bootstrap.min.js"></script>

<form action="../plantilla/menu.php" method="get">

  <?php
       include "../utilidad/base64.php";
       include "../utilidad/menu.php";
   ?>

  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-secondary">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
      aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">

        <li id="home" class="nav-item active">
          <a class="nav-link go" go="../view/home.php">PISC.NET</a>
        </li>
        <li class="nav-item active">
          <a id="mCuenta" class="nav-link go" go="../view/cuenta.php">Mi cuenta<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="ddlregistro" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Registro</a>
          <div class="dropdown-menu" aria-labelledby="ddlregistro">
            <a id="mLago" class="dropdown-item go" go="../view/lago.php">Lago</a>
            <a id="mSensor" class="dropdown-item go" go="../view/sensor.php">Sensor</a>
            <a id="mConfiguracion" class="dropdown-item go" go="../view/configuracion.php" href="#">Configuración (S-L)</a>
            <a id="mTipoLago" class="dropdown-item go" go="../view/tipoLago.php" href="#">Tipo lago</a>
            <a id="mSonda" class="dropdown-item go" go="../view/sonda.php" href="#">Sonda</a>
          </div>
        </li>
        <li class="nav-item active">
          <a id="mImportar" class="nav-link go" go="../view/importar.php">Importar<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a id="mDashboard" class="nav-link go" go="../view/dashboard.php">Dashboard<span class="sr-only">(current)</span></a>
        </li>
        
      </ul>
      <div class="form-inline my-2 my-lg-0 ">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item"> <a class="nav-link"> [

              <?php
                     $obj=new Base64();
                     $result=$obj->decodeUsuario();
                    if(!isset($result["nombre"])) 
                    {
                        header('Location:../view/login.php');
                        die();
                     }

                    echo  $result["nombreComercial"];
              ?>

              ] </a> </li>
          <li class="nav-item">
            <button type="button" class="btn btn-default" title="Notificaciones">
              <img src="../svg/notification.png" width="18px">
              <span class="badge badge-danger">7</span>
            </button>
          </li>
          <li class="nav-item">
            <a class="nav-link" type="submit">
              <?php 
                    echo  $result["nombre"];  
              ?>
            </a>
          </li>
          <li class="nav-item">
            <button id="btnSalir" type="button" class="btn btn-default" title="Cerrar sesión">
              <img src="../svg/sign-out-option.png" width="18px">
              <span class="badge badge-secondary"> </span>
            </button>
          </li>
        </ul>

        <input id="txtVarUrl" name="txtVarUrl" type="text" hidden value="<?php echo  $obj->getVar()  ?>">
        <input id="txtUrl" name="txtUrl" type="text" hidden value="">
        <input id="txtSalir" name="txtSalir" type="text" hidden value="">
        <input id="txtUsuarioMenu" name="txtUsuarioMenu" type="text" hidden value="<?php echo  $result["usuario"]  ?>">
        <input id="txtUsuarioidMenu" name="txtUsuarioMenu" type="text" hidden
          value="<?php echo  $result["usuarioid"]  ?>">
        <input id="txtPersonaidMenu" name="txtUsuarioMenu" type="text" hidden
          value="<?php echo  $result["personaid"]  ?>">

        <button id="btnGo" type="submit" hidden></button>



      </div>
    </div>
  </nav>

  <script>
    $(".go").click(function (e) {

      $("#txtSalir").val("");
      $("#txtUrl").val(e.currentTarget.attributes.go.nodeValue);
      $("#btnGo").click();

    })

    $("#btnSalir").click(function () {
      $("#txtSalir").val("salir");
      $("#btnGo").click();
    });
  </script>

</form>
