@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card border-top border-0 border-primary">
            <div class="card-body">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bx-user me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">Form Input User</h5>
                    </div>
                    <hr>
                    <form action="{{ route('user.store') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-md-12">
                            <label for="inputArea" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="inputArea" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputArea" class="form-label">Username</label>
                            <input type="text" name="username" class="form-control" id="inputArea" required>
                        </div>
                        <div class="col-md-12">
                            <label for="inputArea" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control" id="inputPassword" required>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="showPassword">
                                <label class="form-check-label" for="showPassword">Show Password</label>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label for="inputArea" class="form-label">Area</label>
                            <select class="form-select single-select" id="selectSite" name="area_id"
                                aria-label="Default select example">
                                <option hidden selected>Select Area</option>
                                @foreach ($areas as $area)
                                    <option value="{{ $area->id }}">
                                        {{ $area->area }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                            <a href="{{ route('user.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.getElementById('showPassword').addEventListener('change', function() {
            const passwordField = document.getElementById('inputPassword');
            passwordField.type = this.checked ? 'text' : 'password';
        });
    </script>
@endsection
