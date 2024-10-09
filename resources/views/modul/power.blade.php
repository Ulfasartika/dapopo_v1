@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <div class="col">
                        <a href="{{ route('rectifier.create') }}" class="btn btn-primary px-5"><i class='bx bx-plus mr-1'></i>Add</a>
                    </div>
                    <br/>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>Site ID</th>
                                <th>Rectifier</th>
                                <th>KWh Meter</th>
                                <th>Battery</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    Dum 1 - Sudirman
                                </td>

                                <td>
                                    <!-- Teks yang mengisi cell tabel dan memicu modal -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalrecti">
                                        Rectifier 1
                                    </a>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="modalrecti" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Data Rectifier</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xl-9 mx-auto">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="border p-3 rounded">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nama Rectifier</label>
                                                                        <select class="single-select">
                                                                            <option value="">Rectifier 1</option>
                                                                            <option value="">Rectifier 2</option>
                                                                            <option value="">Rectifier 3</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Merk Rectifier</label>
                                                                        <select class="single-select">
                                                                            <option value="">Emerson</option>
                                                                            <option value="">Hariff</option>
                                                                            <option value="">Vertiv</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3 select2-sm">
                                                                        <label class="form-label">Jumlah Module APR</label>
                                                                        <select class="single-select">
                                                                            <option value="">1</option>
                                                                            <option value="">2</option>
                                                                            <option value="">3</option>
                                                                            <option value="">4</option>
                                                                            <option value="">5</option>
                                                                            <option value="">6</option>
                                                                            <option value="">7</option>
                                                                            <option value="">8</option>
                                                                            <option value="">9</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Bus Voltage</label>
                                                                        <div class="input-group input-group mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">Volt</span>
                                                                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Load</label>
                                                                        <div class="input-group input-group mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">Ampere</span>
                                                                            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                                        </div>

                                                                    </div>
                                                                    <div class="mb-3 select2-sm">
                                                                        <label class="form-label">Battery Backup Time</label>
                                                                        <select class="single-select">
                                                                            <option value="">0 Jam</option>
                                                                            <option value="">1 Jam</option>
                                                                            <option value="">2 Jam</option>
                                                                            <option value="">3 Jam</option>
                                                                            <option value="">4 Jam</option>
                                                                            <option value="">5 Jam</option>
                                                                            <option value="">6 Jam</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Equipment Connected</label>
                                                                        <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                                                                            <option value="" selected>Baseband</option>
                                                                            <option value="" selected>RRU</option>
                                                                            <option value="" selected>Minilink TN</option>
                                                                            <option value="">GPON</option>
                                                                            <option value="">NEC</option>
                                                                            <option value="">BSC</option>
                                                                            <option value="">Router</option>
                                                                            <option value="">OLT</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td>
                                    <!-- Teks yang mengisi cell tabel dan memicu modal -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalkwh">
                                        111111111111
                                    </a>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="modalkwh" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Data KWh Meter</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xl-9 mx-auto">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="border p-3 rounded">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">ID Pelanggan</label>
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Daya PLN</label>
                                                                        <select class="single-select">
                                                                            <option value="">7.7 kVA</option>
                                                                            <option value="">10.5 kVA</option>
                                                                            <option value="">13.2 kVA</option>
                                                                            <option value="">16.5 kVA</option>
                                                                            <option value="">23 kVA</option>
                                                                            <option value="">33 kVA</option>
                                                                            <option value="">>7.7 kVA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <td>
                                    <!-- Teks yang mengisi cell tabel dan memicu modal -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalbat">
                                        VRLA
                                    </a>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade" id="modalbat" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Data Baterai</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xl-9 mx-auto">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="border p-3 rounded">
                                                                <div class="mb-3">
                                                                        <label class="form-label">Merk Baterai</label>
                                                                        <select class="single-select">
                                                                            <option value="United States">Merk 1</option>
                                                                            <option value="United Kingdom">Merk 2</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Jenis Baterai</label>
                                                                        <select class="single-select">
                                                                            <option value="United States">Lithium</option>
                                                                            <option value="United Kingdom">VRLA</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group mb-3">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label" for="addBattery">Jumlah Baterai </label>
                                                                            <i type="button" class="text-primary" id="addBattery" data-feather="plus-circle" style="cursor: pointer;"></i>
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <select class="form-control" id="batteryInput">
                                                                                <option value="">--</option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value=">6">>6</option>
                                                                            </select>
                                                                        </div>
                                                                        <select class="form-select" id="inputGroupSelect01">
                                                                            <option selected>Kondisi Baterai</option>
                                                                            <option value="1">Good</option>
                                                                            <option value="2">Degraded</option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="additionalBattery">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td>2011/04/25</td>
                                    <td>2011/07/25</td>
                            </tr>

                            <tr>
                                <td>
                                    Site 2 - Purnama
                                </td>

                                <td>
                                    <!-- Teks yang mengisi cell tabel dan memicu modal -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalrecti">
                                        Rectifier 1
                                    </a>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="modalrecti" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Data Rectifier</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xl-9 mx-auto">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="border p-3 rounded">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Nama Rectifier</label>
                                                                        <select class="single-select">
                                                                            <option value="United States">Rectifier 1</option>
                                                                            <option value="United Kingdom">Rectifier 2</option>
                                                                            <option value="Afghanistan">Rectifier 3</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Merk Rectifier</label>
                                                                        <select class="single-select">
                                                                            <option value="United States">Emerson</option>
                                                                            <option value="United Kingdom">Hariff</option>
                                                                            <option value="Afghanistan">Vertiv</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3 select2-sm">
                                                                        <label class="form-label">Jumlah APR</label>
                                                                        <select class="single-select">
                                                                            <option value="">1</option>
                                                                            <option value="">2</option>
                                                                            <option value="">3</option>
                                                                            <option value="">4</option>
                                                                            <option value="">5</option>
                                                                            <option value="">6</option>
                                                                            <option value="">7</option>
                                                                            <option value="">8</option>
                                                                            <option value="">9</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Bus Voltage</label>
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Load</label>
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                                                    </div>
                                                                    <div class="mb-3 select2-sm">
                                                                        <label class="form-label">Battery Backup Time</label>
                                                                        <select class="single-select">
                                                                            <option value="">0 Jam</option>
                                                                            <option value="">1 Jam</option>
                                                                            <option value="">2 Jam</option>
                                                                            <option value="">3 Jam</option>
                                                                            <option value="">4 Jam</option>
                                                                            <option value="">5 Jam</option>
                                                                            <option value="">6 Jam</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Equipment Connected</label>
                                                                        <select class="multiple-select" data-placeholder="Choose anything" multiple="multiple">
                                                                            <option value="United States" selected>Baseband</option>
                                                                            <option value="United Kingdom" selected>RRU</option>
                                                                            <option value="Afghanistan" selected>Minilink TN</option>
                                                                            <option value="Aland Islands">GPON</option>
                                                                            <option value="Albania">NEC</option>
                                                                            <option value="Algeria">BSC</option>
                                                                            <option value="American Samoa">Router</option>
                                                                            <option value="Andorra">OLT</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <td>
                                    <!-- Teks yang mengisi cell tabel dan memicu modal -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalkwh">
                                        222222222222
                                    </a>
                                </td>

                                <!-- Modal -->
                                <div class="modal fade" id="modalkwh" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Data KWh Meter</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xl-9 mx-auto">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="border p-3 rounded">
                                                                    <div class="mb-3">
                                                                        <label class="form-label">ID Pelanggan</label>
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon2">
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Daya PLN</label>
                                                                        <select class="single-select">
                                                                            <option value="United States">7.7 kVA</option>
                                                                            <option value="United Kingdom">10.5 kVA</option>
                                                                            <option value="Afghanistan">13.2 kVA</option>
                                                                            <option value="United States">16.5 kVA</option>
                                                                            <option value="United Kingdom">23 kVA</option>
                                                                            <option value="Afghanistan">33 kVA</option>
                                                                            <option value="Afghanistan">>7.7 kVA</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <td>
                                    <!-- Teks yang mengisi cell tabel dan memicu modal -->
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#modalbat">
                                        VRLA
                                    </a>
                                </td>
                                <!-- Modal -->
                                <div class="modal fade" id="modalbat" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-fullscreen">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Data Baterai</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-xl-9 mx-auto">
                                                        <div class="card">
                                                            <div class="card-body">
                                                                <div class="border p-3 rounded">
                                                                <label class="form-label">Merk Baterai</label>
                                                                        <select class="single-select">
                                                                            <option value="United States">Merk 1</option>
                                                                            <option value="United Kingdom">Merk 2</option>
                                                                        </select>
                                                                    <div class="mb-3">
                                                                        <label class="form-label">Jenis Baterai</label>
                                                                        <select class="single-select">
                                                                            <option value="United States">Lithium</option>
                                                                            <option value="United Kingdom">VRLA</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="input-group mb-3">
                                                                        <div class="col-md-12">
                                                                            <label class="form-label" for="addBattery">Jumlah Baterai </label>
                                                                            <i type="button" class="text-primary" id="addBattery" data-feather="plus-circle" style="cursor: pointer;"></i>
                                                                        </div>
                                                                        <div class="col-8">
                                                                            <select class="form-control" id="batteryInput">
                                                                                <option value="">--</option>
                                                                                <option value="1">1</option>
                                                                                <option value="2">2</option>
                                                                                <option value="3">3</option>
                                                                                <option value="4">4</option>
                                                                                <option value="5">5</option>
                                                                                <option value="6">6</option>
                                                                                <option value=">6">>6</option>
                                                                            </select>
                                                                        </div>
                                                                        <select class="form-select" id="inputGroupSelect01">
                                                                            <option selected>Kondisi Baterai</option>
                                                                            <option value="1">Good</option>
                                                                            <option value="2">Degraded</option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="additionalBattery">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <td>2011/04/25</td>
                                    <td>2011/07/25</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Site ID</th>
                                <th>Rectifier</th>
                                <th>KWh Meter</th>
                                <th>Battery</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection