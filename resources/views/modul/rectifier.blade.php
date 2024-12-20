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
                    <a href="{{ route('rectifier.create') }}" class="btn btn-primary btn-md">
                        <i class='bx bx-plus mr-1'></i>Submit Data
                    </a>
                </div>
                <br />                
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">  
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Rectifier Name</th>
                                <th>APR Quantity</th>
                                <th>Backup Time</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Updated By</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rectifiers as $rectifier)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $rectifier->site->site_id }} - {{ $rectifier->site->site_name }}</td>
                                    <td>{{ $rectifier->recti_name }}</td>
                                    <td>{{ $rectifier->apr_quantity }}</td>
                                    <td>{{ $rectifier->backup_time }} Hours</td>  
                                    <td>{{ $rectifier->created_at }}</td>
                                    <td>{{ $rectifier->updated_at }}</td>
                                    <td>{{ $rectifier->updatedBy->name ?? 'N/A' }}</td>                                  
                                    <td>
                                        <div class="action-buttons">
                                            <form action="{{ route('rectifier.edit', $rectifier->id) }}" method="GET" style="display: inline;">
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('rectifier.destroy', $rectifier->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">
                                                    <i class="bx bx-trash-alt"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#siteDetail{{ $rectifier->id }}">
                                                <i class="fadeIn animated bx bx-show-alt"></i>
                                            </button>
                                        </div>

                                        <!-- Modal for Detailed Information -->
                                        <div class="modal fade" id="siteDetail{{ $rectifier->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Detailed Rectifier Potential Data</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-xl mx-auto">
                                                                <div class="row mb-3">
                                                                    <label class="col-md col-form-label">Site ID - Site Name</label>
                                                                    <div class="col-md">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->site->site_id }} - {{ $rectifier->site->site_name }}                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Rectifier Name</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->recti_name }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Rectifier Brand</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->recti_brand }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">APR Quantity</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->apr_quantity }} Units
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Bus Voltage</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->bus_voltage }} Volt
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Load</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->load }} Ampere
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Battery Brand</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->batterybrand->battery_brand ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Battery Type</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->batterytype->battery_type ?? 'N/A' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Total Battery</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->total_battery }}
                                                                            {{ strtolower($rectifier->batterytype->battery_type ?? '') === 'lithium' ? 'Packs' : 'Units' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Good Battery</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->good_battery }}
                                                                            {{ strtolower($rectifier->batterytype->battery_type ?? '') === 'lithium' ? 'Packs' : 'Units' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Degraded Battery</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->degraded_battery }}
                                                                            {{ strtolower($rectifier->batterytype->battery_type ?? '') === 'lithium' ? 'Packs' : 'Units' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Stolen Battery</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->stolen_battery }}
                                                                            {{ strtolower($rectifier->batterytype->battery_type ?? '') === 'lithium' ? 'Packs' : 'Units' }}
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Battery Backup Time</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            {{ $rectifier->backup_time }} Hours
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Equipment Connected</label>
                                                                    <div class="col-sm">
                                                                        <span class="form-control">
                                                                            @if ($rectifier->equipments->isNotEmpty())
                                                                                {{ $rectifier->equipments->pluck('equipment_name')->join(', ') }}
                                                                            @else
                                                                                -
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <label class="col-sm col-form-label">Rectifier Photo</label>
                                                                    <div class="col-sm">
                                                                        @if ($rectifier->image)
                                                                            <img src="{{ asset('storage/' . $rectifier->image) }}" alt="Rectifier Image" class="img-fluid" />
                                                                        @else
                                                                            <p>No image available</p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                <th>Rectifier Name</th>
                                <th>APR Quantity</th>
                                <th>Backup Time</th>
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
