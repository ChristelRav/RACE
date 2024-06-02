
<?php if (!isset($classe)) $classe = array(); ?>   
<?php if (!isset($etape)) $etape = array(); ?>   
<div class="content-wrapper">     
    <div class="row">
    <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Horizontal Form</h4>
                  <p class="card-description">
                    Horizontal form layout
                  </p>
                  <form class="forms-sample" action="<?php echo site_url('CTE_Classement/selection_etape')?>" method="POST">
                    <div class="form-group row">
                      <div class="col-sm-12">
                      <select class="form-control" id="exampleSelectGender" name="etape">
                          <?php foreach ($etape as $e) { ?>
                              <option value="<?= $e->id_etape; ?>"><?= $e->rang; ?> - <?= $e->nom; ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info mr-2">sélectionner</button>
                  </form>
                </div>
              </div>
            </div>
    </div> 
    <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">lassement général</h4>
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
</div>