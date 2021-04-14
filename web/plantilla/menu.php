<link rel="icon" href="../svg/fish.png">

<script src="../scripts/popper.min.js"></script>
<link href="../content/bootstrap.min.css" rel="stylesheet" />
<link href="../content/bootstrap.css" rel="stylesheet" />
<link href="../content/aqua.css" rel="stylesheet" />
<script src="../scripts/jquery-3.3.1.min.js"></script>
<script src="../scripts/bootstrap.min.js"></script>

<link rel="stylesheet" href="../content/bootstrap-treeview.min.css">
<script src="../scripts/bootstrap-treeview.min.js"></script>
<link href="../content/ico_css.css" rel="stylesheet">

<script src="../scripts/Aplicacion/jsAjax.js"></script>
<script src="../scripts/Aplicacion/jsUsuario.js"></script>

<script src="../scripts/Aplicacion/wizard.js"></script>
<script src="../scripts/Aplicacion/jsLocalStorage.js"></script>

<script src="../scripts/Aplicacion/class/jsCorreo.js"></script>
<script src="../scripts/Aplicacion/jsInfo.js"></script>


<form action="../plantilla/menu.php" method="get">


  <?php
      // include "../utilidad/base64.php";
       include "../utilidad/menu.php";
       include "../view/wizard.php";
       include "../view/info.php";
   ?>

  <nav id="menu" style=" background: linear-gradient(0.25turn, orange, orange, #FFF86A5B);" class="navbar navbar-expand-md navbar-dark fixed-top bg-secondary">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault"
      aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div  class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav mr-auto">

        <li id="home" class="nav-item active">
          <a class="nav-link go" go="../view/home.php"><strong>AQUA</strong></a>
        </li>
        <li class="nav-item active">
          <a id="mCuenta" class="nav-link go cuenta" go="../view/cuenta.php">Mi cuenta<span
              class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle registro" href="#" id="ddlregistro" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">Registro</a>
          <div class="dropdown-menu" aria-labelledby="ddlregistro">
            <a id="mUsuario" class="dropdown-item go musuario" go="../view/usuario.php">Usuario</a>
            <a id="mTipoLago" class="dropdown-item go mtipolago" go="../view/tipoLago.php" href="#">Tipos de lago</a>
            <a id="mLago" class="dropdown-item go mlago" go="../view/lago.php">Lago</a>
            <a id="mMarca" class="dropdown-item go mmarca" go="../view/marca.php">Marcas de sonda</a>
            <a id="mSensor" class="dropdown-item go msensor" go="../view/sensor.php">Sonda</a>
            <a id="mConfiguracion" class="dropdown-item go mconfiguracion" go="../view/configuracion.php"
              href="#">Configuración (S-L)</a>
            <a id="mCultivo" class="dropdown-item go mcultivo" go="../view/cultivo.php" href="#">Mi Cultivo</a>
            <a id="mSonda" class="dropdown-item go msonda" go="../view/sonda.php" href="#">
              Medición</a>
            <a id="mSonda" class="dropdown-item go msonda" go="../view/rango.php" href="#">Rangos</a>
          </div>
        </li>
        <li class="nav-item active">
          <a id="mImportar" class="nav-link go importar" go="../view/importar.php">Importar<span
              class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item active">
          <a id="mDashboard" class="nav-link go dashboard" go="../view/dashboard.php">Dashboard<span
              class="sr-only">(current)</span></a>
        </li>
        
       <!-- <li class="nav-item active">
          <a id="mPredecir" class="nav-link go predecir" go="../view/predecir.php">Predecir<span
              class="sr-only">(current)</span></a>
        </li>-->
        <li class="nav-item active">
          <a id="mSeguridad" class="nav-link go seguridad" go="../view/seguridad.php">Seguridad<span
              class="sr-only">(current)</span></a>
        </li>

      </ul>
      <div class="form-inline my-2 my-lg-0 ">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item"> <a class="nav-link"> 

                <label id="lblNombreComercial"></label>

               </a>
          </li>

          <li class="nav-item">
            <button type="button" class="btn btn-default" title="Notificaciones">
              <img src="../svg/notification.png" width="18px">
              <span class="badge badge-danger">7</span>
            </button>
          </li>
          <li class="nav-item">
            <a class="nav-link" type="submit">
            
            <label id="lblNombre"></label>

            </a>
          </li>
          <li class="nav-item">
            <button id="btnSalir" type="button" class="btn btn-default" title="Cerrar sesión">
              <img src="../svg/sign-out-option.png" width="18px">
              <span class="badge badge-secondary"> </span>
            </button>
          </li>
        </ul>
       
        <input id="txtVarUrl" name="txtVarUrl" type="hidden" hidden value="">
        <input id="txtUrl" name="txtUrl" type="hidden" hidden value="">
        <input id="txtSalir" name="txtSalir" type="hidden" hidden value="">
        <input id="txtUsuarioMenu" name="txtUsuarioMenu" type="hidden" hidden
          value="">
        <input id="txtUsuarioidMenu" name="txtUsuarioMenu" type="hidden" hidden value="">
      
        <input id="txtPersonaidMenu" name="txtUsuarioMenu" type="hidden" hidden value="">
      
        <input id="txtUserPadre" name="txtUserPadre" type="hidden" hidden value="">
      

        <button id="btnGo" type="submit" hidden></button>



      </div>
    </div>
  </nav>

  <div id="panelOpcion" class="btn-group-vertical">
    <button id="btnWizard" title="wizard" class="btn_card" type="button">
      <img style="width:20px" src="../svg/settings.png">
    </button>

    <button id="btnMapa" title="Mapa" class="btn_card" type="button">
      <img style="width:20px" src="../svg/planet-earth.png">
    </button>

    <button id="btnQuestion" title="Información" class="btn_card" type="button">
      <img style="width:20px" src="../svg/question.png">
    </button>

  </div>

</form>



<div id="load" class="modal">
  <div class="modal-dialog mx-auto" style="width: 200px;">
    <div class="spinner-grow text-primary" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <div class="spinner-grow text-danger" role="status">
      <span class="sr-only">Loading...</span>
    </div>
    <div class="spinner-grow text-warning" role="status">
      <span class="sr-only">Loading...</span>
    </div>

  </div>
</div>


<script>
  $(function () {

    if (getParameterByName('menu') == "1") {
      $("#menu").attr("style", "height:1")
      $("#menu").addClass("d-none")
      $("#panelOpcion").addClass("d-none")

    }

    if (existe("user")) {
      dataUser(getDataBase("user"))

    } else {
      $("#btnSalir").click()
    }

  })

  $('#load').modal();

  setTimeout(function () {
    $('#load').modal('hide');
  }, 1000);


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