
<div class="content-wrapper">  
    <div class="col-12 ">
          <?php if (isset($data['erreur1']) && count($data['erreur1']) > 0 ) { ?>
                  <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                    <strong>Error!</strong>
                    <?php  foreach ($data['erreur1'] as $erreur) {?>
                        <p><?= $erreur; ?></p>
                    <?php } ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
          <?php }  if (isset($succes1)) {?> 
            <div class="alert alert-success alert-dismissible fade show"  role="alert">
                    <strong>Succes!</strong> <?php echo $succes1; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
          <?php }  if (isset($data['erreur2']) && count($data['erreur2']) > 0 ) { ?>
                  <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                    <strong>Error!</strong>
                    <?php  foreach ($data['erreur2'] as $erreur) {?>
                        <p><?= $erreur; ?></p>
                    <?php } ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
          <?php } if (isset($succes2)) { ?>
            <div class="alert alert-success alert-dismissible fade show"  role="alert">
                    <strong>Succes!</strong> <?php echo $succes2; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
          <?php } ?>
    </div>
    <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Importation de donnée</h4>
                  <p class="card-description">Résultat & Etape</p>
                  <form class="forms-sample"  action="<?php echo site_url('CTA_Import/import_csv1')?>"  method="POST"  enctype="multipart/form-data">
                    <div class="form-group">
                      <div class="form-group">
                        <label>Etape</label>
                        <input type="file" name="csv_file1" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Etape">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-info" type="button">Données</button>
                          </span>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Résultat</label>
                        <input type="file" name="csv_file2" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="devis">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-info" type="button">Données</button>
                          </span>
                        </div>
                    </div>
                    </div>
                    <button type="submit" class="btn btn-info mr-2">importer</button>
                  </form>
                </div>
              </div>
            </div>
    </div>     
</div>