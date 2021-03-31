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
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <button class="btn btn-circle btn-danger"><i class="fas fa-trash-alt"></i></button>
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
