@extends('admin.admin_template')
@section('tittle','Show NMP Device')

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-tittle"> Edit NMP Device</h3>
    <div class="box-tools pull-right">

        <!-- Collapse Button -->
        <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
        </button>
    </div>
</div>
    
    <div class="box-body">
        {!! Form::model($nmp, ['method'=>'PATCH','route'=>['nmp.update',$nmp->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Machine Number:</strong>
                    {!! Form::text('machine_number', null, ['class' => 'form-control','placeholder'=>'Machine Number','style' => 'text-transform:uppercase','id'=>'machine_number','readonly']) !!}
                    {{-- {!! Form::select('machine_number', $machine,$NMP->id_machine, ['class' => 'form-control','id' =>'machine_number','placeholder'=> '','readonly']) !!} --}}
                    
                </div>
                {{-- <div class="form-group">
                    <strong>Device Type:</strong>
                    {!! Form::text('device_type', null, ['class' => 'form-control','placeholder'=>'Old Asset','style' => 'text-transform:uppercase','id'=>'device_type']) !!}
                </div> --}}
                <div class="form-group">
                    <strong>Model Type:</strong>
                    {{-- {!! Form::text('model_type', null, ['class' => 'form-control','placeholder'=>'Model Type','style' => 'text-transform:uppercase','id'=>'model_type']) !!} --}}
                    <select name="model_type" id="model_type" class="form-control">
                            <option value="Null">Select Model</option>
                            @foreach ($model_type as $item)
                                <option value="{{$item->model_type}}"  {{$item->model_type == $nmp->model_type ? 'selected':''}}>{{$item->model_type}}</option>
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
        <a href="{{route('nmp.index')}}" class="btn btn-default"> Back</a>
        <button type="submit" class="btn btn-primary pull-right"> Submit</button>
    </div>
</div>
{!! Form::close() !!}
@push('script')
<script>
$(document).ready(function(){
    $('#model_type').select2({
        allowClear: true,
        tags:true,
        /* Add this */
        placeholder: {
            id: "model_type",
            placeholder: "Select Model"
        },
    });

});
</script>    
@endpush
@endsection

