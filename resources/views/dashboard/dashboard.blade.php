@extends('dashboard.layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
        <div class="container-fluid">
    <div class="row">
  <div class="col-12 col-xl-12 grid-margin stretch-card">
    <div class="card overflow-hidden">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
          <h6 class="card-title mb-0">Revenue</h6>
          <div class="dropdown">
            <button class="btn btn-link p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
            </div>
          </div>
        </div>
        <div class="row align-items-start mb-2">
          <div class="col-md-7">
            <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has from its normal business activities, usually from the sale of goods and services to customers.</p>
          </div>
          <div class="col-md-5 d-flex justify-content-md-end">
            <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
            </div>
          </div>
        </div>
        <div id="revenueChart"></div>
      </div>
    </div>
  </div>
</div> <!-- row -->

        <!-- /.content -->
</div>
</div>
</div>

@stop


@section('js')

    <script src="{{asset('js/plugins/chart/Chart.min.js')}}"></script>
    <script src="{{asset('js/dashboard/dashboard3.js')}}"></script>
    <!-- base js -->
    <script src="https://www.nobleui.com/laravel/template/demo1/js/app.js"></script>
    <script src="https://www.nobleui.com/laravel/template/demo1/assets/plugins/feather-icons/feather.min.js"></script>
    <script src="https://www.nobleui.com/laravel/template/demo1/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <!-- end base js -->

    <!-- plugin js -->
      <script src="https://www.nobleui.com/laravel/template/demo1/assets/plugins/flatpickr/flatpickr.min.js"></script>
  <script src="https://www.nobleui.com/laravel/template/demo1/assets/plugins/apexcharts/apexcharts.min.js"></script>
    <!-- end plugin js -->

    <!-- common js -->
    
    <!-- end common js -->

      
    <script>
    var revenueData = <?php echo json_encode($revenueData); ?>;
    var options = {
    chart: {
      type: 'line',
      height: 350,
      toolbar: {
        show: false
      }
    },
    series: [{
      name: 'Revenue',
      data: revenueData.map(function(item) {
        return item.revenue;
      })
    }],
    xaxis: {
      categories: revenueData.map(function(item) {
        return item.month;
      })
    }
  }

  var chart = new ApexCharts(
    document.querySelector("#revenueChart"),
    options
  );

  chart.render();
</script>

    <script type="text/javascript">
        @if(session('success'))
        toastr.success('{{session('success')}}', 'Login success !', {timeOut: 5000});
        @php session()->forget('success'); @endphp
        @endif
    </script>

    
    
@stop

@section('css')
<!-- plugin css -->
    <link href="https://www.nobleui.com/laravel/template/demo1/assets/fonts/feather-font/css/iconfont.css" rel="stylesheet" />
  <link href="https://www.nobleui.com/laravel/template/demo1/assets/plugins/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" />
  <!-- end plugin css -->

    <link href="https://www.nobleui.com/laravel/template/demo1/assets/plugins/flatpickr/flatpickr.min.css" rel="stylesheet" />

  <!-- common css -->
  <link href="https://www.nobleui.com/laravel/template/demo1/css/app.css" rel="stylesheet" />
  
  <!-- end common css -->
@stop


