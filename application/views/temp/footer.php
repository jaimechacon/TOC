		</div>
	<!--	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
<!--		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<!--		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
<!--		<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>-->
<!--	    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<!--<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>-->

		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>

		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

		<script src="<?php echo base_url();?>assets/scripts/index.js"></script>
		<?php 
			if(isset($controller) && !is_null($controller))
				echo '<script src="'.base_url().'assets/scripts/'.$controller.'.js"></script>';
		?>
	    <!--<script src="<?php //echo base_url();?>assets/plugins/metisMenu/jquery.metisMenu.js"></script>-->
	    <script src="https://unpkg.com/feather-icons@4.7.3/dist/feather.js"></script>
	    <script src="https://unpkg.com/feather-icons@4.7.3/dist/feather.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/additional-methods.min.js"></script>
		<!--<script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>-->
		<script type="text/javascript" src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
		<!--<script src="https://maps.googleapis.com/maps/api/js?v=3&sensor=false﻿.exp&signed_in=true"></script>-->
		
		<script src="assets/plugins/jquery-1.10.2.js"></script>
    	<script src="assets/plugins/bootstrap/bootstrap.min.js"></script>
    	<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCtY8tV0XtBG7Upffn-fPUZB73Tlqu3d1c&callback=initMap"></script>
    	<script src="assets/plugins/metisMenu/jquery.metisMenu.js"></script>
	    <script src="assets/plugins/pace/pace.js"></script>
	    <script src="assets/scripts/siminta.js"></script>
	    <!-- Page-Level Plugin Scripts-->
	    <script src="assets/plugins/morris/raphael-2.1.0.min.js"></script>
	    <script src="assets/plugins/morris/morris.js"></script>
	    <script src="assets/scripts/dashboard-demo.js"></script>


	</body>
</html>