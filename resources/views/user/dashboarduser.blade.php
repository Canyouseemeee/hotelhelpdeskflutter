@extends('layouts.masteruser2')

@section('title')
Web Test
@endsection

@section('content')
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>

    <form action="{{ url('dashboarduser-between') }}" method="post">
      {{ csrf_field() }}
      <div class="row">
        <label class="col-form-label text-md-right"> Fromdate : </label>
        <div class="col-xl-4 col-md-6 mb-2">
          <input type="text" id="fromdate" name="fromdate" value="{{now()->toDateString()}}" class="form-control">
        </div>
        <label class="col-form-label text-md-right"> Todate : </label>
        <div class="col-xl-4 col-md-6 mb-2">
          <input type="text" id="todate" name="todate" value="{{now()->toDateString()}}" class="form-control">
        </div>
        <div>
          <button type="submit" class="btn btn-primary float-right">Search</button>
        </div>
      </div>
    </form>

  </div>

  <!-- Content Row -->
  <div class="row">
    @if($fromdate != null || $todate != null)
    <div class="col-xl-12 col-md-12 mb-4">
      <label class="col-form-label text-md-right"> Fromdate : {{$fromdate}} - Todate : {{$todate}} is quantity {{$data}} </label>
    </div>
    @endif
    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">All Issues</div>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-calendar fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <a href="/issues-user" class="text-xs font-weight-bold text-info text-uppercase mb-1">News Issues Today</a>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data2}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Earnings (Monthly) Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-danger shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <a href="/defer-user" class="text-xs font-weight-bold text-danger text-uppercase mb-1">Defer Issues</a>
              <div class="row no-gutters align-items-center">
                <div class="col-auto">
                  <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$data3}}</div>
                </div>
                <div class="col">
                  <div class="progress progress-sm mr-2">
                    <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
            <a href="/closed-user" class="text-xs font-weight-bold text-success text-uppercase mb-1">Closed Issues</a>
              <div class="h5 mb-0 font-weight-bold text-gray-800">{{$data4}}</div>
            </div>
            <div class="col-auto">
              <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Content Row -->

  <div class="row">

    <!-- Area Chart -->
    <!-- <div class="col-xl-8 col-lg-7"> -->
    <!-- <div class="card shadow mb-4"> -->
    <!-- Card Header - Dropdown -->
    <!-- <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Earnings Overview</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div> -->
    <!-- Card Body -->
    <!-- <div class="card-body">
          <div class="chart-area">
            <canvas id="myAreaChart"></canvas>
          </div>
        </div>
      </div> -->
    <!-- </div> -->

    <!-- Pie Chart -->
    <div class="col-xl-4 col-lg-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">Revenue Issues</h6>
          <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
              <div class="dropdown-header">Dropdown Header:</div>
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </div>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          <div class="chart-pie pt-4 pb-2">
            <canvas id="myPieChart2"></canvas>
          </div>
          <div class="mt-4 text-center small">
            <span class="mr-2">
              <i class="fas fa-circle text-primary"></i> News
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-danger"></i> Defer
            </span>
            <span class="mr-2">
              <i class="fas fa-circle text-success"></i> Closed
            </span>
          </div>
        </div>
      </div>
    </div>
    <!-- Bar Chart -->
    <div class="col-xl-8 col-lg-12">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Bar Chart</h6>
        </div>
        <div class="card-body">
          <div class="chart-bar">
            <canvas id="myBarChart"></canvas>
          </div>
        </div>
      </div>
    </div><!-- Bar Chart HW -->
    <div class="col-xl-5 col-lg-5">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Bar Chart HW</h6>
        </div>
        <div class="card-body">
          <div id="chart_div"></div>
        </div>
      </div>
    </div>

    <!-- Bar Chart SW-->
    <div class="col-xl-7 col-lg-5">
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Bar Chart SW</h6>
        </div>
        <div class="card-body">
          <div id="chart_div2"></div>
        </div>
      </div>
    </div>
  </div>





  <!-- Content Row -->
  <div class="row">

    <!-- Content Column -->
    <div class="col-lg-6 mb-4">

      <!-- Color System -->
      <!-- <div class="row">
        <div class="col-lg-6 mb-4">
          <div class="card bg-primary text-white shadow">
            <div class="card-body">
              Primary
              <div class="text-white-50 small">#4e73df</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card bg-success text-white shadow">
            <div class="card-body">
              Success
              <div class="text-white-50 small">#1cc88a</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card bg-info text-white shadow">
            <div class="card-body">
              Info
              <div class="text-white-50 small">#36b9cc</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card bg-warning text-white shadow">
            <div class="card-body">
              Warning
              <div class="text-white-50 small">#f6c23e</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card bg-danger text-white shadow">
            <div class="card-body">
              Danger
              <div class="text-white-50 small">#e74a3b</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card bg-secondary text-white shadow">
            <div class="card-body">
              Secondary
              <div class="text-white-50 small">#858796</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card bg-light text-black shadow">
            <div class="card-body">
              Light
              <div class="text-black-50 small">#f8f9fc</div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mb-4">
          <div class="card bg-dark text-white shadow">
            <div class="card-body">
              Dark
              <div class="text-white-50 small">#5a5c69</div>
            </div>
          </div>
        </div>
      </div> -->

    </div>


  </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
@endsection

@section('scripts')
<!-- Page level plugins -->
<script src="/vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="/js/demo/chart-area-demo.js"></script>
<script src="/js/demo/chart-pie-demo.js"></script>

<script>
  $(function() {
    var from = $('#fromdate').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true
      }).on("change", function() {
        to.datepicker("option", "minDate", getDate(this));
      }),
      to = $('#todate').datepicker({
        dateFormat: "yy-mm-dd",
        changeMonth: true
      }).on("change", function() {
        from.datepicker("option", "maxDate", getDate(this));
      });

    function getDate(element) {
      var date;
      var dateFormat = "yy-mm-dd";
      try {
        date = $.datepicker.parseDate(dateFormat, element.value);
      } catch (error) {
        date = null;
      }
      return date;
    }
  });
</script>

<script>
  // Set new default font family and font color to mimic Bootstrap's default styling
  Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
  Chart.defaults.global.defaultFontColor = '#858796';

  // Pie Chart Example
  var ctx = document.getElementById("myPieChart2");
  // var data = $data;

  var myPieChart2 = new Chart(ctx, {
    type: 'doughnut',
    data: {
      //labels: ["Direct", "Referral", "Social"],
      labels: [<?= $datalabel; ?>],
      datasets: [{
        data: [<?= $datatotal; ?>],
        backgroundColor: ['#4e73df', '#e3342f', '#1cc88a'],
        hoverBackgroundColor: ['#4e73df', '#e3342f', '#1cc88a'],
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }],
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
      },
      legend: {
        display: false
      },
      cutoutPercentage: 80,
    },
  });

  // Bar Chart Example
  var ctx = document.getElementById("myBarChart");
  var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ["July", "August", "September", "October", "November", "December"],
      datasets: [{
        label: "Issues Unit",
        backgroundColor: "#4e73df",
        hoverBackgroundColor: "#2e59d9",
        borderColor: "#4e73df",
        data: [<?= $datatotalmonthbar; ?>],
      }],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      scales: {
        xAxes: [{
          time: {
            unit: 'month'
          },
          gridLines: {
            display: false,
            drawBorder: false
          },
          ticks: {
            maxTicksLimit: 6
          },
          maxBarThickness: 25,
        }],
        yAxes: [{
          ticks: {
            min: 0,
            max: 100,
            maxTicksLimit: 5,
            padding: 10,
            // Include a dollar sign in the ticks
            callback: function(value, index, values) {
              return number_format(value);
            }
          },
          gridLines: {
            color: "rgb(234, 236, 244)",
            zeroLineColor: "rgb(234, 236, 244)",
            drawBorder: false,
            borderDash: [2],
            zeroLineBorderDash: [2]
          }
        }],
      },
      legend: {
        display: false
      },
      tooltips: {
        titleMarginBottom: 10,
        titleFontColor: '#6e707e',
        titleFontSize: 14,
        backgroundColor: "rgb(255,255,255)",
        bodyFontColor: "#858796",
        borderColor: '#dddfeb',
        borderWidth: 1,
        xPadding: 15,
        yPadding: 15,
        displayColors: false,
        caretPadding: 10,
        callbacks: {
          label: function(tooltipItem, chart) {
            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            return datasetLabel + ': ' + number_format(tooltipItem.yLabel);
          }
        }
      },
    }
  });
</script>
<script>
  //Column Bar
  google.charts.load('current', {
    'packages': ['bar']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['HW', 'PC', 'Printer'],
      [<?= $datattbar; ?>],
      [<?= $datattbar2; ?>],
      [<?= $datattbar3; ?>]
    ]);

    var options = {
      chart: {
        title: 'Report Issues HW',

      },
      bars: 'vertical',
      vAxis: {
        format: 'decimal'
      },
      height: 400,
      colors: ['#1b9e77', '#d95f02', '#7570b3']
    };


    var chart = new google.charts.Bar(document.getElementById('chart_div'));

    chart.draw(data, google.charts.Bar.convertOptions(options));
  }
</script>
<script>
  //Column Bar
  google.charts.load('current', {
    'packages': ['bar']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['SW', 'HIS', 'RROP', 'SAP', 'CAgent', 'Windows', 'Adobe'],
      [<?= $datattbarsw; ?>],
      [<?= $datattbarsw2; ?>],
    ]);

    var options = {
      chart: {
        title: 'Report Issues SW'
      },
      bars: 'vertical',
      vAxis: {
        format: 'decimal'
      },
      height: 400,
      colors: ['#1b9e77', '#d95f02', '#7570b3']
    };

    var chart = new google.charts.Bar(document.getElementById('chart_div2'));

    chart.draw(data, google.charts.Bar.convertOptions(options));


  }
</script>
@endsection