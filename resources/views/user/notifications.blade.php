@extends('layouts.base')
@section('title')
    <title>User Notification</title>
@endsection
@section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
    <h2>Notification List</h2>
    <hr>
    <div class="card shadow">
        <div class="card-header text-primary font-weight-bold">
            User Notification
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>Message</td>                            
                            <td>Type</td>
                            <td>Time</td>
                        </tr>
                    </thead>                    
                    <tbody>
                       @foreach (Auth::user()->notifications as $notification)
                       <tr>
                        <td>{{ $notification->id }}</td>
                           <td> <a class="font-weight-bold" href="{{ route('notification.show',['user' => Auth::user(), 'notification' => $notification ]) }}">{{ $notification->message }}</a></td>                           
                           <td>{{ $notification->type }}</td>
                           <td>{{ $notification->created_at }}</td>
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
