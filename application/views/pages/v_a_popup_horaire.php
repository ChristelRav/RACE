<div id="shadow" class="overlay" onclick="closePopupH()"></div>
    <div id="popupH" class="popup">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Ajout de J2</h4>
                        <form class="forms-sample" action="<?php echo site_url('CTA_Etape/insert_j2') ?>" method="post" >
                        <input type="hidden" name="id" class="form-control" id="id" >
                        <input type="hidden" name="coureur" class="form-control" id="coureur" >
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Date J2</label>
                                <div class="col-sm-9">
                                    <input type="date" name="dt" class="form-control" id="dt" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Heure départ</label>
                                <div class="col-sm-9">
                                    <input type="time"  name="hd" class="form-control" id="hd" step="1" >
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Heure arrivée</label>
                                <div class="col-sm-9">
                                    <input type="time"  name="ha" class="form-control" id="ha" step="1" >
                                </div>
                            </div>
                            <button type="submit" class="btn btn-info mr-2">Ajout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



