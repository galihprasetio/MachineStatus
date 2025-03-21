@extends('admin.admin_template')
@section('tittle','List Scanner Device')
@push('header-name')
<h1>
    Scanner Device Broken or Not Installed
<small>
    {{-- <a class="btn btn-success" href="{{route('scanner.create')}}"> Create New Scanner</a> --}}
    
</small>
</h1>

<ol class="breadcrumb">
    
    <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Scanner Device Broken or Not Installed</li>
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
        <table id="Scanner-table" class="table table-bordered" style="width:100%">
            <thead>
                <tr>
                    {{-- <th>Id</th> --}}
                    <th>Area</th>
                    <th>Machine Number</th>
                    <th>Model Type</th>
                    <th>Device Status</th>
                    <th>Remark</th>
                    <th>Updated By</th>
                    <th>Updated At</th>
                    
                    
                </tr>
            </thead>
           <tbody>
               @foreach ($scanner as $item)
                   <tr>
                       <td>{{ $item->area}}</td>
                       <td>{{ $item->machine_number}}</td>
                       <td>{{ $item->model_type}}</td>
                       <td>{{ $item->device_status}}</td>
                       <td>{{ $item->remark}}</td>
                       <td>{{ $item->updated_by}}</td>
                       <td>{{ $item->updated_at}}</td>
                       
                   </tr>
               @endforeach
           </tbody>
        </table>
    </div>
</div>

    @push('script')
    <script>
    var table = $('#Scanner-table').DataTable({
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
    
    </script>
    @endpush
@endsection