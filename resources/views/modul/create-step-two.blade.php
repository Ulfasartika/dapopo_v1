@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div id="smartwizard">
                    <form class="row g-3" id="submitRecti" method="POST" action="{{ route('rectifier.create.step.two.post') }}">
                        @csrf
                        <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                            <div class="card">
                                <div class="card-body pg-5">
                                    <div class="col-md-12">
                                        <label for="inputIdPelanggan" class="form-label">ID Pelanggan</label>
                                        <input type="text" name="id_pelanggan" class="form-control" id="inputIdPelanggan">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="inputDaya" class="form-label">Daya PLN</label>
                                        <select class="form-control" name="daya_pln">
                                            <option value="">--</option>
                                            <option value="7.7">7.7</option>
                                            <option value="10.5">10.5</option>
                                            <option value="13.2">13.2</option>
                                            <option value="16.5">16.5</option>
                                            <option value="23">23</option>
                                            <option value="33">33</option>
                                            <option value=">33">>33</option>
                                        </select>
                                    </div>
                                    <!-- Tombol Navigasi -->
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="{{ route('rectifier.create.step.one') }}" id="prev-btn" class="btn btn-secondary">Previous</a>
                                        <a href="{{ route('rectifier.create.step.three') }}" id="next-btn" class="btn btn-primary">Next</a>
                                        <button type="button" id="cancel-btn" class="btn btn-danger">Cancel</button>
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
