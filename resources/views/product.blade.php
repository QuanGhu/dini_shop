@extends('master.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <button type="submit" class="btn btn-primary pull-right">Tambah Data<div class="ripple-container"></div></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>Nama Product</th>
                            <th>Nama Kategori</th>
                            <th>Harga</th>
                            <th>Jumlah Stok</th>
                            <th>Status</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection