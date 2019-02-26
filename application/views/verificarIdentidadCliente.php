<?php
	$id_usuario=$this->session->userdata('id_usuario');
	 
	if(!$id_usuario){
	  redirect('Login');
	}
?>

<div class="flex-row">
	<h2>Verificar Identidad del Cliente</h2>
	<div class="col-lg-12 veinte_m_t">
        <form id="formValidarCliente" name="formValidarCliente" method="get" enctype="multipart/form-data">
            <div class="col-lg-6">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="validatedCustomFile" required>
                    <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                    <div class="invalid-feedback">Example invalid custom file feedback</div>
                  </div>

                <div class="form-group">
                    <label class="label-form" for="nombre">Nombre perfil</label>
                    <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Ingresa nombre perfil">
                </div>
                <div class="form-group">
                    <label class="label-form" for="caracteristicas">Caracter&iacute;sticas</label>
                    <textarea class="form-control form-control-sm" rows="3" id="caracteristicas" name="caracteristicas" placeholder="Ingresa una característica"></textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <button id="guardar" type="submit" class="btn btn-primary pull-right">Guardar</button>
            </div>
        </form>
    </div>
</div>
