@extends('layouts.app')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <h2 class="page-title">
                {{ __('Users') }}
            </h2>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">

            <div class="alert alert-info">
                <div class="alert-title">Sample table page</div>
            </div>


            <div class="card">
                <div class="table-responsive">
                    <table class="table table-vcenter card-table table-striped" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>{{ __('Name') }}</th>
                                <th>{{ __('Email Address') }}</th>
                                <th>{{ __('Phone') }}</th>
                                <th>{{ __('Created at') }}</th>
                                <th class="w-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td class="text-reset"><a href="{{ route('users.show', $user) }}">{{ $user->first_name }}</a></td>
                                <td class="text-muted">{{ $user->email }}</td>
                                <td class="text-muted">{{ $user->phone_number }}</td>
                                <td class="text-muted">{{ $user->created_at->diffForhumans() }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $user) }}">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                @if( $users->hasPages() )
                <div class="card-footer pb-0">
                    {{ $users->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
