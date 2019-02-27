<?php
    $id_usuario=$this->session->userdata('id_usuario');
     
    if(!$id_usuario){
      redirect('Login');
    }
?>
<div class="flex-row">
    <h2>Verificar Identidad del Cliente</h2>
    <div class="col-lg-12 veinte_m_t">
        <form id="formValidarCliente" name="formValidarCliente" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-6">
                    <div class="col-sm-12 text-center mb-3">
                        <img id="imgF" width="400px" height="250px" hidden>
                        <i id="iconoCameraF" data-feather="camera" style="width: 200px; height: 200px;"></i>
                    </div>
                    <div class="col-sm-12 text-center mb-3">
                        <button id="guardarF" class="btn btn-primary pull-right tomar_foto" type="button" style="width: 330px;">Tomar foto Cedula de Identidad Superior</button>
                        <canvas id="canvasF" style="display: none;"></canvas>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="col-sm-12 text-center mb-3">
                        <img id="imgB" width="400px" height="250px" hidden>
                        <i id="iconoCameraB" data-feather="camera" style="width: 200px; height: 200px;"></i>
                    </div>
                    <div class="col-sm-12 text-center mb-3">
                        <button id="guardarB" class="btn btn-primary pull-right tomar_foto" type="button" style="width: 330px;">Tomar foto Cedula de Identidad Inferior</button>
                        <canvas id="canvasB" style="display: none;"></canvas>
                    </div>
                </div>

                <div class="col-sm-12 text-center mt-3">
                    <div class="col-sm-12 text-center mb-3">
                        <img id="imgS" width="400px" height="250px" hidden>
                        <i id="iconoCameraS" data-feather="camera" style="width: 200px; height: 200px;"></i>
                    </div>
                    <div class="col-sm-12 text-center mb-3">
                        <button id="guardarS" class="btn btn-primary pull-right tomar_foto" type="button" style="width: 330px;">Tomar foto Selfie</button>
                        <canvas id="canvasS" style="display: none;"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-lg-10 text-right">
                <button id="guardar" type="submit" class="btn btn-primary pull-right">Enviar</button>
            </div>
        </form>
    </div>
</div>


<div id="loader" class="loader" hidden></div>

<!-- Modal Mensaje -->
<div id="modalCamara" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloMC"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <video id="videoModal" width="600" height="300"></video>
        <canvas id="canvasModal" style="display: none;"></canvas>
        <p id="parrafoMC"></p>
      </div>
      <div class="modal-footer">
        <button id="btnRepetir" type="button" class="btn btn-primary">Repetir</button>
        <button id="btnCapturar" type="button" class="btn btn-primary">Capturar</button>
        <button id="btnGuardar" type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>