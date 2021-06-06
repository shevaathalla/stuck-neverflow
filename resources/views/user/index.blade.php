@extends('layouts.base')
@section('title')
    <title>User List</title>
@endsection
@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h2>User List</h2>
    <hr>
    <div class="card shadow">
        <div class="card-header text-primary font-weight-bold">
            Data user
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Action</td>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <td>ID</td>
                            <td>Name</td>
                            <td>Email</td>
                            <td>Action</td>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><a class="card-link font-weight-bold"
                                        href="{{ route('user.show', ['user' => $user]) }}">{{ $user->name }}</a></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a class="btn btn-circle btn-danger" data-toggle="modal"
                                        data-target="#modal{{ $user->id }}"><i class="fas fa-trash-alt"></i></a>
                                    <div class="modal fade" id="modal{{ $user->id }}" tabindex="-1"
                                        aria-labelledby="modalLabel{{ $user->id }}" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalLabel{{ $user->id }}">Account Id :
                                                        {{ $user->id }} </h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are u sure?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Close</button>
                                                    <a class="btn btn-danger"
                                                        href="{{ route('user.destroy', ['user' => $user]) }}"
                                                        onclick="event.preventDefault(); document.getElementById('delete-account{{ $user->id }}').submit();">{{ __('Delete') }}</a>
                                                    <form id="delete-account{{ $user->id }}"
                                                        action="{{ route('user.destroy', ['user' => $user]) }}"
                                                        method="POST" style="display: none;">
                                                        @csrf
                                                        @method('delete')
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($user->email_verified_at == null)
                                    <a href="{{ route('user.verify',['user'=>$user]) }}" class="btn btn-circle btn-info"><i class="fas fa-check-circle"></i></a>
                                    @endif                                    
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush
