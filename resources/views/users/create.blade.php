@extends('admin.admin_template')
@section('tittle','Create User')

@section('content')
<div class="box">
    <div class="box-header">
        <h3 class="box-tittle"> Create User</h3>
        <div class="box-tools pull-right">

            <!-- Collapse Button -->
            <button type="button" class="btn btn-box-tool" data-widget="collapse">
                <i class="fa fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="box-body">
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

        {!! Form::open(array('route' => 'users.store','method'=>'POST','enctype'=>'multipart/form-data')) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Name:</strong>
                    {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Password:</strong>
                    {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Confirm Password:</strong>
                    {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' =>
                    'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Department:</strong>
                    {!! Form::select('id_department', $department, null, ['placeholder'=>'Select Department','class'=>'form-control','name'=>'id_department','id'=>'id_department']) !!}
                    
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Section:</strong>
                    
                    
                    <select name="id_section" id="id_section" class="form-control">
                        <option value="">Select Section</option>
                        @foreach ($section as $item)
                        <option value="{{$item->id}}" data-chained="{{$item->id_department}}">{{$item->section}}</option>    
                        @endforeach
                        
                    </select>
                   
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Tittle:</strong>
                    {!! Form::text('tittle', null, ['placeholder'=>'Tittle','class'=>'form-control']) !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Position:</strong>
                    {!! Form::text('position', null, ['placeholder'=>'Position','class'=>'form-control']) !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Date of Birth:</strong>
                    
                    {!! Form::date('dateofbirth', null, ['class'=>'form-control','id'=>'dateofbirth','name'=>'dateofbirth']) !!}
                   
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Office Phone:</strong>
                    {!! Form::number('office_phone', null, ['placeholder'=>'Office Phone','class'=>'form-control']) !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Celluler Phone:</strong>
                    {!! Form::number('cell_phone', null, ['plaecholder'=>'Celluler Phone','class'=>'form-control']) !!}
                </div>

            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Region</strong>
                    {!! Form::select('region',['placeholder'=>'Select Region'],null,['class'=>'form-control','id'=>"region",'name'=>'region']) !!}
                    {{-- <select id="region" name="region[]" class="form-control"></select> --}}
                </div>
            </div>    
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <strong>Job Description:</strong>
                        {!! Form::textarea('job_description', null, ['placeholder'=>'Job Description','class'=>'form-control']) !!}
                    </div>

                </div>
            
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {{-- <strong>Sign File:</strong> --}}
                    
                    {{-- <input id="image" type="file" class="form-control" name="image"> --}}
                    {{-- {!! Form::file('sign', ['type'=>'file','class'=>'form-control','name'=>'sign','accept'=>'image/jpeg']) !!} --}}
                    <textarea style="display:none;" name="sign" id="sign" cols="30" rows="10"></textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Role:</strong>
                    {!! Form::select('roles[]', $roles,[], array('class' => 'form-control','multiple')) !!}
                </div>
            </div>
        </div>

    </div>


    <div class="box-footer">
        <a class="btn btn-default" href="{{ route('users.index') }}"> Back</a>
        <button type="submit" class="btn btn-primary pull-right"> Submit</button>

    </div>
</div>
{!! Form::close() !!}
{{-- Modal Singature --}}
<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span></button>
          <h4 class="modal-title">Draw Singature</h4>
        </div>
        <div class="modal-body">
            <!-- Content -->
	
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>

{{-- End Modal Singature --}}
@push('script')

<!-- Include Singature Pad -->
{{-- <link rel="stylesheet" href="{{ asset('signature/css/signature-pad.css')}}">   --}}
<script type="text/javascript">
    $(document).ready(function () {
        $("#id_section").chained("#id_department"); /* or $("#series").chainedTo("#mark");*/
        // select2
        //$('#region').select2("val", null);
        $('#region').select2({
        allowClear: true,
        placeholder: 'Search...',
        ajax: {
        url: '{{url('userss/getRegion')}}',
        dataType: 'json',
        delay: 250,
        processResults: function (data) {
        return {
          results:  $.map(data, function (item) {
            return {
              text: item.province,
                id: item.province
            }
          })
        };
        },
        cache: true
         }
        });
        
    });
    
</script>

@endpush
@endsection
