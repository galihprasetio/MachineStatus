@extends('admin.admin_template')
@section('tittle','Detail Machine')
@push('header-name')
<h1>
    Detail Machine {{$machine->machine_number}}
<small>
    
    
</small>
</h1>

<ol class="breadcrumb">
    
    <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active"><a href="{{route($machine->area)}}"> {{$machine->area}}</a></li>
    <li class="active">Detail Machine {{$machine->machine_number}}</li>
</ol>
@endpush
@section('content')
<!-- Custom Tabs -->
<div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true"><strong>Detail Machine</strong></a></li>
          <li><a href="#tab_2" data-toggle="tab"><strong>History Device</strong></a></li>
          <div class="pull-right">
          <!-- Collapse Button -->
          <button type="button" class="btn btn-box-tool" data-widget="collapse">
            <i class="fa fa-minus"></i>
          </button>    
          </div>
          
          
        </ul>
        <div class="tab-content">
          <div class="tab-pane fade in active" id="tab_1">
            
            
            <div class="box-body">
            {!! Form::model($machine, ['method'=>'PATCH','route'=>['printer.update',$machine->id]]) !!}
        
                <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Area:</strong>
                                    {!! Form::text('area', null, ['class' => 'form-control','placeholder'=>'Machine Number','style' => 'text-transform:uppercase','id'=>'area','readonly']) !!}
                                </div>
                               
                                <div class="form-group">
                                    <strong>Machine Number:</strong>
                                    {!! Form::text('machine_number', null, ['class' => 'form-control','placeholder'=>'New Asset','style' => 'text-transform:uppercase','id'=>'machine_number','readonly']) !!}
                                </div>
                                {{-- <div class="form-group">
                                    <strong>Status Condition:</strong>
                                    {!! Form::text('status_condition', null, ['class' => 'form-control','placeholder'=>'Team','style' => 'text-transform:uppercase','id'=>'status_condition','readonly']) !!}
                                </div>
                                
                                <div class="form-group">
                                    <strong>Status Installed:</strong>
                                    {!! Form::text('status_installed', null, ['class' => 'form-control','placeholder'=>'Remarks','style' => 'text-transform:uppercase','id'=>'status_installed','readonly']) !!}
                                </div>
                                <div class="form-group">
                                    <strong>Remark:</strong>
                                    {!! Form::textarea('remark', null, ['class' => 'form-control','placeholder'=>'Remarks','style' => 'text-transform:uppercase','id'=>'remark','readonly']) !!}
                                </div> --}}
                            </div>
                    
        
                    
            
                    
                </div>
                <table class="table table-condensed" style="width:100%">
                        <tbody><tr>
                          <th>Device Type</th>
                          <th>Model Type</th>
                          <th>Type</th>
                          <th>Remark</th>
                          <th>Device Status</th>
                        </tr>
                        @foreach ($device as $item)
                        <tr>
                                <td>{{$item->device_type}}</td>
                                <td>{{$item->model_type}}</td>
                                <td>{{$item->detail_type}}</td>
                                <td>{{$item->remark}}</td>
                                <td><span class="label {{{$item->device_status === 'OK' ? 'label-success' : 'label-danger'}}}">{{$item->device_status}}</span></td>
                            </tr> 
                        @endforeach
                        
                      </tbody>
                </table>
            </div>
        
        
        
              
        
        
        <div class="box-footer">
            <a href="{{route($machine->area)}}" class="btn btn-default"> Back</a>
            
        </div>
        
          </div>
          <!-- /.tab-pane -->
          <div class="tab-pane" id="tab_2">
                <table class="table table-bordered display" style="overflow:auto;position:relative;width:100%;" id="device-history">
                    <thead>
                        <tr>
                          <th>Device Type</th>
                          <th>Action By</th>
                          <th>Remark</th>
                          <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($historyDevice as $item)
                        <tr>
                                <td>{{$item->device_type}}</td>
                                
                                <td>{{$item->action_by}}</td>
                                <td>{{$item->remark}}</td>
                                <td>{{$item->created_at}}</td>
                            </tr> 
                        @endforeach
                        
                    
                      </tbody>
                </table>
           
          </div>
          <!-- /.tab-pane -->
          
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      {!! Form::close() !!}
@push('script')
<script>

    $('#device-history').DataTable({
        "searching" : false,
        "paging":   true,
        "scrollX":true,
        "info":false,
        "lengthChange": false,
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
        localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
        return JSON.parse(localStorage.getItem('offersDataTables'));
        }
    });
  

</script>    
@endpush
@endsection

