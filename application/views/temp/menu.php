<?php
?>

<body>
	<div class="container">
		<div id="menu">
			<nav class="navbar navbar-expand-lg navbar-light bg-light pt-0 pb-0">
				<a class="navbar-brand" href="<?php echo base_url();?>Inicio">
					<img src="<?php echo base_url();?>assets/img/logo.png" width="50" class="d-inline-block align-top" alt="">
				</a>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav mr-auto">

				    	<?php
				    	
				    	foreach ($u_menu as $menu) {
							if(isset($menu['cant_submenu']) && count($menu['sub_menu']) == 0)
							{
						?>
							<li class="nav-item active">
								<a class="nav-link" href="<?php echo base_url().$menu['me_url'];?>"><?php echo $menu['me_nombre'];?><span class="sr-only">(current)</span></a>
							</li>
						<?php
							}
							elseif (isset($menu['cant_submenu']) && count($menu['sub_menu']) > 0) {
							?>
								<li class="nav-item dropdown">
									<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?php echo $menu['me_nombre'];?>
									</a>
									<div class="dropdown-menu" aria-labelledby="navbarDropdown">
										<?php
				    	
				    	foreach ($menu['sub_menu'] as $item) {
							
						?>
										<a class="dropdown-item" href="<?php echo base_url().$item['me_url'];?>"><?php echo $item['me_nombre'];?></a>
										<?php
						}
						?>
									</div>
								</li>
							<?php	
							}
						}
						?>
					</ul>
					<!--<form class="form-inline my-2 my-lg-0">
						<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
					</form>-->
					<ul class="navbar-nav my-sm-2 my-sm-0">
						<li class="nav-item">
							<a class="nav-link" href="<?php echo base_url();?>Login">Cerrar Sesi&oacute;n</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
