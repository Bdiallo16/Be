<div class="container">
    
    <div class="row">
		<h3 class="page-header">Bienvenue <?php echo ucfirst($user->prenom)." ".ucfirst($user->nom) ;?></h3>
	</div>
    <div class="row">
		<ol class="breadcrumb">
			<li><a>Créer un cours</a></li>
		</ol>
	</div>
    <div class="row">
   		<h2 class="page-header">Création d'un cours</h2>
    </div>
    
    <div class="row">
    	<form method="post" action="<?php echo Load::link("/Users/Cours/Create"); ?>">
			
			<input type="hidden" name="postData" value="1">
			<div class="form-group">
				<label class="control-label">Nom du cours :</label>
				<input required class="form-control" name="matiere-name" type="text">
			</div>
			<div class="form-group">
				<label class="control-label">Formation :</label>
				<select name="id-form" class="form-control" type="text">
					<?php foreach($formations as $f){?>
                    <option value="<?php echo $f->id ?>"><?php echo strtoupper($f->getName())." ( ".$f->annee." )" ?></option>
					<?php } ?>
				</select>
			</div>
			<div class="form-group">
				<button type="button" class="btn btn-primary" data-uk-toggle="{target:'#ens_list'}">Choisir Enseignants</button>
				<div id="ens_list" class="uk-hidden">
				<input id="enseignants" name="id_enseignants" type="hidden" value="_<?php echo $user->id ?>">
				<table class="table table-striped table-hover table-responsive">
				<thead>
					<tr>
						<th class="col-md-4">Prenom</th>
						<th class="col-md-4">Nom</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach($enseignants as $e){ ?>
					<tr class="ens-row <?php echo ($e->id == $user->id)? "success":""; ?>" ens-id="<?php echo $e->id ?>">
						<th><?php echo $e->prenom; ?></th>
						<th><?php echo $e->nom; ?></th>
					</tr>
				<?php } ?>
				</tbody>
			</table>
				
				<script>
					
					$(document).ready(function(){
						$(".ens-row").click(function(){
							var ensId = $(this).attr("ens-id");
							if($(this).hasClass("success")){
								$(this).removeClass("success");
								var value = $("#enseignants").val();
								value = value.replace("_"+ensId,"");
								$("#enseignants").val(value);
							}else{
								$(this).addClass("success");
								var value = $("#enseignants").val();
								value = value+"_"+ensId;
								$("#enseignants").val(value);
							}
							
							console.log($("#enseignants").val());
						});
					});

					
				</script>
				
				
				</div>
			</div>
			<div class="form-group">
				<label class="control-label : ">Nombre de devoirs</label>
				<select name="nb-devoir" class="form-control">
				<?php for($i=1; $i <= 10; $i++){
					echo "<option>".$i."</option>";
				} ?>
				</select>
			</div>
			<div class="form-group">
			<div class="col-sm-10 col-sm-offset-1 uk-margin-top">
			<div class="btn-group btn-group-justified">
				<div class="btn-group">
					<button type="submit" class="btn btn-success">Enregistrer</button>
				</div>
				<div class="btn-group">
					<button type="reset" class="btn btn-danger">Annuler</button>
				</div>
			</div>
			</div>
			</div>
    	</form>
    </div>

    
    
</div>
