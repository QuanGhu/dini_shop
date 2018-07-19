@extends('master.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-6">
                    <b><p> Nomor Order : {{$data->order_number}}</p></b>
                    <p>Nama Pemesan : {{$data->fullname}}</p>
                    <p>Alamat : {{$data->address}}</p>
                    <p>Email Pemesan : {{$data->user->email}}</p>
                </div>
                <div class="col-md-6">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Proses</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead class="text-primary">
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga </th>
                        <th>Jumlah Pemesanan</th>
                        <th>Total Harga</th>
                    </thead>
                    <tbody>
                        <?php $i = 1; $total = 0?>
                        @foreach($orders as $order)
                            <?php $total += $order->total_price ?>
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$order->product_name}}</td>
                                <td>Rp {{number_format($order->product_price, 0,'.','.')}}</td>
                                <td>{{$order->qty}}</td>
                                <td>Rp {{number_format($order->total_price, 0,'.','.')}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total</td>
                            <td>Rp {{number_format($total, 0, '.', '.')}}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
        $(document).ready(function(){
            
        });
    </script>
@endpush