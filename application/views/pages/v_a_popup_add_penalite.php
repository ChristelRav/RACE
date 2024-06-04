<div id="shadow" class="overlay" onclick="closePopupP()"></div>
    <div id="popupP" class="popup">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ajout Devis</h4>
                        <form class="forms-sample" action="<?php echo site_url('CTA_Penalite/insert_penalite') ?>" method="post" >
                        <input type="hidden" name="id" class="form-control" id="id" >
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Etape</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="exampleSelectGender" name="etape">
                                        <?php foreach ($etape as $row) { ?>
                                            <option value="<?= $row->id_etape; ?>"><?= $row->nom; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Equipe</label>
                                <div class="col-sm-9">
                                    <select class="form-control" id="exampleSelectGender" name="equipe">
                                        <?php foreach ($equipe as $row) { ?>
                                            <option value="<?= $row->id_equipe; ?>"><?= $row->nom; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Pénalisation</label>
                                <div class="col-sm-9">
                                    <input type="time" name="temps" class="form-control" id="nom" step="1">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info mr-2">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





