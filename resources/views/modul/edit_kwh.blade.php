@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body">
                <div class="card-title d-flex align-items-center">
                    <div><i class="lni lni-bolt-alt me-1 font-22 text-primary"></i></div>
                    <h5 class="mb-0 text-primary">Edit KWh</h5>
                </div>
                <hr>
                <form action="{{ route('kwh.update', $kwh->id) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                        <label for="editKwh" class="form-label">Site ID</label>
                        <select name="site_id" id="editKwh" class="form-control" required>
                            @foreach($sites as $site)
                                <option value="{{ $site->id }}" {{ $kwh->site_id == $site->id ? 'selected' : '' }}>
                                    {{ $site->site_id }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label for="inputIdPelanggan" class="form-label">ID Pelanggan</label>
                        <input type="text" name="id_pelanggan" class="form-control" id="inputIdPelanggan" value="{{ $kwh->id_pelanggan }}" required>
                    </div>
                    <div class="col-md-12">
                        <label for="inputDaya" class="form-label">Daya</label>
                        <input type="text" name="daya" class="form-control" id="inputDaya" value="{{ $kwh->daya }}" required>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                        <a href="{{ route('kwh.index') }}" class="btn btn-secondary px-5">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
