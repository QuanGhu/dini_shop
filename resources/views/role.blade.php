@extends('master.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">Tambah Data</button>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable">
                    <thead class="text-primary">
                        <th>No</th>
                        <th>Nama Hak Akses</th>
                        <th></th>
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
                <label for="email">Nama Hak Akses </label>
                {{ Form::text('name', NULL ,['class' => 'form-control']) }}
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
                <label for="email">Nama Hak Akses </label>
                {{ Form::hidden('id', NULL ,['class' => 'form-control', 'id' => 'id']) }}
                {{ Form::text('name', NULL ,['class' => 'form-control', 'id' => 'edit_name']) }}
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
                            url :'{{ route('role.list') }}',
                            data: { '_token' : '{{csrf_token() }}'},
                            type: 'POST',
                    },
                    columns: [
                        { data: 'DT_Row_Index', orderable: false, searchable: false, "width": "30px"},
                        { data: 'name', name: 'name' },
                        { data: 'action', name: 'action', "width": "390px" },
                    ]
                });

                $('table#dataTable tbody').on( 'click', 'td>button', function (e) {
                    var parent = $(this).parent().get( 0 );
                    var parent1 = $(parent).parent().get( 0 );
                    var row = dt.row(parent1);
                    var data = row.data();

                    if($(this).hasClass('edit')) {
                        $('input#id').val(data.id);
                        $('input#edit_name').val(data.name);
                        setFormEdit();
                    }
                });
        });
        $('#form-add').validate({
	        rules: {
	            name: {
	                required: true
                }
	        },
	        submitHandler: function (form,e) {
	            e.preventDefault();
	            $.ajax({
	                    method: 'POST',
	                    headers: {
	                        'X-CSRF-Token': $('input[name="_token"]').val()
	                    },
	                    url: "{{ route('role.save') }}",
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
                }
	        },
	        submitHandler: function (form,e) {
	            e.preventDefault();
	            $.ajax({
	                    method: 'PUT',
	                    headers: {
	                        'X-CSRF-Token': $('input[name="_token"]').val()
	                    },
	                    url: "{{ route('role.update') }}",
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

        function setFormEdit() {
            $('#editModal').modal('show');
        }
    </script>
@endpush