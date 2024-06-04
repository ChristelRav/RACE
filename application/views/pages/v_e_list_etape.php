<?php if (!isset($etape)) $etape = array(); ?>   
<?php if (!isset($coureur)) $coureur = array(); ?>   
<link rel="stylesheet" href="<?php echo base_url("assets/css/popup.css"); ?>" >
<div class="content-wrapper"> 
    <div class="row">
      <div class="col-12 ">
        <?php if(isset($error)){ ?>
                      <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                        <strong>Error!</strong> <?php echo $error ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
        <?php } ?> 
      </div>   
    </div>  
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                <h4 class="card-title">Tous les étapes </h4>
                  <p class="card-description">
                    Liste <code>.affection coureur</code>
                  </p>
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Etape</th>
                          <th>Nom</th>
                          <th>Temps Chrono</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php foreach ($etape as $id_etape =>$classement) { ?>
                            <tr>
                              <th>Etape <?= $classement['rang_etape']; ?> - <?= $classement['nom']; ?>  ( <?= $classement['longueur']; ?>km)  -  <?= $classement['nbr_coureur']; ?>  coureur(s) </th>
                            </tr>
                            <?php foreach ($classement['etape'] as $e) {  ?>
                              <tr>
                                <td></td> 
                                <td><?= $e['coureur']; ?></td>
                                <td><?= $e['duree']; ?></td>                        
                              </tr>
                            <?php } ?>
                            <tr>
                                <td><button type="submit" class="btn btn-info mr-2"  href="javascript:void(0);" onclick="openPopup(<?php echo htmlspecialchars(json_encode( $classement)); ?>)">Affecter</button></td>
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
<?php $this->load->view('pages/v_e_popup_affecte'); ?>


<script>

    
function openPopup(film) {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popup");

        overlay.style.display = "flex";
        popup.style.display = "block";

        // Utiliser les données du film pour remplir le formulaire
        document.getElementById('id').value = film.id_etape;
        document.getElementById('hd').value = film.hd;
        document.getElementById('de').value = film.date_etape;
    }

    function closePopup() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popup");

        overlay.style.display = "none";
        popup.style.display = "none";
    }


</script>