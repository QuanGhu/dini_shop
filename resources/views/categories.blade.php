@extends('master.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
            <button type="submit" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">Tambah Data<div class="ripple-container"></div></button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-primary">
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Deskripsi</th>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Data</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        {!! Form::open(['class' => 'validate', 'id' => 'form-input']) !!}
            <div class="form-group">
                <label for="email">Nama Kategori </label>
                {{ Form::text('name', NULL ,['class' => 'form-control']) }}
            </div>
            <div class="form-group">
                <label for="pwd">Deskripsi </label>
                {{ Form::textarea('description', NULL ,['class' => 'form-control']) }}
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
</div>
@endsection