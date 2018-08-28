<?php
	//$id_usuario=$this->session->userdata('id_usuario');
	 
	/*if(!$id_usuario){
	  redirect('Login');
	}*/
?>

<div class="row justify-content-center">
	<!--Hola <?php //if(isset($u_nombres)) { echo $u_nombres; } ?> <?php //if(isset($u_apellidos)) { echo $u_apellidos; } ?>,este es el inicio.-->
	<div id="filtros" class="col-sm-10 mt-3">
		<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
			</ol>
			<div class="carousel-inner">
				<div class="carousel-item active">
					<img class="d-block w-100" src="https://picsum.photos/800/400?image=972" alt="Primera imagen">
					<div class="carousel-caption d-none d-md-block">
						<h5>Primera Imagen</h5>
						<p>Descripci&oacute;n de primera imagen.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="https://picsum.photos/800/400?image=898" alt="Segunda imagen">
					<div class="carousel-caption d-none d-md-block">
						<h5>Segunda Imagen</h5>
						<p>Descripci&oacute;n de segunda imagen.</p>
					</div>
				</div>
				<div class="carousel-item">
					<img class="d-block w-100" src="https://picsum.photos/800/400?image=864" alt="Tercera imagen">
					<div class="carousel-caption d-none d-md-block">
						<h5>Tercera Imagen</h5>
						<p>Descripci&oacute;n de tercera imagen.</p>
					</div>
				</div>
			</div>
			<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
			</a>
			<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
			</a>
		</div>

		<div class="accordion" id="accordionExample">
		  <div class="card">
		    <div class="card-header" id="headingSS">
		      <h5 class="mb-0">
		        <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
		          ¿Que es un sistema de Gesti&oacute;n de Calidad?
		        </button>
		      </h5>
		    </div>
		    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
		      <div class="card-body">
		        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
		      </div>
		    </div>
		  </div>
		  <div class="accordion" id="accordionExample">
		  <div class="card">
		    <div class="card-header" id="headingTwo">
		      <h5 class="mb-0">
		        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
		          ¿Que son las campañas?
		        </button>
		      </h5>
		    </div>
		    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
		      <div class="card-body">
		        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
		      </div>
		    </div>
		  </div>
		  <div class="card">
		    <div class="card-header" id="headingThree">
		      <h5 class="mb-0">
		        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
		          ¿Cuales son mis principales funcionalidades dentro del sistema?
		        </button>
		      </h5>
		    </div>
		    <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
		      <div class="card-body">
		        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
		      </div>
		    </div>
		  </div>
		</div>
	</div>
	<!--
	<div id="tDatos" class="col-sm-12 m-3">
		<div class="table-responsive">
			<table class="table table-sm table-hover ">
			  <thead>
			    <tr>
			      <th scope="col">ID EAC</th>
			      <th scope="col">Nombre EAC</th>
			      <th scope="col">Prechequeo</th>
			      <th scope="col">Pre - Pre</th>
			      <th scope="col">Pre - Post</th>
			      <th scope="col">Post - Post</th>
			      <th scope="col">Migracion</th>
			      <th scope="col">Venta</th>
			    </tr>
			  </thead>
			  <tbody>
				<tr>
			        <th scope="">1017</th>
			        <td>Ximena Roque</td>
			        <td><a href="Evaluacion" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1030</th>
			        <td>Cristian Arce</td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1036</th>
			        <td>Cynthia Castro</td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1039</th>
			        <td>Maria Diaz</td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1040</th>
			        <td>Patricia Ipinza</td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1041</th>
			        <td>Leslye Vera</td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1045</th>
			        <td>Margarita Garcia</td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1046</th>
			        <td>Maria Gutierrez</td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-danger">0   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1050</th>
			        <td>Juana Bugueo</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1056</th>
			        <td>Brando Morales</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1071</th>
			        <td>Matias Hermosilla</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1089</th>
			        <td>Miguel Caceres</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1091</th>
			        <td>Edgard Concha</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1097</th>
			        <td>Juan Lagos</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#" class="badge badge-pill badge-warning">1   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1101</th>
			        <td>Pablo Novoa</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1103</th>
			        <td>Victoria Sanchez</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1105</th>
			        <td>Felipe Freire</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1112</th>
			        <td>Karla Molina</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1134</th>
			        <td>Heidy Bonaga</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1135</th>
			        <td>Macarena Venegas</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1145</th>
			        <td>Pamela carreo</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1157</th>
			        <td>Alexya Villarreal</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1168</th>
			        <td>Judith Gomez</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1170</th>
			        <td>Elizabeth Donoso</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1171</th>
			        <td>Maria Sotomayor</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1172</th>
			        <td>Rosario Flores</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1202</th>
			        <td>Claudia Cid</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1206</th>
			        <td>Mirella Orellana</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1221</th>
			        <td>Matias Porma</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1223</th>
			        <td>Camila Lagos</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1234</th>
			        <td>Francesca Aravena</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1242</th>
			        <td>Leslie Sullca</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1245</th>
			        <td>Cecilia Rios</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1246</th>
			        <td>Felipe Bustos</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1269</th>
			        <td>Rawin Duran</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1270</th>
			        <td>Cristell Garcia</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1272</th>
			        <td>Astrid Flores</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1288</th>
			        <td>Lisett Hormazbal</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1289</th>
			        <td>Esteban Huerta</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1294</th>
			        <td>Vannia Chehuaicura</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1303</th>
			        <td>Daniela Silva</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1310</th>
			        <td>Natalia Diaz</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1311</th>
			        <td>Margarita Cordova</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1322</th>
			        <td>Guillermo Sepulveda</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1328</th>
			        <td>Daniela Contreras</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1344</th>
			        <td>Matias Cuevas</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1350</th>
			        <td>Lorena Araneda</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1351</th>
			        <td>Fernanda Jeria</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1358</th>
			        <td>Nicole Zambrano</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1370</th>
			        <td>Bexy Sullca</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1371</th>
			        <td>Yeniffer Uribe</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1376</th>
			        <td>Elizabeth Arenas</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1384</th>
			        <td>Jocelyn Gamin</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1388</th>
			        <td>Luciana Palavicino</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1389</th>
			        <td>Katerine Cornejo</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1390</th>
			        <td>Valentina Aravena</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1411</th>
			        <td>Cristhine Varas</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1421</th>
			        <td>Polette Vega</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1424</th>
			        <td>Javiera Olmedo</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1431</th>
			        <td>Catalina Espinoza</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1437</th>
			        <td>Erick Palacios</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1438</th>
			        <td>Esmeralda Uren</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1439</th>
			        <td>Rachel Cornejo</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1440</th>
			        <td>Liz Chuquispuma</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">1441</th>
			        <td>Camila Venegas</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">9000</th>
			        <td>Arturo Rejas</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
				<tr>
			        <th scope="">9001</th>
			        <td>Julio Morales</td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">2   /   2</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			        <td><a href="#"  class="badge badge-pill badge-success">1   /   1</a></td>
			    </tr>
			  </tbody>
			</table>
		</div>
	</div>-->
</div>