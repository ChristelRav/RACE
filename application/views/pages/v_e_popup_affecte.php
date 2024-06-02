<div id="shadow" class="overlay" onclick="closePopup()"></div>
    <div id="popup" class="popup">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" id="popupTitle">Affectation</h4>
                            <form class="form-sample"  action="<?php echo site_url('CTE_Etape/affecter_Etape')?>"  method="POST">
                                <p class="card-description">Liste coureur Equipe</p>
                                <input type="hidden" name="id" class="form-control" id="id" >
                                <input type="hidden" name="hd" class="form-control" id="hd" >
                                <input type="hidden" name="de" class="form-control" id="de" >
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="form-group row">
                                               <?php foreach ($coureur as $c) { ?>
                                                <div class="col-sm-9">
                                                    <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="coureur[]" id="membershipRadios1" value="<?php echo $c->id_coureur; ?>" >
                                                        <?= $c->nom; ?>
                                                    </label>
                                                    </div>
                                                </div>
                                                <?php } ?>
                                            </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-info mr-2">valider</button>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



