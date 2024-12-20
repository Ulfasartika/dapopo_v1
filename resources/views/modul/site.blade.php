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
                @if ($errors->has('file'))
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $errors->first('file') }}</strong>
                </span>
                @endif
                @if ($success = Session::get('Success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">x</button>
                    <strong>{{ $success }}</strong>
                </div>
                @endif

                <div class="col">
                    <a href="{{ route('site.create') }}" class="btn btn-primary px-3"><i class="bx bx-plus me-1"></i>Add Site</a>
                    <button type="button" class="btn btn-info px-3" data-bs-toggle="modal" data-bs-target="#importSite"><i class="bx bx-import me-1"></i>Import Site</button>
                </div>

                <div class="modal fade" id="importSite" tabindex="-1" role="dialog" aria-labelledby="exampleVerticallycenteredModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <form action="{{ route('site.import') }}" method="POST" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleVerticallycenteredModal">Import Data Site</h5>
                                </div>
                                <div class="modal-body">
                                    {{ csrf_field() }}
                                    <label>Select Data Source</label>
                                    <small>xls,xlsx,csv</small>
                                    <div class="form-group">
                                        <input type="file" name="file" required>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Import</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <br>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Site ID</th>
                                <th>Site Name</th>
                                <th>Kabupaten</th>
                                <th>Address</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sites as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->site_id}}</td>
                                    <td>{{ $item->site_name }}</td>
                                    <td>{{ $item->area ? $item->area->area : 'No Area Assigned' }}</td>
                                    <td>{{ $item->address }}</td>
                                    <td>{{ $item->created_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $item->updated_at->format('Y-m-d H:i') }}</td>
                                    <td>{{ $item->updatedBy->name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="d-flex gap-2">
                                            <a href="{{ route('site.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                <i class="bx bx-edit"></i>
                                            </a>
                                            <form action="{{ route('site.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
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
                            <tr>
                                <th>No.</th>
                                <th>Site ID</th>
                                <th>Site Name</th>
                                <th>Kabupaten</th>
                                <th>Address</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
