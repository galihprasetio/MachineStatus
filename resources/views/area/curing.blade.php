@extends('admin.admin_template')
@section('tittle','Curing')
@push('header-name')
<h1>
    Curing
{{-- <small><a class="btn btn-success" href="{{route('assets.create')}}"> Create New Asset</a></small> --}}

</h1>

<ol class="breadcrumb">
    <li><a href="{{url('dashboard')}}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
    <li class="active">Curing</li>
</ol>
@endpush

@section('content')
@foreach ($curing as $item)
<a href="{{route('device.show',$item->id)}}" class="btn btn-app">
    
    <i class="fa fa-television"></i> {{$item->machine_number}}
</a>
@endforeach

@endsection
@push('script')
    
@endpush
