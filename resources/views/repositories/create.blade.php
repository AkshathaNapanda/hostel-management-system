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
                        <strong>{{ __('New Repository Entry') }}</strong>
                        <a href="{{ route('repositories.index') }}" class="btn btn-primary"><i class="fa fa-list"></i> Show All</a>
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

                    <form id="searchForm" action="{{ route('repositories.students.search') }}" method="GET" class="mb-3">
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
                                <th>Item</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($students)
                                @foreach($students as $index => $student)
                                    <form id="repositoriesForm{{ $index }}" action="{{ route('repositories.store') }}" method="POST" class="mb-3">
                                        @csrf
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td><input name="item" id="item" type="text" class="form-control" placeholder="eg: Luggage"></td>
                                            <td class="text-center"><button type="button" class="btn btn-success" onclick="submitRepositoriesForm({{ $index }})"><i class="fa fa-plus"></i> Add</button></td>
                                        </tr>
                                        <input type="hidden" name="studentId" id="studentId" value="{{ $student->id }}">
                                    </form>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        @isset($students)
                        {{ $students->links("pagination::bootstrap-4") }}
                        @endisset
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function submitRepositoriesForm(index) {
        if (confirm("Are you sure to add item to repository?") == true) {
            document.getElementById("repositoriesForm"+index).submit();
        }
    }
</script>
@endsection
