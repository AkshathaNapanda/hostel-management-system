@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-3">
            @include('layouts.sidenav')
        </div>
        <div class="col-sm-9">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between">
                        <strong>{{ __('New Mess Fee') }}</strong>
                        <a href="{{ route('mess-fees.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> Show All</a>
                    </div>
                </div>

                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            @foreach($errors->all() as $error)
                                <strong>{{ $error }}</strong>
                            @endforeach
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="card k-info-box mb-3">
                        <div class="card-body ">
                            <h5>Sending Mass Emails - IMPORTANT !!!</h5>
                            <ol>
                                <li>After pressing the [Send Emails] button, wait until it is finished loading.</li>
                                <li>Please do not operate the applicaiton at that time, since there may be a lot of emails to send</li>
                            </ol>
                        </div>
                    </div>

                    <form id="messFeeForm" action="{{ route('mess-fees.store') }}" method="POST" class="mb-3">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="amount">Amount <span class="text-danger">*</span></label>
                            <input name="amount" id="amount" type="text" class="form-control" placeholder="eg: 500">
                            <p class="invalid-feedback">{{ $errors->first('amount') }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="notes">Remarks</label>
                            <textarea name="notes" id="notes"class="form-control" placeholder="Any notes or remarks"></textarea>
                        </div>
                        <button id="sendEmailButton" onclick="sendEmails()" type="button" class="btn btn-success text-light"><i class="fa fa-envelope"></i> Send Emails</button>
                        <button id="sendEmailDummyButton" class="btn btn-success text-light d-none" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Please wait...
                        </button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function sendEmails() {
        if (confirm("Are you sure you want send emails?") == false) {
            return;
        }
        document.getElementById("sendEmailButton").classList.toggle("d-none");
        document.getElementById("sendEmailDummyButton").classList.toggle("d-none");
        document.getElementById("messFeeForm").submit();
    }
</script>
@endsection
