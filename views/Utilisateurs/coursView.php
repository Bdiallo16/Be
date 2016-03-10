<div class="container">
	<div class="row">
		<h3 class="page-header">Bienvenue <?php echo ucfirst($user->prenom)." ".ucfirst($user->nom) ;?></h3>
	</div>
	<div class="row">
		<ol class="breadcrumb">
			
				<?php if($formation){ ?>
				<li><a href="<?php echo Load::link("/Users"); ?>"><?php echo strtoupper($formation->getName()) ?></a></li>
				<li><a><?php echo $formation->getAnnee()?></a></li>
				<li><a href="<?php echo Load::link("/Users/Cours?i=".$matiere->id) ?>"><?php echo $matiere->getName() ?></a></li>
				<?php }else{ ?>
					<li><a href="<?php echo Load::link("/Users"); ?>">Accueil</a></li>
				<?php } ?></a>
			 </li>
			
		</ol>
	</div>
	<div class="row">
	
	<?php if($matiere) { ?>
	
		<h2 class="page-header"><?php echo $matiere->getName() ?>
		<?php if($enseignant){ ?>
		<a data-toggle="tooltip" data-placement="right" title="Editer" class="uk-margin-left btn btn-danger" href="<?php echo Load::link("/Users/Cours/Edit?i=".$matiere->id) ?>"><span class="glyphicon glyphicon-pencil"></span></a> <?php } ?> </h2>	
		<div class="well well-lg">
		
            
            <?php foreach($matiere->getDevoirs() as $devoir){ ?>
            
			<div class="panel panel-primary">
				<div class="panel-heading"><?php echo $devoir->getName() ?></div>
				<div class="panel-body">
					<!--<div>
						<p class="lead">blabla</p>
					</div>-->
					<div class="list-group col-md-8">
						<?php foreach($devoir->getFichiersAttendus() as $file){ ?>
                        <a class="list-group-item" href="<?php echo Load::link("/Users/Cours/".$file->id); ?>"><?php echo $file->getName() ?></a>
                        <?php } ?>
					</div>
				</div>
			</div>
			
            <?php } ?>
			
			
			
		</div>
        
        <?php } else { ?>
        <div class="alert alert-danger">
            Oops, Le cours n'existe pas ou n'existe plus...
        </div>
        
       <?php  } ?>
	</div>
</div>