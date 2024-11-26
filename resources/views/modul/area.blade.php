@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ route('area.create') }}" class="btn btn-primary px-5"><i class='bx bx-plus mr-1'></i>Add Area</a>
                </div>
                <br/>
                <div class="table-responsive">
                    <table id=example class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kabupaten</th>
                                <th>User</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($areas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->area }}</td>
                                    <td>{{ $item->user ? $item->user->name : 'No User Assigned' }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('area.edit', $item->id) }}" class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                            <form action="{{ route('area.destroy', $item->id) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">
                                                    <i class="bx bx-trash-alt"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>No</th>
                            <th>Kabupaten</th>
                            <th>User</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection