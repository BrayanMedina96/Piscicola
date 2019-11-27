<html>

<head>
    <title>Dashboard</title>
    <meta charset="UTF-8">

    <?php 
         require("../plantilla/menu.php");
     ?>

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

                       <div class="form-group">
                            
                            <a download="laimagen.jpg" onclick="download_img(this);" id="btnExportar" type="button" class="btn btn-default">
                                <img src="../svg/participacion.png" width="30px">Grafica
                            </a>

                        </div>
 
                        <canvas id="myChart">
                            <p>Hello Fallback World</p>
                        </canvas>

                        

                    </div>
                </div>

            </div>



            <div class="col-md-3">

                <div class="list-group">
                    <a id="btnCrear" class="list-group-item list-group-item-action opcion">
                        <img width="24px" src="../svg/pen.png" /> Crear
                    </a>

                    <div id="miCreacion">

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

                    <div class="row">
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
                    </div>

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
    <img src="" id="laimagen"/>
    <a id="download" download="laimagen.jpg" href="" onclick="download_img(this);">ok</a>
</body>

</html>

<!--
<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<title>Exportar Canvas a Imagen</title>
</head>
<body>
<h1>Exportar Canvas a Imagen</h1>

<p style="text-align:center;"><canvas height="300px" width="300px" id="micanvas">
Su navegador no soporta en elemento CANVAS</canvas></p>


<fieldset><legend>Pulsa sobre el tipo de imagen y el resultado se generará abajo</legend>
<button id="png">Guardar Imagen en PNG</button> | <button id="jpeg">Guardar Imagen en JPEG</button><br/> 
</fieldset>

<img src="" id="laimagen"/>

<script>
var canvas = document.getElementById("micanvas");
var ctx = canvas.getContext("2d");

// Dibujamos algo sencillo en el Canvas para exportarlo
ctx.fillStyle = "rgb(255,0,0)";
ctx.fillRect(20,20,100,100);

ctx.fillStyle = "rgb(0,255,0)";
ctx.fillRect(60,60,140,140);

ctx.fillStyle = "rgb(0,0,255)";
ctx.fillRect(100,100,180,180);


var img = document.getElementById("laimagen");

var png = document.getElementById("png");
png.addEventListener("click",function(){	
	var dato = canvas.toDataURL("image/png");
	dato = dato.replace("image/png", "image/octet-stream");
	document.location.href = dato;		
},false);



var jpeg = document.getElementById("jpeg");
jpeg.addEventListener("click",function(){	
	var dato = canvas.toDataURL("image/jpeg");
	dato = dato.replace("image/jpeg", "image/octet-stream");
	document.location.href = dato;	
},false);

</script>


<br><br>
<hr>
Art&iacute;culo disponible en: <a href="http://lineadecodigo.com/html5/descargar-un-canvas-a-una-imagen-con-html5/">http://lineadecodigo.com/html5/descargar-un-canvas-a-una-imagen-con-html5/</a><br/>
<a href="http://lineadecodigo.com" title="Linea de Codigo">lineadecodigo.com</a>

</body>
</html>
-->