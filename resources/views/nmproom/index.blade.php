@extends('admin.admin_template')
@section('tittle','List device & Scanner Device')
@push('header-name')
<h1>
    Device Printer & Scanner Device
<small>
    <a class="btn btn-success" href="{{route('device.create')}}"> Register New device</a>
    
</small>
</h1>

<ol class="breadcrumb">
    
    <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Device Printer & Scanner Device</li>
</ol>
@endpush
@section('content')
<div class="box">
    <div class="box-header">


            <div class="box-tools pull-right">

                    <!-- Collapse Button -->
                    <button type="button" class="btn btn-box-tool" data-widget="collapse">
                        <i class="fa fa-minus"></i>
                    </button>
                </div>
                <!-- /.box-tools -->
    </div>
    <div class="box-body">
        <table id="device-table" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>Machine Number</th>
                    <th>Device Type</th>
                    <th>Model Type</th>
                    <th>Type</th>
                    <th>Device Status</th>
                    <th>Remark</th>
                    <th>Updated By</th>
                    <th>Updated At</th>
                    <th>Action</th>
                    
                </tr>
            </thead>
           <tbody>
               @foreach ($device as $item)
                   <tr>
                       <td>{{ $item->machine_number}}</td>
                       <td>{{ $item->device_type}}</td>
                       <td>{{ $item->model_type}}</td>
                       <td>{{ $item->detail_type}}</td>
                       <td>{{ $item->device_status}}</td>
                       <td>{{ $item->remark}}</td>
                       <td>{{ $item->updated_by}}</td>
                       <td>{{ $item->updated_at}}</td>
                       <td>
                           
                           
                            <a href="javascript:void(0)" data-toggle="tooltip"  data-id="{{ $item->id }}" data-id_machine ="{{$item->id_machine}}" data-original-title="Transfer" class="btn btn-xs btn-default btnTransfer"><i class="fa fa-exchange btnTransfer"></i>Transfer</a>
                            <a href="{{route('device.edit',$item->id)}}" class="btn btn-xs btn-default"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                            
                        </div>
                       </td>
                   </tr>
               @endforeach
           </tbody>
        </table>
    </div>
</div>
<!-- Modal -->
<div id="modalTransfer" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><strong> Transfer Device </strong></h4>
        </div>
        <div class="modal-body">
            <form name="formModalTransfer" id="formModalTransfer" method="PATCH">
            {{-- {!! Form::model($device, ['method'=>'PATCH','route'=>['printer.update',$device->id],'name' => 'formModalTransfer','id' => 'formModalTransfer']) !!} --}}
                <div class="form-group">
                    <strong>Transfer to Machine Number:</strong>
                    {{-- {!! Form::text('machine_number', null, ['class' => 'form-control','placeholder'=>'Machine Number','style' => 'text-transform:uppercase','id'=>'machine_number']) !!} --}}
                    {!! Form::hidden('id', null, ['id'=>'id','name'=>'id']) !!}
                    {!! Form::select('machine_number', $machine,null, ['class' => 'form-control','id' =>'machine_number','placeholder'=> 'NMP Room','style'=>'width: 100%']) !!}
                    
                </div>
                <div class="form-group">
                        <strong>Remark:</strong>
                        {!! Form::textarea('remark', null, ['class' => 'form-control','id' =>'remark','placeholder'=> 'Remark']) !!}
                    </div>
                
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn pull-right btn-primary" id="btn-update">Transfer</button>
        </form>
        </div>
      </div>
  
    </div>
  </div>
    @push('script')
    <script>
    var table = $('#device-table').DataTable({
        paging:   true,
        info:     true,
        searching: true,
        select: true, 
        scrollX:true,
        "bStateSave": true,
        "fnStateSave": function (oSettings, oData) {
        localStorage.setItem('offersDataTables', JSON.stringify(oData));
        },
        "fnStateLoad": function (oSettings) {
        return JSON.parse(localStorage.getItem('offersDataTables'));
        }
          
    });
    $('#machine_number').select2({
        allowClear: true,
        /* Add this */
        placeholder: {
            id: "machine_number",
            placeholder: "Select Machine"
        },
    });
    
//     dom: 'l<"toolbar">frtip',
//      initComplete: function(){
//       $("div.toolbar")
//          .html('<button type="button" id="any_button" class="btn btn-success pull-right btn-addDetail">Add</button>');           
//    }      
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    /* When click edit flow */
    $('body').on('click', '.btnTransfer', function () {
        var id = $(this).data('id');
        var id_machine = $(this).data('id_machine');
        $('#modalTransfer').modal('show');
        
        $('#id').val(id);
        $('#machine_number').val(id_machine);
        // $.get('../editDetail/'+ id +'', function (data) {    
        //     $('#modalTransfer').modal('show');
        //     $('#id').val(id);
        //     $('#machine_number').val(data.machine_number);
            
        // })   
      });
    //Update data
    $('#btn-update').click(function (e) {
    e.preventDefault();
    
    
    $.ajax({
        data: $('#formModalTransfer').serialize(),
        url: "{{ route('device.updateTransfer') }}",
        type: "PATCH",
        dataType: 'json',
        success: function (data) {
    
           $('#formModalTransfer').trigger("reset");
           $('#modalTransfer').modal('hide');
           
            //alert(data);
           location.reload(); 
        
        },
        error: function (data) {
            console.log('Error:', data);
            $('#btn-update').html('Save Changes');
        }
        });
    }); 
    </script>
    @endpush
@endsection