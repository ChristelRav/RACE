
<?php if (!isset($classe)) $classe = array(); ?>  
<?php if (!isset($classeC)) $classeC = array(); ?>   
<?php if (!isset($etape)) $etape = array(); ?> 
<?php if (!isset($categorie)) $categorie = array(); ?>   
<div class="content-wrapper"> 
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Classement général</h4>
                  <p class="card-description">
                    Classement par <code>.équipe</code>
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Rang</th>
                          <th>Equipe</th>
                          <th>Point(s)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($classe as $c) { ?>
                          <tr>
                            <td><?= $c->rang; ?></td>
                            <td><?= $c->nom; ?></td>
                            <td><?= $c->total_point; ?></td>                         
                          </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
    </div> 

    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Classement général par catégorie</h4>
                  <p class="card-description">
                    Classement par <code>.équipe & catégorie</code>
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Rang</th>
                          <th>Equipe</th>
                          <th>Point(s)</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($classeC as $id_categorie => $classement) { ?>
                          <tr>
                            <th><?= $classement['categorie']; ?></th>
                          </tr>
                          <?php foreach ($classement['detail'] as $e) {  ?>
                            <tr>
                              <td><?= $e['rang']; ?></td>
                              <td><?= $e['nom']; ?></td>
                              <td><?= $e['point_categorie']; ?></td>                         
                            </tr>
                          <?php } ?>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
    </div> 
</div>