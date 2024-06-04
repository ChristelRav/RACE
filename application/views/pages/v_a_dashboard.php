
<script src="<?php echo base_url("assets/vendor_chart/js/vendor.bundle.base.js"); ?>"></script>
    <script src="<?php echo base_url("assets/vendor_chart/chart.js/Chart.min.js"); ?>"></script>
     <script src="<?php echo base_url("assets/vendor_chart/js/off-canvas.js"); ?>"></script>

<div class="content-wrapper">     
    <div class="row">
            <div class="col-lg-6 grid-margin grid-margin-lg-0 stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pie chart</h4>
                  <canvas id="doughnutChart" style="height:250px"></canvas>
                </div>
              </div>
            </div>
    </div>  
</div>


<script>
var value1 = 1
var value2 =2;
var doughnutPieData = {
    datasets: [{
      data: [value2, value1],
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

    // These labels appear in the legend and in the tooltips when hovering different arcs
    labels: [
      'Femme',
      'Homme',
    ]
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

