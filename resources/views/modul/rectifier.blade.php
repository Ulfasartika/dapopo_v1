@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div id="smartwizard">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#step-1"> <strong>Step 1</strong>
                                <br>Select Site To Add Rectifier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-2"> <strong>Step 2</strong>
                                <br>Submit Data KWh Meter</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#step-3"> <strong>Step 3</strong>
                                <br>Submit Data Rectifier</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <div class="card">
                                <div class="card-body pg-5">
                                    <form class="row g-3">
                                        <div class="form-group col-md-12">
                                            <label for="site">Pilih Site</label>
                                            <select class="form-control single-select" id="selectSite" name="site_id">
                                                <option value="">Pilih Site</option>
                                                @foreach ($sites as $site)
                                                    <option value="{{ $site->id }}" data-address="{{ $site->address }}">{{ $site->site_id }}-{{ $site->site_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control" id="address" name="address" readonly>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <div class="card">
                                <div class="card-body pg-5">
                                    <form action="" class="row g-3">
                                        <div class="col-md-12">
                                            <label for="inputIdPelanggan" class="form-label">ID Pelanggan</label>
                                            <input type="text" class="form-control" id="inputIdPelanggan">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputDaya" class="form-label">Daya PLN</label>
                                            <select class="form-control">
                                                <option value="">--</option>
                                                <option value="">7.7 kVA</option>
                                                <option value="">10.5 kVA</option>
                                                <option value="">13.2 kVA</option>
                                                <option value="">16.5 kVA</option>
                                                <option value="">23 kVA</option>
                                                <option value="">33 kVA</option>
                                                <option value="">>33 kVA</option>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                            <div class="card" style="max-height: 400px; overflow-y: auto;">
                                <div class="card-body pg-5">
                                    <form action="" class="row g-3">
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Rectifier Name</label>
                                            <i class="text-primary" id="addRectifier" data-feather="plus-circle"
                                                style="cursor: pointer;"></i>
                                            <input type="text" class="form-control" id="addRectifier"
                                                placeholder="Rectifier 1" disabled>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="" class="form-label">Rectifier Brand</label>
                                            <select for="inputRectifierBrand" class="form-control">
                                                <option value="">--</option>
                                                <option value="">Emerson</option>
                                                <option value="">Hariff</option>
                                                <option value="">Vertiv</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputBatteryBrand" class="form-label">Battery Brand</label>
                                            <select for="inputBatteryBrand" class="form-control">
                                                <option value="">--</option>
                                                @foreach ($batteries as $brand)
                                                    <option value="{{ $brand->id }}">{{ $brand->merk_battery }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="inputBatteryType" class="form-label">Battery Type</label>
                                            <select class="form-control">
                                                <option value="">--</option>
                                                @foreach ($battery_type as $type)
                                                    <option value="{{ $type->id }}">{{ $type->battery_type }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="additionalBattery input-group mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="batteryQuantity">Battery Quantity</label>
                                                <i type="button" class="text-primary" id="addBattery"
                                                    data-feather="plus-circle" style="cursor: pointer;"></i>
                                            </div>
                                            <div class="col-8">
                                                <select class="form-control" id="batteryQuantity">
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
                                                <option selected>Battery Status</option>
                                                <option value="1">Good</option>
                                                <option value="2">Degraded</option>
                                            </select>
                                        </div>
                                        <div id="additionalBattery"></div> <!-- Tempat untuk input baterai tambahan -->
                                        <div class="col-md-12">
                                            <label class="form-label">APR Quantity</label>
                                            <select class="form-control">
                                                <option value="">--</option>
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
                                        <div class="col-md-12">
                                            <label for="basic-addon2" class="form-label">Bus Voltage</label>
                                            <div class="input-group input-group mb-3"> <span class="input-group-text"
                                                    id="inputGroup-sizing-sm">Volt</span>
                                                <input type="text" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label for="basic-addon2" class="form-label">Load</label>
                                            <div class="input-group input-group mb-3"> <span class="input-group-text"
                                                    id="inputGroup-sizing-sm">Ampere</span>
                                                <input type="text" class="form-control"
                                                    aria-label="Sizing example input"
                                                    aria-describedby="inputGroup-sizing-sm">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Battery Backup Time</label>
                                            <select class="form-control">
                                                <option value="">--</option>
                                                <option value="">0</option>
                                                <option value="">1</option>
                                                <option value="">2</option>
                                                <option value="">3</option>
                                                <option value="">4</option>
                                                <option value="">5</option>
                                                <option value="">6</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12">
                                            <label class="form-label">Equipment Connected</label>
                                            <select class="multiple-select" multiple="multiple">
                                                @foreach ($equipments as $item)
                                                    <option value="{{ $item->id }}">{{ $item->equipment_name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </form>
                                </div>
                                <div id="additionalRectifier"></div> <!-- Tempat untuk input rectifier tambahan -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
