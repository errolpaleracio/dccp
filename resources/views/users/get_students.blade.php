@extends('layouts.app')


@section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left">
            <h2>Search Student</h2>
        </div>
    </div>
</div>


@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
    <tr>
        <th>Name</th>
        <th>Username</th>
        <th>Email</th>
        <th width="280px">Action</th>
    </tr>
    @foreach ($students as $key => $student)
    <tr>
        <td>{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</td>
        <td>{{ $student->username }}</td>
        <td>{{ $student->email }}</td>
        <td>
            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $student->id],'style'=>'display:inline']) !!}
                {!! Form::submit('Delete', ['class' => 'btn btn-danger', 'onclick' => "return confirm('Are you sure you want to delete this item?')"]) !!}
            {!! Form::close() !!}
        </td>
    </tr>
 @endforeach
</table>


{{ $students->links('pagination::bootstrap-4') }}


@endsection