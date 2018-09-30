<div class="row">
    <div class="col-12">
        <div class="white-box">
            <button type="button" class="btn btn-primary" id="btnPrint">
                Cetak Laporan
            </button>
        </div>
        <!-- /.card -->
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Order Number</th>
                        <th>Nama Pemesan</th>
                        <th>Alamat Pemesan</th>
                        <th>Total Harga Pesanan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $data)
                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$data->order_number}}</td>
                            <td>{{$data->fullname}}</td>
                            <td>{{$data->address}}</td>
                            <td>Rp {{ number_format($data->total_order,0,',','.') }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4">Jumlah</td>
                        <td> Rp {{ number_format($total_order,0,',','.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

<div id="printarea" style="display: none;">
    <style>
        h2 {
            margin-top: 10px;
            margin-bottom: 25px;
            text-align: center;
        }
        p {
            margin: 0 0 10px;
        }
        table.table-print {
            width: 100%;
            border: 1px solid #cacaca;
        }
        .text-center {
            text-align: center;
        }
        table.table-print tr td,
        table.table-print tr th {
            padding: 3px 20px;
            border: 1px solid #cacaca;  
        }
        
    </style>
    <h2>Laporan Bulanan</h2>
    <table class="table-print">
        <thead>
            <tr>
                <th>No</th>
                <th>Order Number</th>
                <th>Nama Pemesan</th>
                <th>Alamat Pemesan</th>
                <th>Total Harga Pesanan</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $key => $data)
                <tr>
                    <td>{{$key + 1}}</td>
                    <td>{{$data->order_number}}</td>
                    <td>{{$data->fullname}}</td>
                    <td>{{$data->address}}</td>
                    <td>{{$data->total_order}}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">Jumlah</td>
                <td> Rp {{ number_format($total_order,0,',','.') }}</td>
            </tr>
        </tfoot>
    </table>
</div>

<script type="text/javascript">
    $(function () {
        $("#btnPrint").click(function () {
            var prtContent = document.getElementById("printarea");
            var WinPrint = window.open();
            WinPrint.document.write( "<link rel='stylesheet' href='{{asset('web/plugins/bootstrap/css/bootstrap.css') }}' type='text/css' media='print'/>" );
            WinPrint.document.write(prtContent.innerHTML);
            WinPrint.document.close();
            WinPrint.focus();
            WinPrint.print();
            WinPrint.close();
        });
    });
</script>