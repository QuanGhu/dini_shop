<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
    </head>
    <body>
        <h2>Order Telah Di Proses</h2>

        <div>
           Order Anda Dengan No {{$data->order_number}} Telah Di Proses
        </div>
        <br /> <br />
        <div>
            Detail Pesanan Anda :
            <p>Nama Pemesan : {{ $data->fullname }} </p>
            <p>Alamat Pemesan : {{ $data->address }} </p>
            <p>Barang Yang Dipesan : </p>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Produk</td>
                        <td>Harga Produk</td>
                        <td>Banyak Pemesanan</td>
                        <td>Total</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data->order as $key => $order)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$order->product_name}}</td>
                            <td>{{$order->product_price}}</td>
                            <td>{{$order->qty}}</td>
                            <td>{{$order->total_price}}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>Jumlah</td>
                        <td colspan="4">{{$data->total_order}}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </body>
</html>