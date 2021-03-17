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
    <th>Details</th>
    <th>Status</th>
    <th>Reason for Cancel/Decline</th>
    <th>Claim Date</th>
    <th width="100px">Action</th>
</tr>
    @foreach ($transactions as $trans)
    <tr>
        <td>{{ ++$i }}</td>
        <td>
          @foreach($trans->request as $req)
            AMOUNT TO PAY P{{ $req->price * $req->copies }} {{ $req->document}}: {{ $trans->remarks }} <br>
          @endforeach
        </td>
        <td>{{ $trans->status }}</td>
        <td>{{ $trans->reason }}</td>
        <td>{{ $trans->claim_date? $trans->claim_date->format('m/d/Y') : null }}</td>
        <td>
        @if($trans->status == 'Pending')
        <button class="btn btn-danger" data-toggle="modal" data-request="{{ $trans->id }}" data-target="#cancel_modal">Cancel</button>
        
        @endif
        </td>
    </tr>
    @endforeach
</table>


{{ $transactions->links('pagination::bootstrap-4') }}

<div class="modal fade bd-example-modal-md" tabindex="-1" id="cancel_modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SCHEDULE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-left: 40px;">
                <form method="post" id="cancel_form">
                  @csrf
                  <input type="hidden" name="status" value="Cancelled">
                  <textarea class="form-control" name="reason" rows="4"></textarea>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="cancel_status">Submit</button>
            </div>                            
        </div>
    </div>                       
</div> <!-- Modal -->  
@endsection