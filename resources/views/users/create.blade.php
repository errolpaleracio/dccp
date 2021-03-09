@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="float-left">
            <h2>Create New User</h2>
        </div>
        <div class="float-right">
            <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
        </div>
    </div>
</div>

{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>First Name:</strong>
            {!! Form::text('first_name', null, array('placeholder' => 'First Name','class' => 'form-control')) !!}
            @error('first_name')
                <span style="color:red"><strong>{{ $message }}</strong></span>
            @enderror             
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Middle Name:</strong>
            {!! Form::text('middle_name', null, array('placeholder' => 'Middle Name','class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-142 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Last Name:</strong>
            {!! Form::text('last_name', null, array('placeholder' => 'Last Name','class' => 'form-control')) !!}
            @error('last_name')
                <span style="color:red"><strong>{{ $message }}</strong></span>
            @enderror 
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Username:</strong>
            {!! Form::text('username', null, array('placeholder' => 'Username','class' => 'form-control')) !!}
            @error('username')
                <span style="color:red"><strong>{{ $message }}</strong></span>
            @enderror 
        </div>
    </div>    
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Password:</strong>
            {!! Form::password('password', array('placeholder' => 'Password','class' => 'form-control')) !!}
        </div>
        @error('password')
            <span style="color:red"><strong>{{ $message }}</strong></span>
        @enderror 
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Confirm Password:</strong>
            {!! Form::password('confirm-password', array('placeholder' => 'Confirm Password','class' => 'form-control')) !!}
        </div>
        @error('confirm-password')
            <span style="color:red"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Email:</strong>
            {!! Form::text('email', null, array('placeholder' => 'Email','class' => 'form-control')) !!}
            @error('email')
                <span style="color:red"><strong>{{ $message }}</strong></span>
            @enderror 
        </div>
    </div>  
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Contact No:</strong>
            {!! Form::text('contact_no', null, array('placeholder' => 'Username','class' => 'form-control')) !!}
            @error('contact_no')
                <span style="color:red"><strong>{{ $message }}</strong></span>
            @enderror 
        </div>
    </div> 
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <strong>Role:</strong>
            {!! Form::select('roles', $roles,[], array('class' => 'form-control', 'placeholder' => 'Select a role')) !!}
        </div>
        @error('roles')
            <span style="color:red"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
{!! Form::close() !!}


@endsection