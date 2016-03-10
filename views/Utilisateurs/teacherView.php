<div class="container">
	<div class="row">
        <h3 class="page-header">Bienvenue <?php echo (ucfirst($user->prenom)." ".ucfirst($user->nom)) ?></h3>
	</div>
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#">Vos Cours</a></li>
		</ol>
	</div>
    
    
	<?php 
	
		$annee = 0;
		foreach($user->getFormations() as $f){ 
			
	?>
	<div class="row">
		<?php if($annee != $f->annee): ?>
		<h1 class="page-header"><?php echo $f->annee; ?></h1>
		<?php endif ?>
		
		<h3 class="page-header"> <?php echo strtoupper($f->name) ?></h3>	
		<div class="list-group col-md-8">
		<?php foreach($f->matieres as $m){ ?>
			<a class="list-group-item" href="<?php echo Load::link("/Users/Cours?i=".$m->id); ?>">
			<?php echo $m->name; ?></a>
			<?php } ?>
			
		</div>
	</div>
		
		<?php } ?>
		
		<?php if(empty($user->getFormations())){ ?>
		<div class="row">
			<div class="alert alert-info">	
				Vous n'avez pas de cours
			</div>
		</div>
	<?php	} ?>
		
	
</div>