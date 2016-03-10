<!- Header ->

<nav id="header" class="navbar navbar-default navbar-fixed-top" data-uk-sticky role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a href="#offcanvas-menu" class="navbar-toggle" data-uk-offcanvas >
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>
      <a class="navbar-brand" href="<?php echo Load::link("/Accueil") ?>">BE Project</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
  
       <?php 
       if($is_logged){ 
	       if($etudiant || $enseignant){
       ?> 
        
        	<li><a href="<?php echo Load::link("/Users"); ?>">Mes Cours</a></li> <!- Etudiants & Enseignant ->
        <?php 	if($enseignant){ ?>
        			<li><a href="<?php echo Load::link("/Users/Cours/Create"); ?>">Créer un cours</a></li> <!- Enseignant ->
        <?php 
        		}
        		if($etudiant){
        ?>
        			<li><a href="<?php echo Load::link("/Users/MyNotes"); ?>">Mes Notes</a></li> <!- Etudiants ->
        <?php 
        		}
        		if($enseignant){ ?>
			        <li><a href="<?php echo Load::link("/Users/Notes"); ?>">Notes</a></li> <!- Enseignant ->
			        <li><a href="<?php echo Load::link("/Users/Evaluation"); ?>">Evaluer</a></li> <!- Enseignant ->			        
        <?php 
        		}
        	}
        	if($admin){ ?>
        <li><a href="<?php echo Load::link("/Admin/Enseignants"); ?>">Enseignants</a></li> <!- Admin -> 
        <li><a href="<?php echo Load::link("/Admin/Etudiants");?>">Etudiants</a></li> <!- Admin ->
        
        <?php
        	} 
	       }
        ?> 
      </ul>
      <ul class="nav navbar-nav navbar-right">
      	<?php if($is_logged ){?>
        <li><a href="<?php echo Load::link("/Logout"); ?>"><i class="uk-icon-sign-out"></i> Quitter</a></li>
		<?php }
		else{ ?>
		<li><a href="<?php echo Load::link("/Login"); ?>"><i class="uk-icon-sign-in"></i> Se Connecter</a></li>
		<?php } ?>
		
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div id="offcanvas-menu" class="uk-offcanvas">
	<div class="uk-offcanvas-bar uk-offcanvas-bar-flip">
		<ul class="uk-nav uk-nav-offcanvas" data-uk-nav="" >			
			<li><a href="<?php echo Load::link("/Accueil") ;?>"><i class="uk-icon-home"></i> Accueil</a></li>
	       <?php 
	       if($is_logged){ 
		       if($etudiant || $enseignant){
	       ?> 
	       	<li><a href="<?php echo Load::link("/Users"); ?>">Mes Cours</a></li> <!- Etudiants & Enseignant ->
			<?php 	if($enseignant){ ?>
						<li><a href="<?php echo Load::link("/Users/Cours/Create"); ?>">Créer un cours</a></li> <!- Enseignant ->
			<?php 
					}
					if($etudiant){
			?>
						<li><a href="<?php echo Load::link("/Users/MyNotes"); ?>">Mes Notes</a></li> <!- Etudiants ->
			<?php 
					}
					if($enseignant){ ?>
				        <li><a href="<?php echo Load::link("/Users/Notes"); ?>">Notes</a></li> <!- Enseignant ->
				        <li><a href="<?php echo Load::link("/Users/Evaluation"); ?>">Evaluer</a></li> <!- Enseignant ->			        
			<?php 
					}
				}
				if($admin){ ?>
			<li><a href="<?php echo Load::link("/Admin/Enseignants"); ?>">Enseignants</a></li> <!- Admin -> 
			<li><a href="<?php echo Load::link("/Admin/Etudiants");?>">Etudiants</a></li> <!- Admin ->
			
			 
	        <?php
	        		} 
				}
				?> 
			<li class="uk-nav-divider"></li>
			<?php if($is_logged){ ?>
			<li><a href="<?php echo Load::link("/Logout") ?>"><i class="uk-icon-sign-out"></i> Quitter</a></li>
			<?php }else{ ?>
			<li><a href="<?php echo Load::link("/Login") ?>"><i class="uk-icon-sign-out"></i> Se Connecter</a></li>
			<?php } ?> 
		</ul>
	</div>
</div>