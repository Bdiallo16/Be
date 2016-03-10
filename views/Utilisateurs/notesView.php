<div class="container uk-height-1-1">

    <div class="first row-fluid uk-height-1-1">
        <div class="notes-container col-sm-10 col-sm-offset-1">

            <ul class="nav nav-tabs">
                <li class="active"><a href="#note-matiere" data-toggle="tab">Notes par matières</a></li>
                <li><a href="#note-devoir" data-toggle="tab">Notes par devoirs</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="note-matiere">

                    <table class="table">
                        <thead>
                            <tr>
                                <th class="col-md-4">Matieres</th>
                                <th class="col-md-4">Note</th>
                            </tr>
                        </thead>
                        <tbody>

                                <tr>
                                    <th>POO</th>
                                    <th>-</th>
                                </tr>
                                <tr>
                                    <th>Algo</th>
                                    <th>-</th>
                                </tr>
                                <tr>
                                    <th>Anglais</th>
                                    <th>-</th>
                                </tr>
                                <tr>
                                    <th>Economie</th>
                                    <th>-</th>
                                </tr>
                                <tr>
                                    <th>Communication</th>
                                    <th>-</th>
                                </tr>

                            </tbody>
                        </table>

                    </div>
                    <div class="tab-pane" id="note-devoir">


                        <div class="panel-group" id="accordion">
                            <?php foreach ($matiere as $m) { ?>                                     
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse<?php echo $m->id ?>">
                                                 <?php echo $m->name; ?>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapse<?php echo $m->id ?>" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="col-md-4">Devoirs</th>
                                                        <th class="col-md-4">Note</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                 <?php foreach ($m->getallDevoirs($m->id) as $d) { ?>   
                                                    <tr>
                                                        <th> <?php echo $d->name ?></th>                                                        
                                                        <th><?php 
                                                        $note = $d->getnote2($d->id, $user->id, $d->groupe);
                                                        if(!empty($note)){
                                                                $res = $d->getnote2($d->id, $user->id, $d->groupe);
                                                        echo $res->getnote();}
                                                                else {echo "-";} ?></th>
                                                    </tr>
                                                  <?php } ?> 

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            <?php } ?>
                    </div>

