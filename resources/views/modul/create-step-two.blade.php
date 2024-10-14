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
                    <form action="{{ route('rectifier.create.step.two.post') }}" class="row g-3" id=""
                        method="POST">
                        @csrf
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <div class="card">
                                <div class="card-body pg-5">
                                    <div class="col-md-12">
                                        <label for="inputIdPelanggan" class="form-label">ID Pelanggan</label>
                                        <input type="text" name="id_pelanggan" class="form-control"
                                            id="inputIdPelanggan">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputDaya" class="form-label">Daya PLN</label>
                                        <select class="form-control" name="daya_pln">
                                            <option value="">--</option>
                                            <option value="">7.7</option>
                                            <option value="">10.5</option>
                                            <option value="">13.2</option>
                                            <option value="">16.5</option>
                                            <option value="">23</option>
                                            <option value="">33</option>
                                            <option value="">>33</option>
                                        </select>
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