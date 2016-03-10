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
				<li><a>Edition</a></li>
				<?php }else{ ?>
					<li><a href="<?php echo Load::link("/Users"); ?>">Accueil</a></li>
				<?php } ?></a>
			 </li>
		</ol>
	</div>

    <div class="row">
    	<h2 class="page-header">Modification du cours</h2>
    </div>
    
    <?php if($matiere){ ?>
        
    <div class="row uk-margin-bottom">
    	
        <form id="matiere" onsubmit="sendJSON()">
    		<label>Nom du cours</label>
            <input data-matiere-id="<?php echo $matiere->id ?>" id="matiere-name" class="form-control input-lg" type="text" value="<?php echo $matiere->getName() ?>">
    	
    	<div id="devoirs" class="uk-margin-top well well-lg">
		
            <?php foreach($matiere->getDevoirs() as $d){ ?>
            
            <div class="devoir panel panel-primary">
				<div class="panel-heading">
					<label>Nom du devoir :</label>
					<input class="devoir-name form-control" data-devoir-id="<?php echo $d->id ?>" type="text" value="<?php echo $d->getName() ?>">
					<div class="form-group devoir-groupe">
						<label class="uk-margin-top uk-margin-right">En groupe ?</label>
						<label>
							<input type="radio" name="enGroupe<?php echo "_".$d->id ?>" value="1" <?php echo ($d->enGroupe()? 'checked' : "") ?>>  oui
						</label>
						<label>
						   	<input type="radio" name="enGroupe<?php echo "_".$d->id ?>" value="0" <?php echo ((!$d->enGroupe())? 'checked' : "") ?> > Non
						</label>
					</div>
                    
				</div>
				<div class="panel-body devoir">
					<!--<div>
						<p class="lead">commentaire</p>
					</div>-->
					
					<div class="fichiers">
                        <?php foreach($d->getFichiersAttendus() as $f){ ?>
						<div class="fichier panel panel-info">
							<div class="panel-heading">
								<label>Nom du fichier:</label>
								<input class="fichier-name form-control" data-fichier-id="<?php echo $f->id ?>" type="text" value="<?php echo $f->getName() ?>" >
							</div>
							<div class="panel-body fichiers-content">
								
								<div class="form-group">
									<label>Date limite :</label>
                                    <input class="fichier-date form-control" type="" data-uk-datepicker="{format:'DD-MM-YYYY'}" value="<?php echo $f->getDate() ?>">
								</div>
								<div class="form-group">
									<label>Heure limite :</label>
                                    <input class="fichier-heure form-control" type="" value="<?php echo $f->getHeure() ?>" data-uk-timepicker="{minuteStep:15, showSeconds:true}">
								</div>
								<div class="fichier-retard form-group">
									<label class="uk-margin-right">Retard accepté ? :</label>
									<label>
								    	<input type="radio" name="acceptRetard<?php echo "_".$f->id ?>" value="1" <?php echo ($f->acceptRetard()? "checked" : "") ?>>  oui
									</label>
									<label>
								    	<input type="radio" name="acceptRetard<?php echo "_".$f->id ?>" value="0" <?php echo ((!$f->acceptRetard())? "checked" : "") ?>> Non
								    </label>
								</div>
							</div>
                            
						</div>
                        <?php } ?>
                        
                        
					</div>
                    
				</div>
                <div class="panel-footer">
                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                          <button type="button" class="btn-fichier btn btn-info">Ajouter un fichier</button>
                        </div>
                      </div>
                    </div>
			</div>
			
			<?php } ?>

			
		</div>

    	
    	
    	</form>
        
    </div>
    
    <div class="row">
        <div class=" col-sm-10 col-sm-offset-1">
    	<div class="btn-group btn-group-justified">
			<div class="btn-group">
				<button type="button" class="btn-devoir btn btn-lg btn-primary">Ajouter un devoir</button>
			</div>
    	</div>
        </div>
    </div>
    <div class="row uk-margin-top">
        <div class="col-sm-10 col-sm-offset-1">
        <div class="btn-group btn-group-justified uk-margin-top">
			<div class="btn-group">
				<button type="submit" form="matiere" class="btn btn-lg btn-success">Enregistrer</button>
			</div>
    	</div>
        </div>
    
    </div>
    
    
   	<script type="text/javascript" src="<?php echo Load::js("edition") ?>"></script> 
    
    
        <?php } else { ?>
    <div class="row">
        <div class="alert alert-info">Oops, le cours n'existe pas ou n'existe plus.</div>
        <div class="btn-group btn-group-justified">
            <div class="btn-group">
              <a href="/Users/Cours/Create" class="btn btn-default">Ajouter un cours</a>
            </div>

      </div>
    </div>
            
            <?php } ?>
</div>

<!-- TEMPLATE DEVOIR -->
<div id="devoir-template" class="uk-hidden">
<div class="devoir panel panel-primary">
				<div class="panel-heading">
					<label>Nom du devoir :</label>
                    <input required class="devoir-name form-control" data-devoir-id="-1" type="text" value="">
					<div class="form-group devoir-groupe">
						<label class="uk-margin-top uk-margin-right">En groupe ?</label>
						<label>
							<input type="radio" name="enGroupe_{id_d}" value="1">  oui
						</label>
						<label>
						   	<input type="radio" name="enGroupe_{id_d}" value="0" checked> Non
						</label>
					</div>
                    
				</div>
				<div class="panel-body devoir">
					<!--<div>
						<p class="lead">commentaire</p>
					</div>-->
					
					<div class="fichiers">
                        <div class="fichier panel panel-info">
							<div class="panel-heading">
								<label>Nom du fichier:</label>
								<input required class="fichier-name form-control" data-fichier-id="-1" type="text" value="" >
							</div>
							<div class="panel-body fichiers-content">
								
								<div class="form-group">
									<label>Date limite :</label>
                                    <input required class="fichier-date form-control" type="" data-uk-datepicker="{format:'DD-MM-YYYY'}" value="<?php echo date("d-m-Y") ?>">
								</div>
								<div class="form-group">
									<label>Heure limite :</label>
                                    <input required class="fichier-heure form-control" type="" value="00:00:00" data-uk-timepicker="{minuteStep:15, showSeconds:true}">
								</div>
								<div class="fichier-retard form-group">
									<label class="uk-margin-right">Retard accepté ? :</label>
									<label>
								    	<input type="radio" name="acceptRetard_{id_f}" value="1" checked>  oui
									</label>
									<label>
								    	<input type="radio" name="acceptRetard_{id_f}" value="0" > Non
								    </label>
								</div>
							</div>
                            
						</div>
                        
                        
					</div>
                    
				</div>
                <div class="panel-footer">
                    <div class="btn-group btn-group-justified">
                        <div class="btn-group">
                          <button type="button" class="btn-fichier btn btn-info">Ajouter un fichier</button>
                        </div>
                      </div>
                    </div>
			</div>
</div>
<div id="fichier-template" class="uk-hidden">
<div class="fichier panel panel-info">
    <div class="panel-heading">
        <label>Nom du fichier:</label>
        <input required class="fichier-name form-control" data-fichier-id="-1" type="text" value="" >
    </div>
    <div class="panel-body fichiers-content">

        <div class="form-group">
            <label>Date limite :</label>
            <input required class="fichier-date form-control" type="" data-uk-datepicker="{format:'DD-MM-YYYY'}" value="<?php echo date("d-m-Y") ?>">
        </div>
        <div class="form-group">
            <label>Heure limite :</label>
            <input required class="fichier-heure form-control" type="" value="00:00:00" data-uk-timepicker="{minuteStep:15, showSeconds:true}">
        </div>
        <div class="fichier-retard form-group">
            <label class="uk-margin-right">Retard accepté ? :</label>
            <label>
                <input type="radio" name="acceptRetard_{id_f}" value="1" checked>  oui
            </label>
            <label>
                <input type="radio" name="acceptRetard_{id_f}" value="0" > Non
            </label>
        </div>
    </div>
</div>                  
</div>