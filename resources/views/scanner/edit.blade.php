@extends('admin.admin_template')
@section('tittle','Show Scanner Device')

@section('content')
<div class="box">
    <div class="box-header">
    <h3 class="box-tittle"> Edit Scanner Device</h3>
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
                    {{-- {!! Form::select('machine_number', $machine,$scanner->id_machine, ['class' => 'form-control','id' =>'machine_number','placeholder'=> '','readOnly']) !!} --}}
                    
                </div>
                {{-- <div class="form-group">
                    <strong>Device Type:</strong>
                    {!! Form::text('device_type', null, ['class' => 'form-control','placeholder'=>'Old Asset','style' => 'text-transform:uppercase','id'=>'device_type']) !!}
                </div> --}}
                <div class="form-group">
                    <strong>Model Type:</strong>
                    {{-- {!! Form::text('model_type', null, ['class' => 'form-control','placeholder'=>'New Asset','style' => 'text-transform:uppercase','id'=>'model_type']) !!} --}}
                    {!! Form::select('model_type', ['Wireless'=>'Wireless','Cable' =>'Cable'], null, ['class' => 'form-control','style' => 'text-transform:uppercase','id'=>'model_type']) !!}
                </div>
                <div class="form-group">
                    <strong>Type:</strong>
                    {{-- <select name="detail_type" id="detail_type" class="form-control">
                        <option value="LS3408" data-chained ="Cable">LS3408</option>
                        <option value="D830" data-chained ="Cable">D830</option>
                        <option value="QBT2101" data-chained ="Wireless">QBT2101</option>
                        <option value="CHIPERLAB 1560" data-chained ="Wireless">CHIPERLAB 1560</option>
                    </select> --}}
                    <select name="detail_type" id="detail_type" class="form-control">
                    <option value='0'>Select Type</option>
                    @foreach ($type as $item)
                        <option value="{{$item->detail_type}}" data-chained="{{$item->model_type}}" {{$scanner->detail_type == $item->detail_type ? 'selected':''}}>{{$item->detail_type}}</option>
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
        <a href="{{route('scanner.index')}}" class="btn btn-default"> Back</a>
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
    $('#detail_type').select2({
        allowClear: true,
        tags:true,
        /* Add this */
        placeholder: {
            id: "detail_type",
            placeholder: "Select Model"
        },
    });
    $("#detail_type").chained("#model_type");

});
</script>    
@endpush
@endsection

