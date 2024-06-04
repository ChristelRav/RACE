<?php if (!isset($coureur)) $coureur = array(); ?>   
<?php if (!isset($etape)) $etape = array(); ?>   

<link rel="stylesheet" href="<?php echo base_url("assets/css/popup.css"); ?>" >
<div class="content-wrapper">   
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Tous les coureurs</h4>
                  <p class="card-description">
                    Affection heures <code>.coureurs</code>
                  </p>
                  <div class="table-responsive">
                    <form action="<?php echo site_url('CTA_Etape/update_horaire')?>" method="GET">
                      <table class="table">
                        <thead>
                          <tr>
                            <th># </th>
                            <th>équipe</th>
                            <th>nom</th>
                            <th>genre</th>
                            <th></th>
                            <th></th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php  foreach ($coureur as $c) { ?>
                            <tr>
                              <td><?= $c->num_dossard; ?></td>
                              <td><?= $c->nom; ?></td>
                              <td><?= $c->coureur; ?></td>
                              <td><?= $c->genre; ?></td>
                              <input type="hidden" name="ce<?= $c->id_coureur_etape; ?>" value="<?= $c->id_coureur_etape; ?>">
                              <input type="hidden" name="etape" value="<?= $etape; ?>">
                              <td><input type="datetime-local" name="hd<?= $c->id_coureur_etape; ?>" class="form-control" value="<?= $c->heure_depart; ?>" step="1"></td>
                              <td><input type="datetime-local" name="ha<?= $c->id_coureur_etape; ?>" class="form-control" value="<?= $c->heure_arrive; ?>" step="1"></td>
                            </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                      <button class="btn btn-success mr-2">valider</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
    </div>    
</div>
