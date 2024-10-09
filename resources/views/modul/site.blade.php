@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                </div>
                <div class="col">
                    <a href="{{ route('site.create') }}" class="btn btn-primary px-5"><i class='bx bx-plus mr-1'></i>Add Site</a>
                </div>
                <br/>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Site ID</th>
                                <th>Site Name</th>
                                <th>Address</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item['site_id'] }}</td>
                                    <td>{{ $item['site_name'] }}</td>
                                    <td>{{ $item['address'] }}</td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td>{{ $item['updated_at'] }}</td>
                                    <td>
                                        <div class="action-buttons">
                                        <a href="{{ route('site.edit', $item->id) }}" class="btn btn-warning btn-sm"> <i class="bx bx-edit"></i></a>
                                        <form action="{{ route('site.destroy', $item['id']) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm ('Are you sure you want to delete this data?')"><i class="bx bx-trash-alt"></i></button>
                                        </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No.</th>
                                <th>Site ID</th>
                                <th>Site Name</th>
                                <th>Address</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    @endsection
