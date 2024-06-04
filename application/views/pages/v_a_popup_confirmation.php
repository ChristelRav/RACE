<div id="shadow" class="overlay" onclick="closePopupD()"></div>
    <div id="popupD" class="popup">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Voulez-vous supprimer?</h4>
                        <form class="forms-sample" action="<?php echo site_url('CTA_Penalite/delete_penalite') ?>" method="post" >
                            <input type="hidden" name="id" id="id">
                            <button type="submit" class="btn btn-success mr-2">Oui</button>
                        </form>
                        <br>
                        <form class="forms-sample" action="<?php echo site_url('CTA_Penalite') ?>" method="post" >
                            <button type="submit" class="btn btn-danger mr-2">Non</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





