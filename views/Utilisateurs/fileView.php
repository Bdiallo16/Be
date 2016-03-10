<div class="container">
    <div class="row">
        <h3 class="page-header">Bienvenue <?php echo ucfirst($user->prenom) . " " . ucfirst($user->nom); ?></h3>
    </div>
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="<?php echo Load::link("/Users"); ?>"><?php echo strtoupper($formation->getName()) ?></a></li>
            <li><a><?php echo $formation->getAnnee() ?></a></li>
            <li><a href="<?php echo Load::link("/Users/Cours?i=" . $matiere->id) ?>"><?php echo $matiere->getName() ?></a></li>
            <li><a href="#"><?php echo $fichier->name ?></a></li> 
        </ol>
    </div>
    <div class="row">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <?php echo $fichier->name ?>	
            </div>
            <table class="table">
                <tbody>
                     <th class="col-md-2"></th>
                    <tr>
                       
                          <th>Status de l'évaluation</th>
                        <th><?php echo $fichier->getStatutTravaux($fichier->id) ?></th>
                    </tr>
                    <tr>
                        <th>Status de l'évaluation</th>
                        <th><?php echo $fichier->getStatutEvaluation($fichier->id) ?></th>
                    </tr>
                    <tr>
                        <th>A rendre jusqu'au</th>
                        <th><?php echo $fichier->getDate() ?></th>
                    </tr>
                    <tr>
                        <th>Temps restant</th>
                        <th>><?php echo $fichier->getTempsRestant($fichier->id) ?>)</th>
                    </tr>
                    <tr>
                        <th>Dernière modification</th>
                        <th><?php echo $fichier_rendu-> getDate()?></th>
                    </tr>
                    <tr>
                        <th>Remises de fichiers</th>
                        <th></th>
                    </tr>
                    <tr>
                        <th>Commentaires</th>
                        <th><?php echo $fichier_rendu->getCommentaireEtudiant()?></th>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div id="dropzone" class="panel panel-primary">
            <form class="dropzone" action="/file-upload" id="dropzone-box" ></form>
        </div>
    </div>

</div>