
@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12 grid-margin">
    <div class="row">
      <div class="col-12 col-xl-8 mb-4 mb-xl-0">
        <h3 class="font-weight-bold">Selamat datang {{ ucfirst(auth()->user()->name) }}</h3>
       {{--  <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></h6> --}}
      </div>
      <div class="col-12 col-xl-4">
       <div class="justify-content-end d-flex">
        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
          <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button" id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
           <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
          </button>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuDate2">
            <a class="dropdown-item" href="#">January - March</a>
            <a class="dropdown-item" href="#">March - June</a>
            <a class="dropdown-item" href="#">June - August</a>
            <a class="dropdown-item" href="#">August - November</a>
          </div>
        </div>
       </div>
      </div>
    </div>
  </div>
</div>
{{-- @dd(auth()->user()->notifications) --}}
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card tale-bg">
      <div class="card-people mt-0">
        <img src="{{ asset('storage/misc/hotel.png') }}" alt="people">
        <div class="weather-info">
          {{-- <div class="d-flex">
            <div>
              <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i>31<sup>C</sup></h2>
            </div>
            <div class="ml-2">
              <h4 class="location font-weight-normal">Bangalore</h4>
              <h6 class="font-weight-normal">India</h6>
            </div>
          </div> --}}
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin transparent">
    <div class="row">
      <div class="col-md-6 mb-4 stretch-card transparent">
        <div class="card card-tale">
          <a href="{{ route('admin.point.index') }}" style="text-decoration: none; color: #fff">
            <div class="card-body">
              <p class="mb-2">Total Point</p>
              <p class="fs-10 mb-2">
                
                  {{ number_format($points->first()?->total_point, 2, ',', '.') }}
                
              </p>
              <p>Dari {{ $points->first()?->total_account }} Akun</p>
            </div>
          </a>
        </div>
      </div>
      <div class="col-md-6 mb-2 stretch-card transparent">
        <div class="card card-dark-blue">
          <div class="card-body">
            <p class="mb-2">Point Masuk : {{ number_format($pointins->sum('mutation') , 2, ',', '.') }}</p>
            <p class="mb-2">Point Keluar : {{ number_format($pointouts->sum('mutation') , 2, ',', '.')  }}</p>
             
           {{--  <p>22.00% (30 days)</p> --}}
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
        <div class="card card-light-blue">
          <div class="card-body">
            <p class="mb-4">Total Pesanan</p>
            <p class="fs-30 mb-2">{{ $bookings->count() }}</p>
            {{-- <p>2.00% (30 days)</p> --}}
          </div>
        </div>
      </div>
      <div class="col-md-6 stretch-card transparent">
        <div class="card card-light-danger">
          <div class="card-body">
            <p class="mb-4">Pesanan Hari Ini</p>
            <p class="fs-30 mb-2">{{ $todaybookings->count() }}</p>
           {{--  <p>0.22% (30 days)</p> --}}
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <p class="card-title inline-block">Jumlah Order</p>
            </div>
            <div class="form-inline">
                 <label for="date">Pilih</label>
                  <select name="date" id="date_order" class="form-control" style="width: 200px; font-weight: bold">
                    <option value="today">Harian</option>
                    <option value="week">Mingguan</option>
                    <option value="month">Bulanan</option>
                    <option value="year">Tahunan</option>
                  </select>
            </div>  
         </div>

        <p class="font-weight-500">Dibawah ini merupakan grafik untuk jumlah order/booking</p>
        <div id="order-legend" class="chartjs-legend mt-4 mb-2"></div>
        <div id="order-canvas">
          <canvas id="order-chart" width="400" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <p class="card-title inline-block">Jumlah Poin</p>
            </div>
            <div class="form-inline">
                 <label for="date">Pilih</label>
                  <select name="date_point" id="date_point" class="form-control" style="width: 200px; font-weight: bold">
                    <option value="month">Bulanan</option>
                    <option value="year">Tahunan</option>
                  </select>
            </div>  
         </div>

        <p class="font-weight-500">Dibawah ini merupakan grafik jumlah point yang keluar dan masuk</p>
        <div id="point-legend" class="chartjs-legend mt-4 mb-2"></div></p>
        <div id="point-canvas">
          <canvas id="point-chart" width="400" height="300"></canvas>
        </div>
        
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-6 offset-md-3 grid-margin stretch-card">
    <div class="card">
      <div class="card-body">
          <div class="d-flex justify-content-between">
            <div>
              <p class="card-title inline-block">Jumlah Pembayaran</p>
            </div>
            <div class="form-inline">
                 <label for="date">Pilih</label>
                  <select name="date" id="date_finance" class="form-control" style="width: 200px; font-weight: bold">
                    <option value="today">Harian</option>
                    <option value="week">Mingguan</option>
                    <option value="month">Bulanan</option>
                    <option value="year">Tahunan</option>
                  </select>
            </div>  
         </div>

        <p class="font-weight-500">Dibawah ini merupakan grafik untuk jumlah pembayaran yang berhasil dibayarkan</p>
        <div id="finance-canvas">
          <canvas id="finance-chart" width="300" height="300"></canvas>
        </div>
      </div>
    </div>
  </div>

</div>


@endsection


@section('scripts')

  <script>

    function monthName(mon) {
      return ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
      ][mon - 1];
    }

    const token = '{{ csrf_token() }}';
    const orderUrl = '{{ route('admin.dashboard.orderchart') }}';
    const pointUrl = '{{ route('admin.dashboard.pointchart') }}';
    const financeUrl = '{{ route('admin.dashboard.financechart') }}';
  </script>

  <script src="{{ asset('assets/js/finance-chart.js') }}"></script>

  <script src="{{ asset('assets/js/point-chart.js') }}"></script>

  <script src="{{ asset('assets/js/order-chart.js') }}"></script>

  <script>
    
    let financeCanvas = document.getElementById('finance-chart').getContext('2d');
   
    $('#date_finance').change(function(){

      const date = $('#date_finance').val();

      $('#finance-chart').remove();

      $('#finance-canvas').html( `<canvas id="finance-chart" width="300" height="300"></canvas>`);

      financeCanvas = $('#finance-chart');

      if(date == 'month'){

        getDataFinance(financeUrl, token, date, 'month');

      } else{

        getDataFinance(financeUrl, token, date);
      }

    });

    getDataFinance(financeUrl, token, '{{ today() }}');

  </script>

  <script>
    
    let pointCanvas = document.getElementById('point-chart').getContext('2d');

    getDataPoint(pointUrl, token, 'month', 'month');

    $('#date_point').change(function(){

      const date = $('#date_point').val();

      $('#point-chart').remove();

      $('#point-canvas').html( `<canvas id="point-chart" width="400" height="300"></canvas>`);

      pointCanvas = $('#point-chart');

      // cast month number to month name, eg => 8 to august
      if(date == 'month'){

        getDataPoint(pointUrl, token, date, 'month');

      } else{

        getDataPoint(pointUrl, token, date);
      }

    });

  </script>

  <script>
    
    let orderCanvas = document.getElementById('order-chart').getContext('2d');

    $('#date_order').change(function(){

      const date = $('#date_order').val();

      $('#order-chart').remove();

      $('#order-canvas').html( `<canvas id="order-chart" width="400" height="300"></canvas>`);

      orderCanvas = $('#order-chart');

      if(date == 'month'){

        getDataOrder(orderUrl, token, date, 'month');

      } else{

        getDataOrder(orderUrl, token, date);
      }

    });

    getDataOrder(orderUrl, token, '{{ today() }}');

  </script>

@endsection

