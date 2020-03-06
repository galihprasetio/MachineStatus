@extends('admin.admin_template')
@section('tittle','Show Scanner Device')

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-tittle"> Show Scanner Device</h3>
    <div class="box-tools pull-right">

        <!-- Collapse Button -->
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
        </button>
    </div>
</div>
    
    <div class="box-body">
        {!! Form::model($scanner, ['method'=>'PATCH','route'=>['scanner.update',$scanner->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Machine Number:</strong>
                    {!! Form::text('machine_number', null, ['class' => 'form-control','placeholder'=>'Machine Number','style' => 'text-transform:uppercase','id'=>'machine_number','readonly']) !!}
                </div>
                {{-- <div class="form-group">
                    <strong>Device Type:</strong>
                    {!! Form::text('device_type', null, ['class' => 'form-control','placeholder'=>'Old Asset','style' => 'text-transform:uppercase','id'=>'device_type','readonly']) !!}
                </div> --}}
                <div class="form-group">
                    <strong>Model Type:</strong>
                    {!! Form::text('model_type', null, ['class' => 'form-control','placeholder'=>'New Asset','style' => 'text-transform:uppercase','id'=>'model_type','readonly']) !!}
                </div>
                <div class="form-group">
                    <strong>Device Status:</strong>
                    {!! Form::text('device_status', null, ['class' => 'form-control','placeholder'=>'Team','style' => 'text-transform:uppercase','id'=>'device_status','readonly']) !!}
                </div>
                
                <div class="form-group">
                    <strong>Remark:</strong>
                    {!! Form::textarea('remark', null, ['class' => 'form-control','placeholder'=>'Remarks','style' => 'text-transform:uppercase','id'=>'remark','readonly']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{route('scanner.index')}}" class="btn btn-default"> Back</a>
       
    </div>
</div>
{!! Form::close() !!}
@endsection
