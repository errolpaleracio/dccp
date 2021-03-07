@extends('layouts.app')

@section('content')
<div class="container" style="padding: 0">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Request Form</div>

                <div class="card-body">
                <a class="btn btn-primary" href="{{ route('all_request') }}"> Back</a>
                    <div class="row">
                    </div>                    
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                        <p>{{ $message }}</p>
                        </div>
                    @endif
                    <form method="post" action="{{ route('create_request') }}" id="request_form">
                    @csrf
                    <div class="form-row">
                        <div class="form-group">
                            @error('studies')
                                <span style="color:red">
                                    <strong>Please select documents</strong>
                                </span>
                            @enderror                                      
                        </div>
                    </div>                     
                    <div class="d-flex flex-row">
                        <div class="mr-5">
                            <h5>Select Documents</h5>
                            @foreach($documents as $docu)
                                <div class="form-check">
                                    <input type="text" name="copies[]" placeholder="No of copies" class="copies" disabled>
                                    <input class="form-check-input documents" type="checkbox" name="documents[]" value="{{ $docu->description }}">
                                    <label class="form-check-label">{{ $docu->description }}</label>
                                    <input type="hidden" name="prices[]" value="{{ $docu->price }}">
                                </div>
                            @endforeach
                            @error('documents')
                                <span style="color:red">
                                    <strong>Please select documents</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="p-2">
                            <h5>Select Remarks</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="remarks[]" value="For Reference Purposes">
                                <label class="form-check-label">For Reference Purposes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="remarks[]" value="For Evaluation Purposes">
                                <label class="form-check-label">For Evaluation Purposes</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="remarks[]" value="For Employment Purposes">
                                <label class="form-check-label">For Employment Purposes</label>
                            </div>   
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="remarks[]" value="For Employment Abroad">
                                <label class="form-check-label">For Employment Abroad</label>
                            </div>   
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="remarks[]" value="Graduated">
                                <label class="form-check-label">Graduated</label>
                            </div>    
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="remarks[]" value="Second Copy">
                                <label class="form-check-label">Second Copy</label>
                            </div>    
                            @error('remarks')
                                <span style="color:red">
                                    <strong>Please select a remark</strong>
                                </span>
                            @enderror                                                                      
                        </div>
                    </div>                               
                    <!-- <button type="submit" class="btn btn-primary mr-2">Submit</button> -->
                    </form>   
                    
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Submit</button>

                    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="my_modal" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Summary</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <table class="table" id="table">
                                        <thead>
                                            <tr>
                                                <th>Request</th>
                                                <th>No of copy</th>
                                                <th>Price</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="okay">Okay</button>
                                </div>                            
                            </div>
                        </div>
                    </div> <!-- Modal -->              

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
