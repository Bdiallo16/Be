<div class="container">
	<form class="form-horizontal" method="post" action="<?php echo Load::link("/Users/Verify") ?>" >
	<div class="row">
		
		<div class="col-md-6 col-md-offset-2 
					col-sm-8 col-sm-offset-2
					col-xs-10 col-xs-offset-1
					uk-margin-top">
			<div class="form-group">
			
				<label class="col-md-4
							col-sm-4
							col-xs-12
							control-label" for="login">Login :</label>
				<div class="col-md-6
							col-sm-6
							col-xs-12">
								<input class="form-control" id="login" type="text" name="login">
				</div>	
			</div>
		</div>
		
	</div>
	
	<div class="row">
	
		<div class="col-md-6 col-md-offset-2
					col-sm-8 col-sm-offset-2
					col-xs-10 col-xs-offset-1
					uk-margin-top">
		<div class="form-group">
				
			<label class="col-md-4
						col-sm-4
						col-xs-12
						control-label" for="password">Password :</label>
			<div class="col-md-6
						col-sm-6
						col-xs-12">
				<input class="form-control" id="password" type="password" name="password">
			</div>
		</div>
		
		</div>
	
	</div>
	<div class="row">
		<div class="col-md-3 col-md-offset-4
					col-sm-4 col-sm-offset-4
					col-xs-6 col-xs-offset-3
					uk-margin-top">
		<button type="submit" class="btn btn-default btn-large" style="width:100%; margin-top:20px;">Se Connecter</button>
		</div>
	</div>
	</form>
	
	
		<?php 
			if(isset($error)){
		?>
			<div class="row uk-margin-top">
				<div class="error-user 
							col-md-8 col-md-offset-2 
							col-sm-10 col-sm-offset-1
							col-xs-10 col-xs-offset-1
							uk-text-center
							alert alert-danger"><?php echo $error ?></div>	
			</div>
		<?php
			}
		?>
	
	
</div>