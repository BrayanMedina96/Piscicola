<html>

<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">

    <?php 
         require("../plantilla/menu.php");
     ?>

    <script src="../Scripts/datepicker.min.js" type="text/javascript"></script>
    <link href="../Content/datepicker.min.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="../Scripts/DataTable/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../Scripts/DataTable/datatables.min.css" />

    <script src='../scripts/Chart.js'></script>
    <script src="../scripts/Aplicacion/jsAjax.js"></script>
    <script src='../scripts/Aplicacion/jsUtilidad.js'></script>
    <script src='../scripts/Aplicacion/jsClassDashboard.js'></script>
    <script src='../scripts/Aplicacion/jsDashboard.js'></script>


</head>

<body class="bg-light">

    <hr>
    <div class="py-5 container">
        <div class="row">


            <div class="col-md-9">

                <div class="card">
                    <div class="card-header">
                        <h5>Dashboard</h5>
                    </div>
                    <div class="card-body">

                        <div class="input-group mb-3">

                            <div class="input-group-append">
                                <span class="input-group-text">

                                </span>
                            </div>
                            <input id="txtFechaInicial" class="form-control obligatorio" type="text"
                                placeholder="Fecha inicial" />


                            <div class="input-group-append">
                                <span class="input-group-text">

                                </span>
                            </div>
                            <input id="txtFechaFinal" type="text" class="form-control obligatorio"
                                placeholder="Fecha final" />


                        </div>
                        <div class="form-group">

                            <a  id="btnBuscar" id="btnBuscar" type="button" class="btn btn-default">
                                <img src="../svg/lupa.png" width="30px">Consultar
                            </a>

                            <a download="laimagen.jpg" onclick="download_img(this);" id="btnExportar" type="button"
                                class="btn btn-default">
                                <img src="../svg/participacion.png" width="30px">Exportar grafica
                            </a>

                            <a href="" id="a" type="button" class="btn btn-default">
                                <img src="../svg/participacion.png" width="30px">Exportar datos
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
                    <a id="btnCrear" class="list-group-item list-group-item-action opcion">
                        <img width="24px" src="../svg/pen.png" /> Crear
                    </a>

                    <div id="miCreacion" style="height:400px;overflow: auto;" >

                    </div>

                </div>

            </div>

        </div>
    </div>

    <div id="pnMensaje"></div>

    <div class="modal" id="modal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Mis dashboard</h5>
                    <button id="btnCerrarModal" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ddlTipoGrafica">Tipo grafica</label>
                            <select id="ddlTipoGrafica" class="form-control">
                                <option value="line">Linea</option>
                                <option value="bar">Barra</option>
                            </select>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="txtNombre">Nombre</label>
                            <input type="text" class="form-control limpiar" id="txtNombre" maxlength="50" required>
                        </div>

                    </div>

                    <!-- <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="ddlVariableX">Filtro</label>
                            <div class="input-group">
                                <select id="ddlFiltro" class="form-control"></select>
                                <div id="btnFiltro" class="input-group-append">
                                    <span class=" btn btn-success">+</span>
                                </div>
                            </div>
                            <br>
                            <div id="filtro"></div>
                        </div>
                    </div>-->

                    <div class="row">


                        <div class="col-md-6 mb-3">

                            <label for="ddlVariableX">Variable en X</label>


                            <div class="input-group">
                                <select id="ddlVariableX" class="form-control"></select>
                                <div id="btnAgregar" class="input-group-append">
                                    <span class=" btn btn-success">+</span>
                                </div>
                            </div>
                            <br>
                            <div id="variableX"></div>

                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="ddlVariableY">Variable en Y</label>

                            <div class="input-group">
                                <select id="ddlVariableY" class="form-control"></select>
                                <div id="btnAgregarY" class="input-group-append">
                                    <span class=" btn btn-success">+</span>
                                </div>
                            </div>
                            <br>
                            <div id="variableY"></div>

                        </div>



                    </div>
                    <div class="form-group">
                        <button id="btnEnviar" class="btn btn-primary" type="button">Guardar</button>

                    </div>


                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <input type="text" id="txtTipo" value="" hidden />
    <input type="text" id="txtImportar" value="0" hidden />
    <input type="text" id="txtGrafica" value="" hidden />



</body>

</html>
