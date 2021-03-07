@extends('layouts.app')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <h2>Users Management</h2>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 margin-tb">
    <a class="btn btn-success mb-3" href="{{ route('users.create') }}"> Create New User</a>
  </div>
</div>
<div class="row">
    <div class="col-lg-12 margin-tb">
        {!! Form::open(array('route' => 'users.index','method'=>'GET', 'class' => 'form-inline')) !!}
          <div class="form-group mx-sm-2 mb-2">
            <label for="search">Full Name</label>
            <input type="Text" name="full_name" class="form-control mx-sm-3" id="full_name" placeholder="Full Name" value="{{ Session::get('full_name') }}">
          </div>
          
          <div class="form-group mx-sm-2 mb-2">
            <label for="search" class="mx-sm-2">Role</label>
            {!! Form::select('role', $roles, Session::get('role'), ['class' => 'form-control', 'placeholder' => 'Select a role']) !!}
          </div>
          <button type="submit" class="btn btn-primary mb-2">Search</button>
        </form>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>First Name</th>
   <th>Middle Name</th>
   <th>Last Name</th>
   <th>Username</th>
   <th>Email</th>
   <th>Role</th>
   <th>Contact No</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as $key => $user)
  <tr>
    <td>{{ ++$i }}</td>
    <td>{{ $user->first_name }}</td>
    <td>{{ $user->middle_name }}</td>
    <td>{{ $user->last_name }}</td>
    <td>{{ $user->username }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>{{ $user->contact_no }}</td>
    <td>
       <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
        {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
            {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this item?')"]) !!}
        {!! Form::close() !!}
    </td>
  </tr>
 @endforeach
</table>


{{ $data->links('pagination::bootstrap-4') }}


@endsection