<div class="container">

	<div class="first row-fluid">
		
		<h3 class="page-header">Edition</h3>
		
		<div class="user-info">
			<form role="form-horizontal">
			<div class="common-info">
			<div class="row">
				<div class="col-sm-6 col-xs-6">
					<label class="col-sm-4 col-xs-6 control-label" for="nom">Nom</label>
					<div class="col-sm-8">	
						<input class="form-control" id="nom" type="text">
					</div>
				</div>
				<div class="col-sm-6 col-xs-6">
					<label class="col-sm-4 col-xs-6 control-label" for="telephone">Tel</label>
					<div class="col-sm-8">
						<input class="form-control" id="telephone" type="tel">
					</div>
				</div>
			</div>
			<div class="row uk-margin-top">
				
				<div class="col-sm-6 col-xs-6">
					<label class="col-sm-4 col-xs-6 control-label" for="prenom">Prenom</label>
					<div class="col-sm-8">	
						<input class="form-control" id="prenom" type="text">
					</div>
				</div>
				<div class="col-sm-6 col-xs-6">
					<label class="col-sm-4 col-xs-6 control-label" for="email">Email</label>
					<div class="col-sm-8">
						<input class="form-control" id="email" type="tel">
					</div>
				</div>
			
			</div>
			</div>
			<hr/>
			<div class="security-info">
				<div class="row-fluid uk-margin-top">
					
					<div class="col-sm-6 col-xs-6">
					<label class="col-sm-4 col-xs-6 control-label" for="login">Login</label>
					<div class="col-sm-8">	
						<input class="form-control" id="login" type="text">
					</div>
				</div>
				<div class="col-sm-6 col-xs-6 col-xs-6">
					<label class="col-sm-4 control-label" for="password">Password</label>
					<div class="col-sm-8">
						<input class="form-control" id="password" type="tel">
					</div>
				</div>
				
				</div>
			</div>
			<div class="row uk-margin-top">
			<div class="col-sm-8 col-sm-offset-2">
			<div class="btn-group btn-group-justified uk-margin-top">
				<div class="btn-group">
					<a href="#" class="btn btn-danger">Modifier</a>
				</div>
				<div class="btn-group">
					<a href="#" class="btn btn-success">Ajouter</a>
				</div>
			</div>
			</div>
			</div>
			</form>
		</div>
	</div>
	
	<div class="first row-fluid">
	<h3 class="page-header">Etudiants</h3>
		<div class="users-table">
		<table class="table table-striped">
			<thead>
					<tr>
						<th class="col-md-4">Prenom</th>
						<th class="col-md-4">Nom</th>
						<th class="col-md-2">Tel</th>
						<th class="col-md-2">Email</th>
					</tr>
				</thead>
		</table>
		<div class="body">
		<table class="table table-striped table-hover table-responsive">
				
				<tbody>
				<?php foreach($users as $u){ ?>
					<tr class="table-row" etu-id="<?php echo $u->id ?>">
						<th class="col-md-4"><?php echo $u->prenom; ?></th>
						<th class="col-md-4"><?php echo $u->nom; ?></th>
						<th class="col-md-2"><?php echo $u->tel; ?></th>
						<th class="col-md-2"><?php echo $u->email; ?></th>
					</tr>
				<?php } ?>
				</tbody>
			</table>
		</div>
		</div>
	</div>



</div>