@extends('admin.admin_template')
@section('tittle','Create Printer Device')

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-tittle"> Create New Device</h3>
    <div class="box-tools pull-right">

        <!-- Collapse Button -->
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
        </button>
    </div>
</div>
    
    <div class="box-body">
        {!! Form::open(array('route'=>'device.store','method'=>'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                
                <div class="form-group">
                    <strong>Device Type:</strong>
                    {{-- {!! Form::text('device_type', null, ['class' => 'form-control','placeholder'=>'Old Asset','style' => 'text-transform:uppercase','id'=>'device_type']) !!} --}}
                    {!! Form::select('device_type', ['Printer' => 'Printer','Scanner' => 'Scanner','NMP' => 'NMP','HMI' => 'HMI'], null, ['class' => 'form-control','placeholder'=>'Device Type','id'=>'device_type']) !!}
                </div>
                <div class="form-group">
                    <strong>Model Type:</strong>
                    {{-- {!! Form::text('model_type', null, ['class' => 'form-control','placeholder'=>'Wireless / Cable / CL4NX / CL412E','style' => 'text-transform:uppercase','id'=>'model_type']) !!} --}}
                    {{-- {!! Form::select('model_type', ['Wireless' => 'Wireless','Cable' => 'Cable','CL4NX'=>'CL4NX','CL412E' => 'CL412E'], null, ['class' => 'form-control','id'=>'model_type']) !!} --}}
                    <select name="model_type" id="model_type" class="form-control">
                        @foreach ($model_type as $item)
                            <option value="{{$item->model_type}}" data-chained="{{$item->device_type}}" >{{$item->model_type}}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="form-group">
                    <strong>Detail Type:</strong>
                    <select name="detail_type" id="detail_type" class="form-control">
                        @foreach ($detail_type as $item)
                            <option value="{{$item->detail_type}}" data-chained="{{$item->model_type}}" >{{$item->detail_type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <strong>Device Status:</strong>
                    {{-- {!! Form::text('device_status', null, ['class' => 'form-control','placeholder'=>'Team','style' => 'text-transform:uppercase','id'=>'device_status']) !!} --}}
                    {!! Form::select('device_status', ['OK'=>'OK','Not OK' =>'Not OK','Not Installed' => 'Not Installed'], null, ['class' => 'form-control','style' => 'text-transform:uppercase','id'=>'device_status']) !!}
                </div>
                
                <div class="form-group">
                    <strong>Remark:</strong>
                    {!! Form::textarea('remark', null, ['class' => 'form-control','placeholder'=>'Remarks','style' => 'text-transform:uppercase','id'=>'remark']) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{route('device.index')}}" class="btn btn-default"> Back</a>
        <button type="submit" class="btn btn-primary pull-right"> Submit</button>
    </div>
</div>
{!! Form::close() !!}
@push('script')
<script>
$(document).ready(function(){
    $('#model_type').select2({
        allowClear: true,
        tags : true,
        /* Add this */
        placeholder: {
            id: "model_type",
            placeholder: "Select Model"
        },
    });
    $('#model_type').chained('#device_type');
    $('#detail_type').select2({
        allowClear: true,
        tags : true,
        /* Add this */
        placeholder: {
            id: "detail_type",
            placeholder: "Select Type"
        },
    });
    $('#detail_type').chained('#model_type');

});
</script>    
@endpush
@endsection

