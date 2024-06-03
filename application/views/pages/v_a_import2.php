
<div class="content-wrapper">  
<div class="row">
        <div class="col-12 ">
          <?php if (isset($data['erreur']) && count($data['erreur']) > 0) { ?>
                  <div class="alert alert-danger alert-dismissible fade show"  role="alert">
                    <strong>Error!</strong>
                    <?php  foreach ($data['erreur'] as $erreur) {?>
                        <p><?= $erreur; ?></p>
                    <?php } ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
          <?php }   else if (isset($succes)) {?> 
            <div class="alert alert-success alert-dismissible fade show"  role="alert">
                    <strong>Succes!</strong> <?php echo $succes; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
          <?php } ?>
        </div>
    </div>
    <div class="row">
            <div class="col-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Importation de donnée</h4>
                  <p class="card-description">Points</p>
                  <form class="forms-sample"  action="<?php echo site_url('CTA_Import/import_csv2')?>"  method="POST"  enctype="multipart/form-data">
                    <div class="form-group">
                      <label>File upload</label>
                      <input type="file" name="csv_file" class="file-upload-default">
                      <div class="input-group col-xs-12">
                        <input type="text" class="form-control file-upload-info" disabled placeholder="Points">
                        <span class="input-group-append">
                          <button class="file-upload-browse btn btn-info" type="button">données</button>
                        </span>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info mr-2">importer</button>
                  </form>
                </div>
              </div>
            </div>
    </div>     
</div>