<div class="container">

		<div class="jumbotron">
            <h1 class="uk-text-center">Bienvenue <?php echo ucfirst($user->prenom)." ".ucfirst($user->nom) ?></h1>
			<br/>
			<p class="uk-text-center">Vous êtes dans votre espace administrateur</p>
						
		</div>
		
		
		<div class="row">
			
			<h2 class="page-header">Getting Started</h2>
			
		</div>
		<div class="row">
			<div class="btn-group btn-group-justified">
				<div class="btn-group">
					<a href="<?php echo Load::link("/Admin/Enseignants"); ?>" class="btn btn-default">Ajouter un enseignant</a>
				</div>
				<div class="btn-group">
					<a href="<?php echo Load::link("/Admin/Etudiants"); ?>" class="btn btn-default">Ajouter un étudiant</a>
				</div>
			</div>
		</div>

</div>