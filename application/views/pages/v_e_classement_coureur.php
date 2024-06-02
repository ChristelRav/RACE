<?php if (!isset($classe)) $classe = array(); ?>   
<div class="content-wrapper">      
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Classement général</h4>
                  <p class="card-description">
                    Classement par <code>.coureur & points</code>
                  </p>
                  <div class="table-responsive pt-3">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th></th>
                          <th>rang</th>
                          <th>Coureur</th>
                          <th>Equipe</th>
                          <th>point</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($classe as $id_etape =>$classement) { ?>
                            <tr>
                              <th>Etape <?= $classement['rang_etape']; ?> - <?= $classement['nom']; ?></th>
                            </tr>
                            <?php foreach ($classement['etape'] as $e) {  ?>
                              <tr>
                                <td></td>
                                <td><?= $e['rang_coureur']; ?></td>  
                                <td><?= $e['coureur']; ?></td>
                                <td><?= $e['nom']; ?></td>
                                <td><?= $e['point']; ?></td>                        
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