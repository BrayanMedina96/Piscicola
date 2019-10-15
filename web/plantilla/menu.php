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
          <a  class="nav-link go" go="../view/home.php">PIS.NET</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link go" go="../view/cuenta.php">Mi cuenta<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <button class="nav-link" type="submit" href="#">Link</button>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Disabled</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="dropdown01" data-toggle="dropdown" aria-haspopup="true"
            aria-expanded="false">Dropdown</a>
          <div class="dropdown-menu" aria-labelledby="dropdown01">
            <a class="dropdown-item" href="#">Action</a>
            <a class="dropdown-item" href="#">Another action</a>
            <a class="dropdown-item" href="#">Something else here</a>
          </div>
        </li>
      </ul>
      <div class="form-inline my-2 my-lg-0 ">

        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <button type="button" class="btn btn-default" title="Notificaciones">
              <img src="../svg/notification.png" width="18px">
              <span class="badge badge-danger">7</span>
            </button>
          </li>
          <li class="nav-item">
            <a class="nav-link" type="submit">
              <?php 
              $obj=new Base64();
              $result=$obj->decodeUsuario();
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
    $(".go").click(function (e) 
    {
     
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
