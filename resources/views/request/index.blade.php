@extends('layouts.app')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <h2>Requests</h2>
  </div>
</div>
<div class="row">
  <div class="col-lg-12 margin-tb">
    <a class="btn btn-success mb-3" href="{{ route('add_request') }}"> Add Requests </a>
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
    <th>Document</th>
    <th>Remarks</th>
    <th>Price</th>
    <th>No of copy</th>
    <th>Total Amount</th>
    <th width="280px">Action</th>
</tr>
    @foreach ($requests as $req)
    <tr>
        <td>{{ ++$i }}</td>
        <td>{{ $req->document }}</td>
        <td>{{ $req->remarks }}</td>
        <td>{{ $req->price }}</td>
        <td>{{ $req->copies }}</td>
        <td>{{ $req->price * $req->copies }}</td>
        <td>
        
        </td>
    </tr>
    @endforeach
    <tr>
        <td></td><td></td><td></td><td></td><td></td><td>{{ $total_amount }}</td><td></td>
    </tr>
</table>


{{ $requests->links('pagination::bootstrap-4') }}


@endsection