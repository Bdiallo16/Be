<div class="container">
    
	<div class="row">
		<h3 class="page-header">Bienvenue <?php echo ($user->nom." ".$user->prenom) ?></h3>
	</div>
	
  
       
         <!--<pre><?php print_r ($user);?></pre>-->
        
	<?php foreach($user->getFormations() as $f){ ?>	
	<div class="row">
		<h2 class="page-header"> <?php echo strtoupper($f->name)." ( ".$f->annee." )" ?></h2>	
		<div class="list-group col-md-8">
		<?php foreach($f->matieres as $m){ ?>
                        
			<a class="list-group-item" href="<?php echo Load::link("/Users/Cours?i=".$m->id); ?>">
                            <?php echo $m->name; ?></a>
	       <?php } ?>
			
		</div>
	</div>
	<?php } ?>	
     
           
	
 
 </div>