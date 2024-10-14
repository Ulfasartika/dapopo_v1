@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
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
                    <form action="{{ route('rectifier.create.step.one.post') }}" class="row g-3" id=""
                        method="POST">
                        @csrf
                        <div class="tab-content">
                            <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                <div class="card">
                                    <div class="card-body pg-5">
                                        <div class="form-group col-md-12">
                                            <label for="site">Pilih Site</label>
                                            <select class="form-control single-select" id="selectSite" name="site_id">
                                                <option value="">Pilih Site</option>
                                                @foreach ($sites as $site)
                                                    <option value="{{ $site->id }}" data-address="{{ $site->address }}">
                                                        {{ $site->site_id }}-{{ $site->site_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="address">Alamat</label>
                                            <input type="text" class="form-control" id="address" name="address"
                                                readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
