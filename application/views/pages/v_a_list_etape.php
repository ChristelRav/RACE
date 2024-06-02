<?php if (!isset($etape)) $etape = array(); ?>   
<div class="content-wrapper">       
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tous les étapes </h4>
                  <p class="card-description">
                    Liste <code>.affection horaire</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Etape</th>
                          <th>Long (Km)</th>
                          <th>Nombre coureur(s)</th>
                          <th>Date étape</th>
                          <th>Heure départ</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($etape as $e) { ?>
                                <tr>
                                <td><?= $e->rang; ?> - <?= $e->nom; ?></td>
                                <td><?= $e->longueur; ?></td>
                                <td><?= $e->nbr_coureur; ?></td>
                                <td><?= $e->date_etape; ?></td>
                                <td><?= $e->heure_depart; ?></td>
                                <td><a href="<?php echo site_url('CTA_Etape/affecter_Horaire')?>?etape=<?=  $e->id_etape; ?>" class="btn btn-success mr-2" >Détails</a></td>
                                </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
    </div>
</div>