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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Data</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
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
<div class="modal" id="addModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['class' => 'validate', 'id' => 'form-add']) !!}
            <div class="form-group">
                <label for="email">Nama Produk </label>
                {{ Form::text('name', NULL ,['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Nama Kategori </label>
                {{ Form::select('categories_id', $categories, null, ['placeholder' => 'Pilih Kategori', 'class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Harga Produk </label>
                {{ Form::text('price', NULL ,['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="email">Stok Produk </label>
                {{ Form::text('stock', NULL ,['class' => 'form-control']) }}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div class="modal" id="editModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['class' => 'validate', 'id' => 'form-edit']) !!}
            <div class="form-group">
                <label for="email">Nama Produk </label>
                {{ Form::hidden('id', NULL ,['class' => 'form-control', 'id' => 'id']) }}
                {{ Form::text('name', NULL ,['class' => 'form-control', 'id' => 'edit_name']) }}
            </div>
            <div class="form-group">
                <label for="email">Nama Kategori </label>
                {{ Form::select('categories_id', $categories, null, ['placeholder' => 'Pilih Kategori', 'class' => 'form-control', 'id' => 'edit_categories']) }}
            </div>
            <div class="form-group">
                <label for="email">Harga Produk </label>
                {{ Form::text('price', NULL ,['class' => 'form-control', 'id' => 'edit_price']) }}
            </div>
            <div class="form-group">
                <label for="email">Stok Produk </label>
                {{ Form::text('stock', NULL ,['class' => 'form-control', 'id' => 'edit_stock']) }}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>

<div class="modal" id="imageModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add / Change Image</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['class' => 'validate', 'id' => 'form-image', 'enctype' => 'multipart/form-data', 'route' => 'product.upload', 'method' => 'PUT' ]) !!}
            <div class="form-group">
                <label for="email">File Image </label>
                {{ Form::hidden('id', NULL ,['class' => 'form-control', 'id' => 'id']) }}
                {{ Form::file('image',['class' => 'form-control', 'id' => 'image']) }}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        {!! Form::close() !!}
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
                            url :'{{ route('product.list') }}',
                            data: { '_token' : '{{csrf_token() }}'},
                            type: 'POST',
                    },
                    columns: [
                        { data: 'DT_Row_Index', orderable: false, searchable: false, "width": "30px"},
                        { data: 'name', name: 'name' },
                        { data: 'categories', name: 'categories' },
                        { data: 'price', name: 'price' },
                        { data: 'stock', name: 'stock' },
                        { data: 'action', name: 'action', "width": "390px" },
                    ]
                });

                $('table#dataTable tbody').on( 'click', 'td>button', function (e) {
                    var parent = $(this).parent().get( 0 );
                    var parent1 = $(parent).parent().get( 0 );
                    var row = dt.row(parent1);
                    var data = row.data();

                    if($(this).hasClass('delete')) {
                        $.confirm({
                            title: 'Delete Data!',
                            content: 'Are You Sure To Delete This Data ?',
                            buttons: {
                                confirm: function () {
                                    deleteData(data.id, $('input[name="_token"]').val(), "{{ route('product.delete') }}");
                                    $('#dataTable').DataTable().ajax.reload();
                                },
                                cancel: function () {
                                    // close
                                },
                            }
                        });
                    }else if($(this).hasClass('edit')) {
                        $('input#id').val(data.id);
                        $('#edit_name').val(data.name);
                        $('#edit_price').val(data.price);
                        $('#edit_categories').val(data.categories_id);
                        $('#edit_stock').val(data.stock);
                        setFormEdit();
                    } else {
                        $('input#id').val(data.id);
                        setFormImage();
                    }
                });
        });
        $('#form-add').validate({
	        rules: {
	            name: {
	                required: true
                },
                price : {
                    required: true,
                    digits: true
                },
                categories_id : {
                    required : true
                }, 
                stock : {
                    required: true,
                    number: true
                }
	        },
	        submitHandler: function (form,e) {
	            e.preventDefault();
	            $.ajax({
	                    method: 'POST',
	                    headers: {
	                        'X-CSRF-Token': $('input[name="_token"]').val()
	                    },
	                    url: "{{ route('product.save') }}",
	                    data: $('#form-add').serialize(),
	                    dataType: 'JSON',
	                    cache: false,
	                    beforeSend: function(){
	                        $('.preloader').show();
	                    },
	                    success: function(result) {
	                        $('#form-add')[0].reset();
	                        $('#dataTable').DataTable().ajax.reload();
	                        $('#addModal').modal('hide');
	                        $('.preloader').hide();
                    		if(result.status=='success'){
	                            notification('Data Successfully saved','success');
	                        }else {
	                            notification('Something Went Wrong','danger');
	                        }
                        },
                        error: function(error) {
                            console.log(error)
                        }
	            });
	            return false;
	        }
        });

        $('#form-edit').validate({
	        rules: {
	            name: {
	                required: true
                },
                price : {
                    required: true,
                    digits: true
                },
                categories_id : {
                    required : true
                }, 
                stock : {
                    required: true,
                    number: true
                }
	        },
	        submitHandler: function (form,e) {
	            e.preventDefault();
	            $.ajax({
	                    method: 'PUT',
	                    headers: {
	                        'X-CSRF-Token': $('input[name="_token"]').val()
	                    },
	                    url: "{{ route('product.update') }}",
	                    data: $('#form-edit').serialize(),
	                    dataType: 'JSON',
	                    cache: false,
	                    beforeSend: function(){
	                        $('.preloader').show();
	                    },
	                    success: function(result) {
	                        $('#form-edit')[0].reset();
	                        $('#dataTable').DataTable().ajax.reload();
	                        $('#editModal').modal('hide');
	                        $('.preloader').hide();
                    		if(result.status=='success'){
	                            notification('Data Successfully updated','success');
	                        }else {
	                            notification('Something Went Wrong','danger');
	                        }
                        },
                        error: function(error) {
                            console.log(error)
                        }
	            });
	            return false;
	        }
        });

        function notification(msg, type)
        {
            $.notify(msg, type);
        }

        function deleteData(id, token, url) {
            $.ajax({
                method: 'DELETE',
                headers: {
                    'X-CSRF-Token': token
                },
                url: url,
                dataType: 'JSON',
                cache: false,
                data: {id: id},
                beforeSend: function(){
                    $('.preloader').show();
                },
                success: function(result) {
                    $('#dataTable').DataTable().ajax.reload();
                    $('.preloader').hide();
                    if(result.status=='success'){
                        notification('Data Successfully Deleted','success');
                    }
                    else  {
                        notification('Something Went Wrong','danger');
                    }
                }
            });
        }
        function setFormEdit() {
            $('#editModal').modal('show');
        }
        function setFormImage() {
            $('#imageModal').modal('show');
        }
    </script>
@endpush