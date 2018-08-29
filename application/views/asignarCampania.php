<div class="col-sm-12 mt-3">
  <div class="row"> 
    
      <div class="col-sm-6">
        <form class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Seleccione Usuario</label>
          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
           <?php 
                if(isset($usuarios))
                {
                  echo '<option selected>Seleccione un Usuario</option>';
                  foreach ($usuarios as $usu) {
                    echo '<option value="1">'.$usu['NOMBRE_USU'].'</option>';
                  }
                }
              ?>
          </select>
          <button type="submit" class="btn btn-primary my-1">Cargar</button>
        </form>
      </div>
      <div class="col-sm-6">
        <form class="form-inline">
          <label class="my-1 mr-2" for="inlineFormCustomSelectPref">Campa&ntilde;as</label>
          <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
            <?php 
                if(isset($campanias))
                {
                  echo '<option selected>Seleccione una Campania</option>';
                  foreach ($campanias as $camp) {
                    echo '<option value="1">'.$camp['C_NOMBRE'].'</option>';
                  }
                }
              ?>
          </select>
          <button type="submit" class="btn btn-primary my-1">Agregar</button>
        </form>
      </div>
  </div>

  <div class="row"> 
    <table class="table table-sm table-hover mt-5">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Campania</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">1</th>
                <td>Janina</td>
                <td>Hernandez</td>
                <td>Pre - Pre</td>
              </tr>
              <tr>
                <th scope="row">2</th>
               <td>Janina</td>
                <td>Hernandez</td>
                <td>Pre - Post</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Janina</td>
                <td>Hernandez</td>
                <td>Post - Post</td>
              </tr>
              <tr>
                <th scope="row">1</th>
                <td>Susana</td>
                <td>Cancino</td>
                <td>Pre - Pre</td>
              </tr>
              <tr>
                <th scope="row">2</th>
               <td>Susana</td>
                <td>Cancino</td>
                <td>Pre - Post</td>
              </tr>
              <tr>
                <th scope="row">3</th>
                <td>Susana</td>
                <td>Cancino</td>
                <td>Post - Post</td>
              </tr>
            </tbody>
          </table>
  </div>
</div>
