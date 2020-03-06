@extends('admin.admin_template')
@section('tittle','Create Printer Device')

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-tittle"> Edit Device</h3>
    <div class="box-tools pull-right">

        <!-- Collapse Button -->
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
        </button>
    </div>
</div>
    
    <div class="box-body">
        {!! Form::model($device, ['method'=>'PATCH','route'=>['device.update',$device->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                {{-- <div class="form-group">
                    <strong>Machine Number:</strong>
                   
                    {!! Form::select('machine_number', $machine,$device->id_machine, ['class' => 'form-control','id' =>'machine_number','placeholder'=> 'Select Machine']) !!}
                    
                </div> --}}
                <div class="form-group">
                    <strong>Device Type:</strong>
                    {{-- {!! Form::text('device_type', null, ['class' => 'form-control','placeholder'=>'Old Asset','style' => 'text-transform:uppercase','id'=>'device_type']) !!} --}}
                    {!! Form::select('device_type', ['Printer' => 'Printer','Scanner' => 'Scanner','HMI' =>'HMI','NMP' => 'NMP'], null, ['class' => 'form-control','placeholder'=>'Device Type','style' => 'text-transform:uppercase','id'=>'device_type']) !!}
                </div>
                <div class="form-group">
                    <strong>Model Type:</strong>
                    {{-- {!! Form::text('model_type', null, ['class' => 'form-control','placeholder'=>'Wireless / Cable / CL4NX / CL412E','style' => 'text-transform:uppercase','id'=>'model_type']) !!} --}}
                    <select name="model_type" id="model_type" class="form-control">
                        @foreach ($model_type as $item)
                            <option value="{{$item->model_type}}" data-chained="{{$item->device_type}}" {{$item->model_type == $device->model_type ? 'selected':''}}>{{$item->model_type}}</option>
                        @endforeach
                        
                    </select>
                </div>
                <div class="form-group">
                    <strong>Type:</strong>
                    <select name="detail_type" id="detail_type" class="form-control">
                        @foreach ($detail_type as $item)
                            <option value="{{$item->detail_type}}" data-chained="{{$item->model_type}}" {{$item->detail_type == $device->detail_type ? 'selected':''}}>{{$item->detail_type}}</option>
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

