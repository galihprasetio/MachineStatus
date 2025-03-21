@extends('admin.admin_template')
@section('tittle','Create Section')
@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle"> Create New Section</h3>
        <div class="box-tools pull-right">

                <!-- Collapse Button -->
                <button type="button" class="btn btn-box-tool" data-widget="collapse">
                    <i class="fa fa-minus"></i>
                </button>
            </div>
    </div>
    @if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="box-body">
        {!! Form::open(array('route' => 'section.store','method' => 'POST')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department:</strong>
                    {!! Form::select('id_department', $department_list, null, ['placeholder'=>'select department','class'=>'form-control','id' => 'id_department']) !!}
                    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Section:</strong>
                    {!! Form::text('section', null, ['placeholder' =>'section','class'=>'form-control']) !!}
                </div>

            </div>
        </div>
    </div>
    <div class="box-footer">
        <a href="{{route('section.index')}}" class="btn btn-default"> Back</a>
        <button type="submit" class="btn btn-primary pull-right"> Submit</button>
    </div>
</div>
    {!! Form::close() !!}
@endsection
@push('script')
<script>
        $(document).ready(function(e){
            $('#id_department').select2({
                allowClear: true,
                /* Add this */
                placeholder: {
                    id: "id_department",
                    placeholder: "Select Department"
                },
            });
        
        });
        </script>
    
@endpush