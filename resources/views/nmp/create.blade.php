@extends('admin.admin_template')
@section('tittle','Create NMP Device')

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-tittle"> Create NMP Device</h3>
    <div class="box-tools pull-right">

        <!-- Collapse Button -->
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
        </button>
    </div>
</div>
    
    <div class="box-body">
        {!! Form::open(array('route'=>'NMP.store','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Machine Number:</strong>
                    {{-- {!! Form::text('machine_number', null, ['class' => 'form-control','placeholder'=>'Machine Number','style' => 'text-transform:uppercase','id'=>'machine_number']) !!} --}}
                    {!! Form::select('machine_number', $machine,null, ['class' => 'form-control','id' =>'machine_number','placeholder'=> 'Select Machine']) !!}
                    
                </div>
                {{-- <div class="form-group">
                    <strong>Device Type:</strong>
                    {!! Form::text('device_type', null, ['class' => 'form-control','placeholder'=>'Old Asset','style' => 'text-transform:uppercase','id'=>'device_type']) !!}
                </div> --}}
                <div class="form-group">
                    <strong>Model Type:</strong>
                    {!! Form::text('model_type', null, ['class' => 'form-control','placeholder'=>'Model Type','style' => 'text-transform:uppercase','id'=>'model_type']) !!}
                </div>
                <div class="form-group">
                    <strong>Device Status:</strong>
                    {{-- {!! Form::text('device_status', null, ['class' => 'form-control','placeholder'=>'Team','style' => 'text-transform:uppercase','id'=>'device_status']) !!} --}}
                    {!! Form::select('device_status', ['OK'=>'OK','Not OK' =>'Not OK'], null, ['class' => 'form-control','style' => 'text-transform:uppercase','id'=>'device_status']) !!}
                </div>
                
                <div class="form-group">
                    <strong>Remark:</strong>
                    {!! Form::textarea('remark', null, ['class' => 'form-control','placeholder'=>'Remarks','style' => 'text-transform:uppercase','id'=>'remark']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{route('hmi.index')}}" class="btn btn-default"> Back</a>
        <button type="submit" class="btn btn-primary pull-right"> Submit</button>
    </div>
</div>
{!! Form::close() !!}
@push('script')
<script>
$(document).ready(function(){
    $('#machine_number').select2({
        allowClear: true,
        /* Add this */
        placeholder: {
            id: "machine_number",
            placeholder: "Select Machine"
        },
    });

});
</script>    
@endpush
@endsection

