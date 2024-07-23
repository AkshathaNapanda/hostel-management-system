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
                        <strong>{{ __('New Admission') }}</strong>
                        <a href="{{ route('admissions.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> Show All</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form id="admissionForm" action="{{ route('admissions.store') }}" method="POST">
                        @csrf
                        <h5 class="mb-3">Student Details</h5>
                        <div class="form-group mb-3">
                            <label for="studentName">Student Name <span class="text-danger">*</span></label>
                            <input name="studentName" id="studentName" type="text" class="form-control {{ $errors->has('studentName') ? ' is-invalid' : '' }}" value="{{ old('studentName') }}">
                            <p class="invalid-feedback">{{ $errors->first('studentName') }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="studentClass">Student Class <span class="text-danger">*</span></label>
                            <input name="studentClass" id="studentClass" type="text" class="form-control {{ $errors->has('studentClass') ? ' is-invalid' : '' }}" value="{{ old('studentClass') }}">
                            <p class="invalid-feedback">{{ $errors->first('studentClass') }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="studentCourse">Student Course <span class="text-danger">*</span></label>
                            <input name="studentCourse" id="studentCourse" type="text" class="form-control {{ $errors->has('studentCourse') ? ' is-invalid' : '' }}" value="{{ old('studentCourse') }}">
                            <p class="invalid-feedback">{{ $errors->first('studentCourse') }}</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="studentPhone">Student Phone <span class="text-danger">*</span></label>
                                    <input name="studentPhone" id="studentPhone" type="text" class="form-control {{ $errors->has('studentPhone') ? ' is-invalid' : '' }}" placeholder="10 digit phone number" value="{{ old('studentPhone') }}">
                                    <p class="invalid-feedback">{{ $errors->first('studentPhone') }}</p>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group mb-3">
                                    <label for="studentEmail">Student Email <span class="text-danger">*</span></label>
                                    <input name="studentEmail" id="studentEmail" type="text" class="form-control {{ $errors->has('studentEmail') ? ' is-invalid' : '' }}" placeholder="valid email address" value="{{ old('studentEmail') }}">
                                    <p class="invalid-feedback">{{ $errors->first('studentEmail') }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="studentAddress">Student Address <span class="text-danger">*</span></label>
                            <textarea name="studentAddress" id="studentAddress" class="form-control {{ $errors->has('studentAddress') ? ' is-invalid' : '' }}">{{ old('studentAddress') }}</textarea>
                            <p class="invalid-feedback">{{ $errors->first('studentAddress') }}</p>
                        </div>
                        <hr />
                        <h5 class="mb-3">Parent / Guardian Details</h5>
                        <div class="form-group mb-3">
                            <label for="parentName">Parent / Guardian Name <span class="text-danger">*</span></label>
                            <input name="parentName" id="parentName" type="text" class="form-control {{ $errors->has('parentName') ? ' is-invalid' : '' }}" value="{{ old('parentName') }}">
                            <p class="invalid-feedback">{{ $errors->first('parentName') }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="parentEmail">Parent / Guardian Email <span class="text-danger">*</span></label>
                            <input name="parentEmail" id="parentEmail" type="text" class="form-control {{ $errors->has('parentEmail') ? ' is-invalid' : '' }}" placeholder="valid email address" value="{{ old('parentEmail') }}">
                            <p class="invalid-feedback">{{ $errors->first('parentEmail') }}</p>
                        </div>
                        <div class="form-group mb-3">
                            <label for="parentAddress">Parent / Guardian Address <span class="text-danger">*</span></label>
                            <textarea name="parentAddress" id="parentAddress" class="form-control {{ $errors->has('parentAddress') ? ' is-invalid' : '' }}">{{ old('parentAddress') }}</textarea>
                            <p class="invalid-feedback">{{ $errors->first('parentAddress') }}</p>
                        </div>
                    </form>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-center">
                        <button type="button" form="admissionForm" class="btn btn-success mx-2" onclick="submitAdmissionForm()">Submit</button>
                        <button type="reset" form="admissionForm" class="btn btn-danger mx-2">Reset</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitAdmissionForm() {
        if (confirm("Do you want to add the student?") == true) {
            document.getElementById("admissionForm").submit();
        }
    }
</script>
@endsection
