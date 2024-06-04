
<?php if (!isset($etape)) $etape = array(); ?>  
<?php if (!isset($equipe)) $equipe = array(); ?> 
<?php if (!isset($penalite)) $penalite = array(); ?> 
<link rel="stylesheet" href="<?php echo base_url("assets/css/popup.css"); ?>" > 
<div class="content-wrapper">       
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Liste des équipes pénalisés :</h4>
                    <button  class="btn btn-info" href="javascript:void(0);" onclick="openPopupP()" ><i class="mdi mdi-plus"></i></button>
                </div> 
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>Etape</th>
                          <th>Equipe</th>
                          <th>Temps de pénalités</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($penalite as $row) { ?>
                          <tr>
                            <td><?= $row->etape; ?></td>
                            <td><?= $row->equipe; ?></td>
                            <td><?= $row->temps_penalite; ?></td>
                            <td><button type="button" href="javascript:void(0);" onclick="openPopupD(<?php echo htmlspecialchars(json_encode( $row)); ?>)" class="btn btn-danger"><i class="mdi mdi-delete"></i></button></td>
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

        <?php $this->load->view('pages/v_a_popup_confirmation'); ?>
        <?php $this->load->view('pages/v_a_popup_add_penalite'); ?>
    </div>



<script>

    
function openPopupP() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupP");

        overlay.style.display = "flex";
        popup.style.display = "block";
    }

    function closePopupP() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupP");

        overlay.style.display = "none";
        popup.style.display = "none";
    }


    function openPopupD(film) {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupD");

        overlay.style.display = "flex";
        popup.style.display = "block";

        document.getElementById('id').value = film.id_penalite;
    }

    function closePopupD() {
        var overlay = document.getElementById("shadow");
        var popup = document.getElementById("popupD");

        overlay.style.display = "none";
        popup.style.display = "none";
    }


</script>