@extends('layouts.app')


@section('content')
<div class="row">
  <div class="col-lg-12 margin-tb">
    <h2>Requests</h2>
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
    <th>Name</th>
    <th>Request</th>
    <th>Date Applied</th>
    <th>Status</th>
    <th width="200px">Action</th>
</tr>
    @foreach ($transactions as $trans)   
    <tr>
    <td>{{ ++$i }}</td>
        <td>{{ $trans->user->getFullName() }}</td>
        <td>
          @foreach($trans->request as $req)
            {{ $req->document}}: {{ $trans->remarks }} <br>
          @endforeach
        </td>
        <td>{{ $trans->created_at->format('m/d/Y') }}</td>
        <td>{{ $trans->status }}</td>
        <td>
            @if($trans->status == 'Pending')
            {!! Form::open(['method' => 'POST','route' => ['update_status', $req->id],'style'=>'display:inline']) !!}
                <input type="hidden" name="status" value="Approved">
                <input type="hidden" name="date_claimed">
                
            {!! Form::close() !!}
            <button class="btn btn-success" data-toggle="modal" data-request="{{ $trans->id }}" data-target="#approve_modal">Approve</button>
            <button class="btn btn-danger" data-toggle="modal" data-request="{{ $trans->id }}" data-target=".bd-example-modal-lg">Disapprove</button>
            @elseif($trans->status == 'Approved')
            <button class="btn btn-primary" data-toggle="modal" data-request="{{ $trans->id }}" data-target="#claim_modal">Claim</button>
            @endif
            
        </td>
    </tr>
    @endforeach
</table>


{{ $transactions->links('pagination::bootstrap-4') }}

<div class="modal fade bd-example-modal-lg" tabindex="-1" id="disapprove_modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reason for declining</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-left: 40px;">
                <form method="post" id="request_form">
                    @csrf
                <div class="form-check">
                <input class="form-check-input" type="radio" name="reason[]" value="Updated Birth Certificate">
                    <label class="form-check-label">Updated Birth Certificate</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="reason[]" value="Transcript of Records">
                    <label class="form-check-label">Transcript of Records</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="reason[]" value="Certificate of Good Noral">
                    <label class="form-check-label">Certificate of Good Noral</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="reason[]" value="Form 137">
                    <label class="form-check-label">Form 137</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="reason[]" value="Form 138">
                    <label class="form-check-label">Form 138</label>
                </div>
                <input type="hidden" value="Disapproved" name="status">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="update_status">Submit</button>
            </div>                            
        </div>
    </div>                       
</div> <!-- Modal -->      


<div class="modal fade bd-example-modal-md" tabindex="-1" id="approve_modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">SCHEDULE</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-left: 40px;">
                <form method="post" id="approve_form">
                    @csrf
                    <input type="text" name="claim_date" id="claim_date" class="form-control" required>
                    <input type="hidden" value="Approved" name="status">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="approve_status">Submit</button>
            </div>                            
        </div>
    </div>                       
</div> <!-- Modal -->  

<div class="modal fade bd-example-modal-md" tabindex="-1" id="claim_modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CLAIM</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding-left: 40px;">
                <form method="post" id="claim_form">
                    @csrf
                    <input type="text" name="receipt_no" class="form-control mb-2" placeholder="Receipt No">
                    <input type="text" name="released_by" class="form-control mb-2" placeholder="Released by">
                    <input type="text" name="claimed_by" class="form-control mb-2" placeholder="Claimed by">
                    <input type="text" name="date_claimed" id="date_claimed" class="form-control mb-2" placeholder="Date Claimed">
                    <input type="hidden" value="Claimed" name="status">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="claim_status">Submit</button>
            </div>                            
        </div>
    </div>                       
</div> <!-- Modal -->  
@endsection