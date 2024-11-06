@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ route('rectifier.create') }}" class="btn btn-primary btn-md"><i
                            class='bx bx-plus mr-1'></i>Submit Data</a>
                </div>
                <br />
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Power (Daya PLN)</th>
                                <th>APR Quantity</th>
                                <th>Battery Quantity</th>
                                <th>Backup Time</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rectifiers as $recti)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @foreach ($recti->sites as $site)
                                            {{ $site->site_id }} - {{ $site->site_name }}
                                        @endforeach
                                    </td>
                                    <td>{{ $recti['daya'] }} kVA</td>
                                    <td>{{ $recti['apr_quantity'] }} Units</td>
                                    <td>{{ $recti['battery_quantity'] }} Packs</td>
                                    <td>{{ $recti['backup_time'] }} Hours</td>
                                    <td>
                                        <div class="action-buttons">
                                            <form action="{{ route('rectifier.edit', $recti->id) }}" method="GET"
                                                style="display: inline;">
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('rectifier.destroy', $recti['id']) }}" method="POST">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm ('Are you sure you want to delete this data?')"><i
                                                        class="bx bx-trash-alt"></i></button>
                                            </form>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#siteDetail{{ $recti->id }}">
                                                <i class="fadeIn animated bx bx-show-alt"></i> </button>
                                            <div class="modal fade" id="siteDetail{{ $recti->id }}" tabindex="-1"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Detailed Power Potential Data</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-xl-9 mx-auto">
                                                                    <div class="row mb-3">
                                                                        <label for="siteId{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Site ID - Site
                                                                            Name</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->sites->pluck('site_id')->first() }}
                                                                                -
                                                                                {{ $recti->sites->pluck('site_name')->first() }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="idPelanggan{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Customer ID
                                                                            PLN</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->id_pelanggan }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="daya{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Power (Daya
                                                                            PLN)</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->daya }} kVA
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="rectiName{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Rectifier
                                                                            Name</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->recti_name }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="rectiBrand{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Rectifier
                                                                            Brand</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->recti_brand }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="aprQuantity{{ $recti->id }}"
                                                                            class="col-sm col-form-label">APR
                                                                            Quantity</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->apr_quantity }} Units
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="busVoltage{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Bus
                                                                            Voltage</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->bus_voltage }} Volt
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="load{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Load</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->load }} Ampere
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="batteryBrand{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Battery
                                                                            Brand</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->battery_brand }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="batteryType{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Battery
                                                                            Type</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->battery_type }}
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="batteryDetails{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Battery
                                                                            Details</label>
                                                                        <div class="col-sm">
                                                                            <ul class="list-group">
                                                                                @foreach ($recti->batteries as $battery)
                                                                                    <li class="list-group-item">
                                                                                        Quantity:
                                                                                        {{ $battery->battery_quantity }}
                                                                                        Packs, Status:
                                                                                        {{ $battery->battery_status }}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row mb-3">
                                                                        <label for="backupTime{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Battery Backup
                                                                            Time</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                {{ $recti->backup_time }} Hours
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="equipmentConnected{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Equipment
                                                                            Connected</label>
                                                                        <div class="col-sm">
                                                                            <span class="form-control">
                                                                                @if ($recti->equipments->isNotEmpty())
                                                                                    @foreach ($recti->equipments as $equipment)
                                                                                        {{ $equipment->equipment_name }}
                                                                                        @if (!$loop->last)
                                                                                            ,
                                                                                        @endif
                                                                                    @endforeach
                                                                                @else
                                                                                    -
                                                                                @endif
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="image{{ $recti->id }}"
                                                                            class="col-sm col-form-label">Image</label>
                                                                        <div class="col-sm">
                                                                            @if ($recti->image)
                                                                                <img src="{{ asset('images/' . $recti->image) }}"
                                                                                    alt="Rectifier Image"
                                                                                    class="img-fluid" />
                                                                            @else
                                                                                <p>No image available</p>
                                                                            @endif
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
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Power (Daya PLN)</th>
                                <th>APR Quantity</th>
                                <th>Battery Quantity</th>
                                <th>Backup Time</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
