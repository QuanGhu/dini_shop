@extends('master.index')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger alert-error">
        <div class="container">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
@if(Session::has('success'))
    <div class="alert alert-success">
        <div class="container">
            <strong>Success!</strong> {{ Session::get('success') }}
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead class="text-primary">
                        <th>No</th>
                        <th>Nomor Order</th>
                        <th>Email Customer</th>
                        <th>Nama Pemesan</th>
                        <th>Alamat Pemesan</th>
                        <th>Status</th>
                        <th></th>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script type="text/javascript">
        $(document).ready(function(){
            var dt = $('#dataTable').DataTable({
                orderCellsTop: true,
                responsive: true,
                processing: true,
                serverSide: true,
                searching: true,
                autoWidth: false,
                ajax: {
                        url :'{{ route('order.list') }}',
                        data: { '_token' : '{{csrf_token() }}'},
                        type: 'POST',
                },
                columns: [
                    { data: 'DT_Row_Index', orderable: false, searchable: false, "width": "30px"},
                    { data: 'order_number', name: 'order_number' },
                    { data: 'customer_email', name: 'customer_email'},
                    { data: 'fullname', name: 'fullname'},
                    { data: 'address', name: 'address'},
                    { data: 'status', name: 'status'},
                    { data: 'action', name: 'action', "width": "100p" },
                ]
            });
        });
    </script>
@endpush