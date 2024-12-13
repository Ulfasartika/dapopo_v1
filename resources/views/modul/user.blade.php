@extends('layout.main')
@section('content')
    <div class="page-content">
        @if(session('success'))
        <div class="alert border-0 border-start border-5 border-primary alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('warning'))
    <div class="alert border-0 border-start border-5 border-secondary alert-dismissible fade show">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))
        <div class="alert  border-0 border-start border-5 border-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ route('user.create') }}" class="btn btn-primary px-5"><i class='bx bx-plus mr-1'></i>Add User</a>
                </div>
                <br/>
                <div class="table-responsive">
                    <table id=example class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Role</th>
                                <th>Created At</th>
                                {{-- <th>Action</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->username }}</td>
                                    <td>{{ Str::ucfirst($item['role']) }}</td>
                                    <td>{{ $item->created_at->format('d F y H:i:s') }}</td>
                                    {{-- <td>
                                        <div class="action-buttons">
                                        <form action="{{ route('user.destroy', $item['id']) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm ('Are you sure you want to delete this data?')"><i class="bx bx-trash-alt"></i></button>
                                        </form>
                                        </div>
                                    </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>No</th>
                            <th>Name</th>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Created At</th>
                            {{-- <th>Action</th> --}}
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection