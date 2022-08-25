@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                	 <div class="row">
                      <div class="col-md-12 stretch-card grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <p class="card-title mb-0">Order Detail</p>
                            <div class="table-responsive">
                              <table class="table table-borderless">
                                <thead>
                                  <tr>
                                    <th class="pl-0  pb-2 border-bottom">Kode Booking</th>
                                    <th class="border-bottom pb-2">Penginapan</th>
                                    <th class="border-bottom pb-2">Kamar</th>
                                    <th class="border-bottom pb-2">Tamu</th>
                                    <th class="border-bottom pb-2">Check In</th>
                                    <th class="border-bottom pb-2">Lama Menginap</th>
                                    <th class="border-bottom pb-2">Check out</th>
                                    <th class="border-bottom pb-2">Jumlah Tamu</th>
                                    <th class="border-bottom pb-2">Diskon</th>
                                    <th class="border-bottom pb-2">Voucher</th>
                                    <th class="border-bottom pb-2">Total Harga Setelah Diskon</th>
                                    <th class="border-bottom pb-2">Pesanan Dibuat Pada</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                     <td class="border-bottom pb-2">{{ $payment->booking_code }}</td>
                                      <th class="border-bottom pb-2">{{ $payment->order?->accomodation?->name }}</th>
                                    <td class="border-bottom pb-2">
                                      Nomor : {{ $payment->order?->room?->room_number }}
                                      <br>
                                      Tipe : {{ $payment->order?->room?->type->name }}
                                    </td>
                                    <td class="border-bottom pb-2">{{ $payment->user->name }}</td>
                                    <td class="border-bottom pb-2">{{ $payment->order?->check_in_date }}</td>
                                    <td class="border-bottom pb-2">{{ $payment->order?->stay_day }}</td>
                                    <td class="border-bottom pb-2">{{ $payment->order?->check_out_date }}</td>
                                    <td class="border-bottom pb-2">{{ $payment->order?->total_guest }}</td>
                                    <td class="border-bottom pb-2">{{ $payment->order?->discount_amount }}</td>
                                    <td class="border-bottom pb-2">{{ $payment->voucher?->name ?? '-'}}</td>
                                    <td class="border-bottom pb-2">{{ $payment->order?->total_price }}</td>
                                    <td class="border-bottom pb-2">{{ $payment->order?->created_at }}</td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>
                      </div>


                    </div>

                </div>
            </div>
        </div>
    </div>

    @if($payment->payable_type == \App\Models\Payments\Ewallet::class)

       <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                   <div class="row">
                      <div class="col-md-12 stretch-card grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <p class="card-title mb-0">Payment Detail (E-Wallet)</p>
                            <div class="table-responsive">
                             
                              <table class="display expandable-table table-striped" style="width:100%">
                                <tr>
                                    <td>Order ID</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->order_id }}</td>
                                </tr>
                                <tr>
                                    <td>E-Wallet ID</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->ewallet_id }}</td>
                                </tr>

                                <tr>
                                    <td>Channel Code</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->channel_code }}</td>
                                </tr>

                                <tr>
                                    <td>Mobile Number</td>
                                    <td>:</td>
                                    <td>{{ $payment->payablemobile_numbername }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Payment Time</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($payment->payable->payment_time)) }}</td>
                                </tr>

                            </table>

                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                     <div class="d-flex justify-content-center">
                            <a href="{{ route('employee.finance.index') }}" class="btn btn-danger">Kembali</a>
                      </div>
                    
                </div>
            </div>
        </div>
    </div>

    @else

      <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                   <div class="row">
                      <div class="col-md-12 stretch-card grid-margin">
                        <div class="card">
                          <div class="card-body">
                            <p class="card-title mb-0">Payment Detail (Virtual Account)</p>
                            <div class="table-responsive">
                             
                              <table class="display expandable-table table-striped" style="width:100%">
                                <tr>
                                    <td>Order ID</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->order_id }}</td>
                                </tr>
                                <tr>
                                    <td>External ID</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->external_id }}</td>
                                </tr>
                                <tr>
                                    <td>Owner ID</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->owner_id }}</td>
                                </tr>
                                <tr>
                                    <td>Bank Code</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->bank_code }}</td>
                                </tr>
                                <tr>
                                    <td>Merchant Code</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->merchant_code }}</td>
                                </tr>
                                <tr>
                                    <td>Account Number</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->account_number }}</td>
                                </tr>
                                <tr>
                                    <td>Name</td>
                                    <td>:</td>
                                    <td>{{ $payment->payable->name }}</td>
                                </tr>
                                
                                <tr>
                                    <td>Payment Time</td>
                                    <td>:</td>
                                    <td>{{ date('d-m-Y H:i:s', strtotime($payment->payable->payment_time)) }}</td>
                                </tr>

                            </table>

                            </div>
                          </div>
                        </div>
                      </div>

                    </div>

                     <div class="d-flex justify-content-center">
                            <a href="{{ route('employee.finance.index') }}" class="btn btn-danger">Kembali</a>
                      </div>
                    
                </div>
            </div>
        </div>
    </div>

    @endif

</div>
   
@endsection

@section('link')
    <style>
        .pagination {
          display: inline-block;
        }

        .pagination a {
          color: black;
          float: left;
          padding: 8px 16px;
          text-decoration: none;
        }

        .pagination a.active {
          background-color: #4CAF50;
          color: white;
          border-radius: 5px;
        }

        .pagination a:hover:not(.active) {
          background-color: #ddd;
          border-radius: 5px;
        }
</style>
@endsection



@section('scripts')
    <script>
        $('.confirm').on('click', function (e) {
            if (confirm('Apakah anda yakin akan menghapus data ini?')) {
                return true;
            }
            else {
                return false;
            }
        });

    </script>
@endsection()