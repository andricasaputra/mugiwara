@extends('layouts.main')

@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-block">

                	
                    <div class="row">
                          <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                              <div class="card-body">
                                <p class="card-title mb-0">Transaction Detail</p>
                                <div class="table-responsive">
                                  <table class="table table-striped table-borderless">
                                    <thead>
                                      <tr>
                                        <th>Transaction ID</th>
                                        <th>Product ID</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Channel Category</th>
                                        <th>Channel Coode</th>
                                        <th>Reference ID</th>
                                        <th>Account Identifier</th>
                                        <th>Currency</th>
                                        <th>Amount</th>
                                        <th>Net Amount</th>
                                        <th>Cashflow</th>
                                        <th>Settlement Status</th>
                                        <th>Estimated Settlement Time</th>
                                        <th>Bussiness ID</th>
                                        <th>Created</th>
                                        <th>Fee</th>
                                      </tr>  
                                    </thead>
                                    <tbody>
                                      <tr>
                                        <td>{{ $transaction['id'] }}</td>
                                        <td>{{ $transaction['product_id'] }}</td>
                                        <td>{{ $transaction['type'] }}</td>
                                        <td>{{ $transaction['status'] }}</td>
                                        <td>{{ $transaction['channel_category'] }}</td>
                                        <td>{{ $transaction['channel_code'] }}</td>
                                        <td>{{ $transaction['reference_id'] }}</td>
                                        <td>{{ $transaction['account_identifier'] }}</td>
                                        <td>{{ $transaction['currency'] }}</td>
                                        <td>{{ $transaction['amount'] }}</td>
                                        <td>{{ $transaction['net_amount'] }}</td>
                                        <td>{{ $transaction['cashflow'] }}</td>
                                        <td>{{ $transaction['settlement_status'] }}</td>
                                        <td>{{ $transaction['estimated_settlement_time'] }}</td>
                                        <td>{{ $transaction['business_id'] }}</td>
                                        <td>{{ $transaction['created'] }}</td>
                                        <td>{{ $transaction['fee']['xendit_fee'] }}</td>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      <div class="d-flex justify-content-center">
                            <a href="{{ route('admin.finance.transaction.list') }}" class="btn btn-danger">Kembali</a>
                      </div>
                </div>
            </div>
        </div>
    </div>
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