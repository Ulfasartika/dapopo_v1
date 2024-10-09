@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                </div>
                <div class="col">
                    <a href="{{ route('kwh.create') }}" class="btn btn-primary px-5"><i class='bx bx-plus mr-1'></i>Add KWh</a>
                </div>
                <br/>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Site ID</th>
                                <th>ID Pelanggan</th>
                                <th>Daya</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $kwh)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kwh->site->site_id }}</td>
                                    <td>{{ $kwh->id_pelanggan }}</td>
                                    <td>{{ $kwh->daya }}</td>
                                    <td>{{ $kwh['created_at'] }}</td>
                                    <td>{{ $kwh['updated_at'] }}</td>
                                    <td>
                                        <div class="action-buttons">
                                        <a href="{{ route('kwh.edit', $kwh->id) }}" class="btn btn-sm btn-warning"><i class="bx bx-edit"></i></a>
                                        <form action="{{ route('kwh.destroy', $kwh->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure?')"><i class="bx bx-trash-alt"></i></button>
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
                                <th>ID Pelanggan</th>
                                <th>Daya</th>
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
