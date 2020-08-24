<html>

<head>
    <title>Predecir</title>
    <input id="lblTitulo" type="hidden" value="predecir">
    <meta charset="UTF-8">

    <?php 
         require("../plantilla/menu.php");
     ?>


    <script type="text/javascript" src="../Scripts/DataTable/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../Scripts/DataTable/datatables.min.css" />

    <script src='../scripts/Chart.js'></script>
    <script src="../scripts/Aplicacion/jsAjax.js"></script>
    <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
    <script src='../scripts/Aplicacion/jsClassLago.js'></script>
    <script src="../scripts/Aplicacion/jsPrediccion.js"></script>

</head>

<body class="bg-light">

    <hr>
    <div class="py-5 container">
        <div class="row">


            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h5>Predicción</h5>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            
                           <select id="ddlLago" class="form-control"></select>

                            <a  id="btnBuscar" id="btnBuscar" type="button" class="btn btn-default">
                                <img src="../svg/lupa.png" width="30px">
                            </a>

                       </div>
                        <canvas id="myChart">
                            <p>Hello Fallback World</p>
                        </canvas>
                        <hr>
                        <table id="Tabla" class="table table-bordered table-striped" style="display:none;">
                            <thead>
                                <tr id="tbEncabezado">
                            

                                </tr>
                            </thead>
                            <tbody id="tdResultado"></tbody>
                        </table>


                    </div>
                </div>

            </div>



            <div class="col-md-3">

                <div class="list-group">
                    <a  class="list-group-item list-group-item-action opcion">
                        <label>info</label>
                    </a>

                </div>

            </div>

        </div>
    </div>

    <div id="pnMensaje"></div>

    <input type="text" id="txtTipo" value="" hidden />
    <input type="text" id="txtImportar" value="0" hidden />
    <input type="text" id="txtGrafica" value="" hidden />



</body>
<?php 
require("../plantilla/pie.php");
?>

</html>
