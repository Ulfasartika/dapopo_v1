@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div id="smartwizard">
                    <form class="row g-3" id="submitRecti" method="POST" action="{{ route('rectifier.create.step.one.post') }}">
                        @csrf
                        <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                            <div class="card">
                                <div class="card-body pg-5">
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
                                    <!-- Tombol Navigasi -->
                                    <div class="d-flex justify-content-between mt-3">
                                        <a href="{{ route('rectifier.create.step.two') }}" class="btn btn-primary" id="next-btn">Next</a>
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
