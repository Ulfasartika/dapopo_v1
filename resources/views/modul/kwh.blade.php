@extends('layout.main')
@section('content')
    <div class="page-content">
        @if (session('success'))
            <div class="alert border-0 border-start border-5 border-primary alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('warning'))
            <div class="alert border-0 border-start border-5 border-secondary alert-dismissible fade show">
                {{ session('warning') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert  border-0 border-start border-5 border-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ route('kwh.create') }}" class="btn btn-primary btn-md">
                        <i class='bx bx-plus mr-1'></i>Add KWH Meter
                    </a>
                    {{-- <a href="{{ route('genset.export') }}" class="btn btn-outline-secondary btn-md"><i class='bx bx-export mr-1'></i>Export</a> --}}
                    <button type="button" class="btn btn-outline-secondary btn-md" data-bs-toggle="modal"
                        data-bs-target="#importModal">
                        <i class="bx bx-import"></i> Import
                    </button>
                    {{-- MODAL IMPORT --}}
                    <div class="modal fade" id="importModal" tabindex="-1" aria-labelledby="importModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="importModalLabel">Import Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form action="{{ route('kwh.import') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="fileInput" class="form-label">Upload File</label>
                                            <input type="file" class="form-control" id="fileInput" name="file"
                                                required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Import</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- END MODAL IMPORT --}}
                </div>
                <br />
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>ID Pelanggan</th>
                                <th>Daya</th>
                                <th>Kondisi KWh</th>
                                <th>Kondisi Segel</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kwh as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->site->site_id }} - {{ $item->site->site_name }}</td>
                                    <td>{{ $item->id_pelanggan }}</td>
                                    <td>{{ $item->daya }}</td>
                                    <td>{{ $item->kondisi_kwh }}</td>
                                    <td>{{ $item->kondisi_segel }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->updated_at }}</td>
                                    <td>{{ $item->updatedBy->name ?? 'N/A' }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <form action="{{ route('kwh.edit', $item->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('kwh.destroy', $item->id) }}" method="POST"
                                                style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Are you sure you want to delete this data?')">
                                                    <i class="bx bx-trash-alt"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#kwhDetail{{ $item->id }}">
                                                <i class="fadeIn animated bx bx-show-alt"></i>
                                            </button>
                                        </div>
                                        <div class="modal fade" id="kwhDetail{{ $item->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detailed KWh Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-xl mx-auto">
                                                                <div class="row mb-3">
                                                                    <label class="col-md col-form-label">Arus R (A)</label>
                                                                    <div class="col-md">
                                                                        <span class="form-control">
                                                                            {{ $item->arus_r ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md col-form-label">Arus S (A)</label>
                                                                    <div class="col-md">
                                                                        <span class="form-control">
                                                                            {{ $item->arus_s ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md col-form-label">Arus T (A)</label>
                                                                    <div class="col-md">
                                                                        <span class="form-control">
                                                                            {{ $item->arus_t ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md col-form-label">Phasa R</label>
                                                                    <div class="col-md">
                                                                        <span class="form-control">
                                                                            {{ $item->phasa_r ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md col-form-label">Phasa S</label>
                                                                    <div class="col-md">
                                                                        <span class="form-control">
                                                                            {{ $item->phasa_s ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md col-form-label">Phasa T</label>
                                                                    <div class="col-md">
                                                                        <span class="form-control">
                                                                            {{ $item->phasa_t ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-md col-form-label">KWh Photo</label>
                                                                    <div class="col-md">
                                                                        <span class="form-control">
                                                                            <img src="{{ asset('storage/' . $item->foto_kwh) }}"
                                                                                alt="KWH
                                                                         Image"
                                                                                class="img-fluid" />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>ID Pelanggan</th>
                                <th>Daya</th>
                                <th>Kondisi KWh</th>
                                <th>Arus PLN</th>
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
