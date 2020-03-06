@extends('admin.admin_template')
@section('tittle','Dashboard')
@push('header-name')
<h1>
    Dashboard
    {{-- <small><a class="btn btn-success" href="{{route('assets.create')}}"> Create New Asset</a></small> --}}
    <small>Machine Area</small>
</h1>

<ol class="breadcrumb">
    <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>

</ol>
@endpush

@section('content')
@foreach ($area as $item)
<a href="{{route($item->area)}}" class="btn btn-app">
    <span class="badge bg-green">{{$item->total}}</span>
    <i class="fa fa-tasks"></i> {{$item->area}}

</a>
@endforeach
<div class="row">

    <div class="col-md-4" style="padding-top:33px;">
        {{-- Activity --}}
        <div class="box box-success">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-edit"></i>

                <h3 class="box-title">Device Broken or Not Installed</h3>

                <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Status">
                    <div class="btn-group" data-toggle="btn-toggle">
                        <a href="{{route('export.broken')}}"><button class="btn-success">Export to Excel</button></a>
                    </div>
                </div>
            </div>
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 250px;">
                <div class="box-body chat" id="chat-box-status" style="overflow: hidden; width: auto; height: 250px;">
                    <!-- chat item -->
                    <div class="item">

                        <!-- /.progress-group -->
                        <div class="progress-group">
                            <a href="{{route('printer.broken')}}"><span class="progress-text">Printer</span></a>
                            <span
                                class="progress-number"><b>{{$printer->totalBroken}}</b>/{{$printer->totalDevice}}</span>

                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: {{$printer->percenTage}}%">
                                </div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                            <a href="{{route('scanner.broken')}}"><span class="progress-text">Scanner</span></a>
                            <span
                                class="progress-number"><b>{{$scanner->totalBroken}}</b>/{{$scanner->totalDevice}}</span>

                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: {{$scanner->percenTage}}%">
                                </div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                            <a href="{{route('hmi.broken')}}"><span class="progress-text">HMI</span></a>
                            <span class="progress-number"><b>{{$hmi->totalBroken}}</b>/{{$hmi->totalDevice}}</span>

                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: {{$hmi->percenTage}}%"></div>
                            </div>
                        </div>
                        <!-- /.progress-group -->
                        <div class="progress-group">
                            <a href="{{route('nmp.broken')}}"><span class="progress-text">NMP</span></a>
                            <span class="progress-number"><b>{{$nmp->totalBroken}}</b>/{{$nmp->totalDevice}}</span>

                            <div class="progress sm">
                                <div class="progress-bar progress-bar-green" style="width: {{$nmp->percenTage}}%"></div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.item -->

            </div>
            <div class="slimScrollBar"
                style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 25px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 224.82px;">
            </div>
            <div class="slimScrollRail"
                style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
            </div>
        </div>
        <!-- /.chat -->
        {{-- Model Device --}}
    {{-- <div class="col-md-4" style="padding-top:33px;"> --}}
      {{-- Activity --}}
      <div class="box box-success">
          <div class="box-header ui-sortable-handle" style="cursor: move;">
              <i class="fa fa-edit"></i>

              <h3 class="box-title">Total Device Status OK by Type</h3>
              
              <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Status">
                  <div class="btn-group" data-toggle="btn-toggle">
                      <a href="{{route('dashboard.export')}}"><button class="btn-success">Export To Excel</button></a>
                  </div>
              </div>
          </div>
          <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
              <div class="box-body chat" id="chat-box-total" style="overflow: hidden; width: auto; height: auto;">
                  <!-- chat item -->
                  <div class="item">

                      
                      <div class="box-body">
                          <div class="table-responsive">
                            <table class="table no-margin">
                              <thead>
                              <tr>
                                <th>Device</th>
                                <th>Model</th>
                                <th>Total</th>
                                
                              </tr>
                              </thead>
                              <tbody>
                                  @foreach ($model_type as $item)
                                  <tr>
                                          <td>{{$item->device_type}}</td>
                                          <td>{{$item->model_type}}</td>
                                          <td>{{$item->total}}</td>
                                          
                                  </tr>
                                  @endforeach
                              
                              </tbody>
                            </table>
                          </div>
                          <!-- /.table-responsive -->
                        </div>
                  </div>

              </div>
              <!-- /.item -->

          </div>
          <div class="slimScrollBar"
              style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 25px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 224.82px;">
          </div>
          <div class="slimScrollRail"
              style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
          </div>
      </div>
      <!-- /.chat -->

  {{-- </div> --}}
    </div>
    <div class="col-md-8" style="padding-top:33px;">
    <div class="box box-success">
            <div class="box-header ui-sortable-handle" style="cursor: move;">
                <i class="fa fa-edit"></i>
  
                <h3 class="box-title">Shortcut System</h3>
                
                
            </div>
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
                <div class="box-body chat" id="chat-box-total" style="overflow: hidden; width: auto; height: auto;">
                    <!-- chat item -->
                    <div class="item">
  
                        
                        <div class="box-body">
                            <a href="{{url('http://192.168.189.120/hd')}}"class="btn btn-app">
                                <i class="fa fa-tablet"></i> IT Helpdesk
                            </a>
                            <a href="{{url('http://192.168.189.120/itsparepart')}}"class="btn btn-app">
                                <i class="fa fa-tablet"></i> IT Sparepart
                            </a>
                            <a href="{{url('http://192.168.189.120/itsystem')}}"class="btn btn-app">
                                <i class="fa fa-tablet"></i> IT System
                            </a>
                            <a href="{{url('http://192.168.189.117:8001')}}"class="btn btn-app">
                                <i class="fa fa-tablet"></i> Asset Patrol
                            </a>
                            <!-- /.table-responsive -->
                          </div>
                    </div>
  
                </div>
                <!-- /.item -->
  
            </div>
            <div class="slimScrollBar"
                style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 25px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 224.82px;">
            </div>
            <div class="slimScrollRail"
                style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;">
            </div>
        </div>
    </div>
        <!-- /.chat -->
    {{-- testing --}}
    {{-- <div class="col-md-8" style="padding-top:33px;">
        <!-- DIRECT CHAT -->
        <div class="box box-success direct-chat direct-chat-warning">
          <div class="box-header with-border">
              <i class="fa fa-exchange"></i>
            <h3 class="box-title">Activity</h3>
            <div class="row input-daterange">
              <div class="col-md-4">
                  <input type="text" name="from_date" id="from_date" class="form-control" placeholder="From Date" readonly />
              </div>
              <div class="col-md-4">
                  <input type="text" name="to_date" id="to_date" class="form-control" placeholder="To Date" readonly />
              </div>
              <div class="col-md-2">
                  <button type="button" name="filter" id="filter" class="btn btn-success">Filter</button>
                  <button type="button" name="refresh" id="refresh" class="btn btn-default">Refresh</button>
              </div>
          </div>
            <div class="box-tools pull-right">
              <span data-toggle="tooltip" title="" class="badge bg-yellow" data-original-title="3 New Messages">3</span>
              <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn btn-box-tool" data-toggle="tooltip" title="" data-widget="chat-pane-toggle" data-original-title="Contacts">
                <i class="fa fa-comments"></i></button>
              <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive" style="padding-left:10px;">
              <table class="table table-bordered table-striped" id="order_table">
                     <thead>
                      <tr>
                          <th>Date</th>
                          <th>Action By</th>
                          <th>Activity</th>
                          <th>Area</th>
                          <th>Machine Number</th>
                          <th>Device Type</th>
                          <th>Model</th>
                      </tr>
                     </thead>
                 </table>
             </div>
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <form action="#" method="post">
              <div class="input-group">
                <input type="text" name="message" placeholder="Type Message ..." class="form-control">
                <span class="input-group-btn">
                      <button type="button" class="btn btn-warning btn-flat">Send</button>
                    </span>
              </div>
            </form>
          </div>
          <!-- /.box-footer-->
        </div>
        <!--/.direct-chat -->
      </div> --}}

    

</div>

@endsection
@push('script')
<script>
$(document).ready(function(){
//  $('.input-daterange').datepicker({
//   todayBtn:'linked',
//   format:'yyyy-mm-dd',
//   autoclose:true
//  });
 $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
 load_data();

 function load_data(from_date = '', to_date = '')
 {
  $('#order_table').DataTable({
   processing: true,
   serverSide: true,
   ajax: {
    url:'{{ route("dashboard") }}',
    data:{from_date:from_date, to_date:to_date}
   },
   columns: [
    {
     data:'created_at',
     name:'created_at'
    },
    {
     data:'action_by',
     name:'action_by'
    },
    {
     data:'remark',
     name:'remark'
    },
    {
     data:'area',
     name:'area'
    },
    {
     data:'machine_number',
     name:'machine_number'
    },
    {
      data:'device_type',
      name:'device_type'
    },
    {
      data:'model_type',
      name:'model_type'
    }
   ]
  });
 }

 $('#filter').click(function(){
  var from_date = $('#from_date').val();
  var to_date = $('#to_date').val();
  if(from_date != '' &&  to_date != '')
  {
   $('#order_table').DataTable().destroy();
   load_data(from_date, to_date);
  }
  else
  {
   alert('Both Date is required');
  }
 });

 $('#refresh').click(function(){
  $('#from_date').val('');
  $('#to_date').val('');
  $('#order_table').DataTable().destroy();
  load_data();
 });

// SLIMSCROLL FOR CHAT WIDGET
$('#chat-box-status').slimScroll({
    height: '250px'
  });


});



  
</script>
@endpush
