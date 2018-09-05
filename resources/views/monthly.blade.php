@extends('master.index')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            {!! Form::open(['class' => 'validate', 'id' => 'form-monthly-report']) !!}
                <div class="row">
                    <div class="col-md-5">
                        <select name="month" class="form-control">
                            @php
                            for ($x = 1; $x <= 12; $x++) {
                                $mon = date('F', mktime(0,0,0,$x));
                                echo '<option value="'.$x.'" ';
                                if ($mon == date('F'))
                                {
                                echo 'selected';
                                }
                                echo' >'.$mon.'</option>';
                            }
                            @endphp
                        </select>
                    </div>
                    <div class="col-md-5">
                        <select name="year" class="form-control">
                            <option value="2018">2018</option>
                            <option value="2019">2019</option>
                            <option value="2020">2020</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-block btn-primary">Lihat Laporan</button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="reportresult"></div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    $(document).ready(function(){
        $('#form-monthly-report').submit(function(e){
            $('.page-loader-wrapper').show();
            e.preventDefault();
            getData("{{route('order.report.monthly')}}");
        });
        function getData(url) {
            $.ajax({
                url : url,
                data : $('#form-monthly-report').serialize(),
                type : "POST" 
            }).done(function (data) {
                $('.page-loader-wrapper').hide();
                $('.reportresult').html(data);  
            });
        }

    });
</script>
@endpush