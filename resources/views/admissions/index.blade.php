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
                        <strong>{{ __('List of Admissions') }}</strong>
                        <a href="{{ route('admissions.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> Add New</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (\Session::has('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {!! \Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form id="searchForm" action="{{ route('admissions.search') }}" method="GET" class="mb-3">
                        @csrf
                        <div class="row">
                            <div class="col-sm-11">
                                <input name="searchQuery" type="text" class="form-control" placeholder="Search student by name / phone no / email" autofocus>
                            </div>
                            <div class="col-sm-1">
                                <button type="submit" form="searchForm" class="btn btn-secondary"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>

                    <table class="table table-striped table-bordered mb-3">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>Student Id</th>
                                <th>Student Name</th>
                                <th>Student Phone</th>
                                <th>Admission Date</th>
                                <th class="text-center">Admission Status</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        @if(count($students) == 0)
                        <tbody>
                            <tr>
                                <td colspan="6" class="text-center">No students available</td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach($students as $index => $student)
                            <tr>
                                <td>{{ $student->id }}</td>
                                <td>{{ $student->name }}</td>
                                <td>{{ $student->phone_no }}</td>
                                <td>{{ date("d-m-Y", strtotime($student->created_at)) }}</td>
                                <td class="text-center">
                                    <div class="d-grid">
                                        @if($student->admission_status == 1)
                                            <a class="btn btn-success" href="{{ route('admissions.update.admission-status', ['admission' => $student->id]) }}">ACTIVE</a>
                                        @else
                                            <a class="btn btn-danger" href="{{ route('admissions.update.admission-status', ['admission' => $student->id]) }}">INACTIVE</a>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('admissions.show', ['admission' => $student->id]) }}" class="btn btn-info k-font-size-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Show Details">
                                        <i class="fas fa-fw fa-eye text-light"></i>
                                    </a>
                                    <a href="{{ route('admissions.edit', ['admission' => $student->id]) }}" class="btn btn-warning k-font-size-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit Details">
                                        <i class="fas fa-fw fa-edit text-light"></i>
                                    </a>
                                    <form id="deleteForm{{ $index }}" class="d-inline" action="{{ route('admissions.destroy', ['admission' => $student->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="submitDeleteForm({{ $index }})" class="btn btn-danger k-font-size-sm" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Delete Admission">
                                            <i class="fas fa-fw fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $students->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitDeleteForm(index) {
        if (confirm("Are you sure to delete student?") == true) {
            document.getElementById("deleteForm"+index).submit();
        }
    }
</script>
@endsection
