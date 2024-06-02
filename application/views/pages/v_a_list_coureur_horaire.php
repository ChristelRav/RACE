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
                            <th>Date_étape</th>
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
                              <td><?= $c->date_parcours; ?></td>
                              <input type="hidden" name="ce<?= $c->id_coureur_etape; ?>" value="<?= $c->id_coureur_etape; ?>">
                              <input type="hidden" name="etape" value="<?= $etape; ?>">
                              <td><input type="time" name="hd<?= $c->id_coureur_etape; ?>" class="form-control" value="<?= $c->heure_depart ? date('H:i:s', strtotime($c->heure_depart)) : '00:00:00'; ?>" step="1"></td>
                              <td><input type="time" name="ha<?= $c->id_coureur_etape; ?>" class="form-control" value="<?= $c->heure_arrive ? date('H:i:s', strtotime($c->heure_arrive)) : '00:00:00'; ?>" step="1"></td>
                              <td><button type="button" class="btn btn-info" onclick="openPopupH(<?php echo htmlspecialchars(json_encode( $c)); ?>)"><i class="mdi mdi-plus"></i></button></td>
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

<?php $this->load->view('pages/v_a_popup_horaire'); ?>


<script>

    
function openPopupH(film) {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupH");

        overlay.style.display = "flex";
        popup.style.display = "block";

        // Utiliser les données du film pour remplir le formulaire
        document.getElementById('id').value = film.id_etape;
        document.getElementById('coureur').value = film.id_coureur;
    }

    function closePopupH() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupH");

        overlay.style.display = "none";
        popup.style.display = "none";
    }


</script>