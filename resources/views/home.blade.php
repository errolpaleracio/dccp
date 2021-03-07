@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @role('student')
                    <div class="d-flex justify-content-center p-2 m-2">
                        <a href="{{ route('all_request') }}" class="btn btn-primary mr-2" style="inline-block">Request Form</a>
                        <a class="btn btn-success" style="inline-block">Transaction</a>
                    </div>
                    @endrole
                    @role('admin')
                        Hello Admin!
                    @endrole
                    @role('registrar')
                        Hello Registrar!
                    @endrole
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
