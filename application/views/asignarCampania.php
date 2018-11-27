<?php
  $id_usuario=$this->session->userdata('id_usuario');
  if(!$id_usuario){
    redirect('Login');
  }
?>

<div class="row">
  <div id="filtros" class="col-sm-12 mt-3">   
    <div class="row mb-1 text-center">
      <div class="col-sm-4">
        <div class="row">
          <div class="col-sm-4">
            <span>Analistas</span>
          </div>
          <div class="col-sm-8">
            <select id="selectAnalistas" class="custom-select custom-select-sm selectFiltros">
                <option value="-1">Seleccione un Analista</option>
              <?php
              if($analistas)
              {
                foreach ($analistas as $analista) {
                  echo '<option value="'.$analista['id_usuario'].'">'.$analista['nombre_completo'].'</option>';
                }
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="row">
          <div class="col-sm-4">
            <span class="">Campa&ntilde;as</span>
          </div>
          <div class="col-sm-6">
            <select id="selectCampanias" class="custom-select custom-select-sm selectFiltros">
                <option value="-1">Seleccione una Campa&ntilde;a</option>
              <?php
              if($campanias)
              {
                foreach ($campanias as $campania) {
                  echo '<option value="'.$campania['id_campania'].'">'.$campania['c_nombre'].'</option>';
                }
              }
              ?>
            </select>
          </div>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="row">
          <div class="col-sm-4">
            <span >Equipos</span>
          </div>
          <div class="col-sm-6">
            <select id="selectEquipos" class="custom-select custom-select-sm selectFiltros">
              <option value="-1">Seleccione un Equipo</option>
              <?php
              if($equipos)
              {
                foreach ($equipos as $equipo) {
                  echo '<option value="'.$equipo['id_equipo'].'">'.$equipo['nombre'].'</option>';
                }
              }
              ?>
              ?>
            </select>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="divModificar" class="col-sm-12 mt-2">
    <div class="row">
      <div class="col-sm-12 text-right pr-5">
         <button id="btnAgregar" type="button" class="btn btn-success">Agregar</button>
      </div>         
    </div>
  </div>
  <div id="tDatos" class="col-sm-12 p-3">
    <div class="table-responsive">
      <table class="table table-sm table-hover">
        <thead>
          <tr>
            <th scope="col" class="text-center align-middle registro"># ID</th>           
            <th scope="col" class="text-center align-middle registro">Nombre</th>
            <th scope="col" class="text-center align-middle registro">Campa&ntilde;a</th>
            <th scope="col" class="text-center align-middle registro">Equipo</th>
            <th scope="col" class="text-center align-middle registro"></th>
          </tr>
        </thead>
        <tbody id="tbodyUsuCampEqui">
              <?php foreach ($campanasUsuariosEquipos as $campUsuEqui): ?>
              <tr>
                  <th scope="row" class="text-center align-middle registro"><?php echo $campUsuEqui['id_usuario']; ?></th>
                  <td class="text-center align-middle registro"><?php echo $campUsuEqui['nombre_completo']; ?></td>
                  <td class="text-center align-middle registro"><?php echo $campUsuEqui['c_nombre']; ?></td>
                  <td class="text-center align-middle registro"><?php echo $campUsuEqui['eq_nombre']; ?></td>
                  <td class="text-right align-middle registro">
                    <a id="trash_<?php echo $campUsuEqui['id_usuario_campania']; ?>" class="trash" href="#" data-id="<?php echo $campUsuEqui['id_usuario_campania']; ?>" data-nombreAnalista="<?php echo $campUsuEqui['nombre_completo']; ?>" data-nombreCampania="<?php echo $campUsuEqui['c_nombre']; ?>" data-nombreEquipo="<?php echo $campUsuEqui['eq_nombre']; ?>" data-toggle="modal" data-target="#modalEliminarUsuCampEqui">
                      <i data-feather="trash-2" data-toggle="tooltip" data-placement="top" title="eliminar"></i>                      
                    </a>
                  </td>
              </tr>
            <?php endforeach ?>
        </tbody>
      </table>
    </div>
  </div>
  
</div>

<!-- Modal Eliminar -->
  <div class="modal fade" id="modalEliminarUsuCampEqui" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <i class="plusTituloError mb-2" data-feather="trash-2"></i>
          <h5 class="modal-title" id="tituloEUCE" name="tituloEUCE" data-idequipo="" data-nombreequipo="" ></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
      <p id="parrafoEUCE"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
          <button id="eliminarUsuCampEqui" type="button" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </div>
  </div>

  <div id="loader" class="loader" hidden></div>

<!-- Modal Mensaje -->
<div class="modal fade" id="modalMensajeUsuCampEqui" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloMUCE"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p id="parrafoMUCE"></p>
      </div>
      <div class="modal-footer">
        <button id="btnCerrarMUCE" type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>