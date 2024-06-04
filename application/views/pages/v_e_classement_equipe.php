<?php if (!isset($classe)) $classe = array(); ?>  
<?php if (!isset($classeC)) $classeC = array(); ?>   
<?php if (!isset($etape)) $etape = array(); ?> 
<?php if (!isset($categorie)) $categorie = array(); ?>  

<?php 
$equipe = []; $nome = [];
  foreach ($classe as $c) {
    $equipe[] = $c->nom;
    $nome[] = $c->point;
  }
  $encode_Equipe = json_encode($equipe);
  $encode_nome = json_encode($nome);
?>

<?php  
$equipeA = []; 
$nomeA = [];
foreach ($classeC as $id_categorie => $classement) {
     foreach ($classement['detail'] as $e) { 
      $equipeA[$id_categorie][] = $e['nom']; 
      $nomeA[$id_categorie][] = $e['point_categorie'];
     } 
} 
$encode_EquipeA = json_encode($equipeA);
$encode_nomeA = json_encode($nomeA);
?>

<script src="<?php echo base_url("assets/vendor_chart/js/vendor.bundle.base.js"); ?>"></script>
<script src="<?php echo base_url("assets/vendor_chart/chart.js/Chart.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/vendor_chart/js/off-canvas.js"); ?>"></script>

<div class="content-wrapper"> 
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Classement général</h4>
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
                                    <td><?= $c->rang_equipe; ?></td>
                                    <td><?= $c->nom; ?></td>
                                    <td><?= $c->point; ?></td>
                                    <td><?= $c->pdf; ?></td>                       
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pie chart</h4>
                    <canvas id="doughnutChart" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div> 
    <?php foreach ($classeC as $id_categorie => $classement) { ?>
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Classement par <strong><?= $classement['categorie']; ?></strong></h4>
                    <p class="card-description">
                        Classement par <code>.équipe & catégorie</code>
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
                                <?php foreach ($classement['detail'] as $e) {  ?>
                                <tr>
                                    <td><?= $e['rang']; ?></td>
                                    <td><?= $e['nom']; ?></td>
                                    <td><?= $e['point_categorie']; ?></td>                
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Pie chart</h4>
                    <canvas id="doughnutChart<?php echo $classement['categorie']; ?>" style="height:250px"></canvas>
                </div>
            </div>
        </div>
    </div>
    <?php } ?> 
</div>

<script>
var value1 = <?= $encode_nome; ?>;
var value2 =  <?= $encode_Equipe; ?>;
var doughnutPieData = {
    datasets: [{
        data: value1,
        backgroundColor: [
            'rgba(255, 99, 132, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            'rgba(75, 192, 192, 0.5)',
        ],
        borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
        ],
    }],
    labels: value2
};
var doughnutPieOptions = {
    responsive: true,
    animation: {
        animateScale: true,
        animateRotate: true
    }
};
if ($("#doughnutChart").length) {
    var doughnutChartCanvas = $("#doughnutChart").get(0).getContext("2d");
    var doughnutChart = new Chart(doughnutChartCanvas, {
        type: 'pie',
        data: doughnutPieData,
        options: doughnutPieOptions
    });
}
</script>

<?php foreach ($classeC as $id_categorie => $classement) { ?>
<script>
var labels_<?= $id_categorie ?> = <?= json_encode($equipeA[$id_categorie]); ?>;
var data_<?= $id_categorie ?> = <?= json_encode($nomeA[$id_categorie]); ?>;
var doughnutPieData_<?= $id_categorie ?> = {
    datasets: [{
        data: data_<?= $id_categorie ?>,
        backgroundColor: [
            'rgba(255, 99, 132, 0.5)',
            'rgba(54, 162, 235, 0.5)',
            'rgba(255, 206, 86, 0.5)',
            'rgba(75, 192, 192, 0.5)',
        ],
        borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
        ],
    }],
    labels: labels_<?= $id_categorie ?>
};
var doughnutPieOptions_<?= $id_categorie ?> = {
    responsive: true,
    animation: {
        animateScale: true,
        animateRotate: true
    }
};
if ($("#doughnutChart<?php echo $classement['categorie']; ?>").length) {
    var doughnutChartCanvas_<?= $id_categorie ?> = $("#doughnutChart<?php echo $classement['categorie']; ?>").get(0).getContext("2d");
    var doughnutChart_<?= $id_categorie ?> = new Chart(doughnutChartCanvas_<?= $id_categorie ?>, {
        type: 'pie',
        data: doughnutPieData_<?= $id_categorie ?>,
        options: doughnutPieOptions_<?= $id_categorie ?>
    });
}
</script>
<?php } ?>
