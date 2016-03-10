<!DOCTYPE html>
<html lang="fr">
	<head>
		<?php include_once("Layout/headView.php") ?>
	</head>
	<body>
	
		<div class="container test">
			<div class="row-fluid">
			<h1 class="page-header uk-text-center">Page de Test</h1>
			<div class="row">
			<div class="col-sm-4 col-sm-offset-4">
				<h2 class="page-header uk-text-center">v2.0 - 20/03/14</h2>
			</div>
			</div>
			
			
			<h3 class="page-header">Formation</h3>
			
			<div class="alert alert-<?php echo ($formationFindById)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($formationFindById)? "ok": "remove"; ?>"> </span> findById -
				<?php echo $message["form_findById_mess"]?>
			</div>
			<div class="alert alert-<?php echo ($formationFindByEtu)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($formationFindByEtu)? "ok": "remove"; ?>"> </span> findByEtudiant -
				<?php echo $message["form_findByEtu_mess"]?>
			</div>
			<div class="alert alert-<?php echo ($formationFindAll)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($formationFindAll)? "ok": "remove"; ?>"> </span> findAll -
				<?php echo $message["form_findAll_mess"]?>
			</div>
			
			
			<h3 class="page-header">Matiere</h3>
			<div class="alert alert-<?php echo ($matiereFindById)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($matiereFindById)? "ok": "remove"; ?>"> </span> findById -
				<?php echo $message["mat_findById_mess"];  ?>
			</div>
			<div class="alert alert-<?php echo ($matiereFindByEnseignant)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($matiereFindByEnseignant)? "ok": "remove"; ?>"> </span> findByEnseignant - 
				<?php echo $message["mat_findByEns_mess"];  ?>
			</div>
			
			<h3 class="page-header">Devoir</h3>
			<div class="alert alert-<?php echo ($devoirFindById)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($devoirFindById)? "ok": "remove"; ?>"> </span> findById -
				<?php echo $message["dev_findById_mess"];  ?>
			</div>
			<div class="alert alert-<?php echo ($devoirFindByMatiere)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($devoirFindByMatiere)? "ok": "remove"; ?>"> </span> findByMatiere - 
				<?php echo $message["dev_findByMatiere_mess"];  ?>
			</div>
			
			<h3 class="page-header">Etudiant</h3>
			<div class="alert alert-<?php echo ($etudiantFindById)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($etudiantFindById)? "ok": "remove"; ?>"> </span> findById - 
				<?php echo $message["etu_findById_mess"]?>
			</div>
			<div class="alert alert-<?php echo ($etudiantFindAll)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($etudiantFindAll)? "ok": "remove"; ?>"> </span> findAll -
				<?php echo $message["etu_findAll_mess"]?>
			</div>
			
			<h3 class="page-header">Enseignant</h3>
			<div class="alert alert-<?php echo ($enseignantFindById)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($enseignantFindById)? "ok": "remove"; ?>"> </span> findById -
				<?php echo $message["ens_findById_mess"]?>
			</div>
			<div class="alert alert-<?php echo ($enseignantFindAll)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($enseignantFindAll)? "ok": "remove"; ?>"> </span> findAll -
				<?php echo $message["ens_findAll_mess"]?>
			</div>
			
			<h3 class="page-header">Fichier</h3>
			
			<div class="alert alert-<?php echo ($fichiersFindById)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($fichiersFindById)? "ok": "remove"; ?>"> </span> findById -
				<?php echo $message["file_findById_mess"]?>
			</div>
			<div class="alert alert-<?php echo ($fichiersFindByDevoir)? "success": "danger"; ?>">
				<span class="glyphicon glyphicon-<?php echo ($fichiersFindByDevoir)? "ok": "remove"; ?>"> </span> findByDevoir -
				<?php echo $message["file_findByDevoir_mess"]?>
			</div>
			
			
			
		</div>
		
	</body>
</html>