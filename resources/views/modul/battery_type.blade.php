@extends('layout.main')
@section('content')
<div class="page-content">
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <div class="col">
                    <a href="{{ route('battery_type.create') }}" class="btn btn-primary px-5"><i class='bx bx-plus mr-1'></i>Add Type</a>
                </div>
                <br/>
                <table id="example" class="table table striped table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Battery Type</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item['battery_type'] }}</td>
                                <td>{{ $item['created_at'] }}</td>
                                <td>{{ $item['updated_at'] }}</td>
                                <td>
                                    <div class="action-buttons"></div>
                                    <a href="{{ route('battery_type.edit', $item->id) }}"
                                        class="btn btn-warning btn-sm"><i class="bx bx-edit"></i></a>
                                    <form action="{{ route('battery_type.destroy', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="bx bx-trash-alt"></i></button>
                                    </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Battery Type</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection