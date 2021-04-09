<!-- The Modal -->
<div class="modal fade" id="pnInfo">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <img style="width:18px" src="../svg/question.png">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">


        <div class="row">
          <div class="col-md-12">


            <div class="container">

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" data-toggle="tab" href="#home">Solicitud</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu1">Acerca de</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="tab" href="#menu2">Terminos y condiciones</a>
                </li>
              </ul>

              <!-- Tab panes -->
              <div class="tab-content">
                <div id="home" class="container tab-pane active"><br>
                  <h3>Solicitud</h3>

                  <div class="form-group">
                    <label for="ddlOpcionSolicitud">Nombre</label>
                    <select id="ddlOpcionSolicitud" class="form-control">
                      <option value="">Seleccionar</option>
                      <option value="1">Capacitación</option>
                      <option value="2">Soporte</option>
                      <option value="3">Mejoras/Nuevo desarrollo</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label for="txtDescripcionSolicitud">Descripción</label>
                    <textarea type="" row="2" class="form-control limpiar" id="txtDescripcionSolicitud"></textarea>
                  </div>

                  <div class="form-group">

                    <label for="fileToUploadSolicitud" class="btn btn-info">
                      <img width="20px" src="../svg/file.png" /> Cargar archivo
                      </button>

                      <input type="file" name="fileToUploadSolicitud" id="fileToUploadSolicitud" hidden>
                  </div>

                  <div class="form-group">
                    <button id="btnEnviarSolicitud" class="btn btn-primary" type="button">Guardar</button>
                    <button id="btnLimpiarSolicitud" class="btn btn-secondary" type="button">Limpiar</button>

                  </div>


                </div>
                <div id="menu1" class="container tab-pane fade"><br>
                  <h3>Acerca de</h3>

                </div>
                <div id="menu2" class="container tab-pane fade"><br>
                  <h3>Terminos y condiciones</h3>
                  <embed src="../svg/Términos y condiciones.pdf#toolbar=0&navpanes=0&scrollbar=0" type="application/pdf"
                    width="100%" height="600px" />
                </div>
              </div>
            </div>


          </div>
          <!-- <div class="col-md-3">
            <div class="form-group">
              <div class="card">
                <div class="card-header"></div>
                <div class="card-body">



                </div>

              </div>
            </div>
          </div>-->
        </div>


      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>

    </div>
  </div>
</div>