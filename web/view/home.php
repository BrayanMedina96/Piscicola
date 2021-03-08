<html lang="en">

<head>
  <title>Home</title>
  <meta charset="utf-8">
  <link href="../content/bootstrap.min.css" rel="stylesheet" />
  <script src="../scripts/jquery-3.3.1.min.js"></script>
  <script src="../scripts/Aplicacion/home.js"></script>
  <script src="../scripts/Aplicacion/jsUtilidad.js"></script>
</head>

<body>

  <?php 
    require("../plantilla/menu.php");
  ?>


  <main role="main">


    <div class="jumbotron">
      <div class="container">
        <h1 class="display-3">Bienvenido  </h1>
        <p>
          <em>PISC.NET</em>  This is a template for a simple marketing or informational website. It includes a large callout called a
          jumbotron and three supporting pieces of content. Use it as a starting point to create something more unique.
         
       <!--  <img class="img-rounded" width="30px" src="../svg/pie-chart.png">
         +
         <img class="img-rounded" width="30px" src="../svg/pescado.png">
         +
         <img class="img-rounded" width="30px" src="../svg/investigacion.png">
         +
         <img class="img-rounded" width="30px" src="../svg/ordenador.png">
         =-->
         <img class="img-rounded" width="40px" src="../svg/idea.png">

         </p>

        
      </div>
    </div>

    <div class="container">

      <div class="row">
        <div class="col-md-4">
          <h2>Temperatura</h2>
          <p>
          
          </p>
          
        </div>
        <div class="col-md-4">
          <h2>PH</h2>
          <p>El pH del agua puede variar entr 0 y 14. Cuando el ph de una sustancia es mayor de 7, es una sustancia básica. Cuando el pH de una sustancia está por debajo de 7, es una sustancia ácida
           </p><img class="img-rounded" width="100px" src="../svg/ph.png">
          
        </div>
        <div class="col-md-4">
          <h2>Análisis de Oxígeno Disuelto (OD)</h2>
          <p>Consiste en medir la cantidad de oxígeno que está disuelto en un líquido. Sirve para indicar lo contaminada que está el agua o de lo bien que puede albergar vida vegetal o animal.  Por lo general, niveles altos de oxígeno disuelto indican una mejor calidad. En cambio, si los niveles son muy bajos, será muy difícil la supervivencia de cualquier organismo.</p>
          
        </div>
      </div>

      <hr>

    </div>

  </main>

  <footer class="container">
    <p>© Company 2019</p>
  </footer>

</body>

</html>