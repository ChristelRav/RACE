
<?php if (!isset($coureur)) $coureur = array(); ?>  
<div class="content-wrapper">  
    <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4 class="card-title mb-0">Liste des coureurs :</h4>
                    <a href="<?php echo site_url('CTA_Coureur/generer')?>" class="btn btn-info" >Générer catégorie</a>
                </div>        
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered">
                      <thead>
                        <tr>
                          <th>Nom</th>
                          <th>num</th>
                          <th>genre</th>
                          <th>date_naissance</th>
                          <th>équipe</th>
                          <th>catégorie</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($coureur as $id_coureur =>$c) { ?>
                            <tr>
                            <td><?= $c['nom_coureur']; ?></td>
                            <td><?= $c['num_dossard']; ?></td>
                            <td><?= $c['genre']; ?></td>
                            <td><?= $c['date_naissance']; ?></td>
                            <td><?= $c['nom_equipe']; ?></td>
                            <td><?php foreach ($c['detail_categorie'] as $ce) {  ?>
                               <p><?= $ce['categorie']; ?></p>
                            <?php } ?></td>
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