@extends('dashboard.layouts.app')
@section('title', 'Statstic')
@section('css')

    <link rel="stylesheet" href="{{asset('css/plugins/datatables/buttons.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/datatables/responsive.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/plugins/sweetalert2/sweetalert2.min.css')}}">

    <style>
  .big-number {
    font-size: 36px;
    font-weight: bold;
  }
</style>
@stop

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Statstic</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<div class="container-fluid">

  <h1 class="h3 mb-2 text-gray-800">Sales Statistics</h1>

  <!-- Sales Statistics Filters -->
  <div class="row">
    <div class="col-md-4">
      <form action="{{ route('admin.statistic.index') }}" method="GET">
        <div class="form-group">
          <label for="days_ago">Days Ago</label>
          <select class="form-control" id="days_ago" name="days_ago">
            <option value="7" {{ $daysAgo == 7 ? 'selected' : '' }}>7 days ago</option>
            <option value="30" {{ $daysAgo == 30 ? 'selected' : '' }}>30 days ago</option>
            <option value="90" {{ $daysAgo == 90 ? 'selected' : '' }}>90 days ago</option>
          </select>
        </div>
        <div class="form-group">
          <label for="interval">Interval</label>
          <select class="form-control" id="interval" name="interval">
            <option value="daily" {{ $selectedInterval == 'daily' ? 'selected' : '' }}>Daily</option>
            <option value="weekly" {{ $selectedInterval == 'weekly' ? 'selected' : '' }}>Weekly</option>
            <option value="monthly" {{ $selectedInterval == 'monthly' ? 'selected' : '' }}>Monthly</option>
          </select>
        </div>
        <button type="submit" class="btn btn-primary">Filter</button>
      </form>
    </div>
  </div>

  <hr>

  <!-- Sales Statistics Summary -->
  <div class="row">
    <div class="col-md-4">
    <div class="card">
  <div class="card-body">
    <h5 class="card-title"><i class="fas fa-dollar-sign"></i>Total Sales</h5>
    <p class="card-text big-number"> {{ $totalSales }} VND</p>
  </div>
</div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-shopping-cart"></i> Number of Sales</h5>
          <p class="card-text big-number">{{ $numberOfSales }}</p>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"><i class="fas fa-chart-line"></i> Average Sales</h5>
          <p class="card-text big-number">{{ $averageSales }} VND</p>
        </div>
      </div>
    </div>
</div>


  <hr>

  <!-- Sales Chart -->
  <div class="row mt-4">
    <div class="col-md-12">
      <canvas id="salesChart"></canvas>
    </div>
  </div>

</div>

</div>
@stop



@section('js')

<!-- DataTables  & Plugins -->
<script src="{{asset('js/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
<script src="{{asset('js/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{asset('js/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{asset('js/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{asset('js/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('js/plugins/datatables/buttons.colVis.min.js')}}"></script>
<script src="{{asset('js/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
<script src="{{asset('js/plugins/chart/chart.min.js')}}"></script>


<script>
    var ctx = document.getElementById('salesChart').getContext('2d');
    var chartData =  @json($chartData);
    var chartLabels =  @json($chartLabels);

    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [{
                label: 'Total Sales',
                data: chartData,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true,
                        callback: function(value, index, values) {
                            if(parseInt(value) >= 1000){
                                return  value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                            } else {
                                return value;
                            }
                        }
                    }
                }]
            },
            plugins: {
                title: {
                    display: true,
                    text: 'Sales Report',
                    font: {
                        size: 16,
                        weight: 'bold'
                    }
                },
                legend: {
                    display: true,
                    position: 'bottom',
                    labels: {
                        font: {
                            size: 14,
                            weight: 'bold'
                        }
                    }
                }
            }
        }
    });
</script>
@stop

