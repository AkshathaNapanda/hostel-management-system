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
                        <strong>{{ __('List of Mess Fees') }}</strong>
                        <a href="{{ route('mess-fees.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> New Mess Fees</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (\Session::has('success'))
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        {!! \Session::get('success') !!}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <table class="table table-striped table-bordered mb-3">
                        <thead class="bg-secondary text-light">
                            <tr>
                                <th>Id</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Email Count</th>
                            </tr>
                        </thead>
                        @if(count($messFees) == 0)
                        <tbody>
                            <tr>
                                <td colspan="4" class="text-center">No mess fee emails sent</td>
                            </tr>
                        </tbody>
                        @else
                        <tbody>
                            @foreach($messFees as $index => $messFee)
                                <tr>
                                    <td>{{ $index + $messFees->firstItem() }}</td>
                                    <td>{{ date('d-m-Y', strtotime($messFee->created_at)) }}</td>
                                    <td>{{ $messFee->amount }}</td>
                                    <td>{{ $messFee->email_count }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        @endif
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $messFees->links("pagination::bootstrap-4") }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
