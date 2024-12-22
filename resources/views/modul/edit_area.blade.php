@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card border-top border-0 border-primary">
            <div class="card-body">
                <div class="card-body p-5">
                    <div class="card-title d-flex align-items-center">
                        <div><i class="bx bx-station me-1 font-22 text-primary"></i></div>
                        <h5 class="mb-0 text-primary">Form Edit Area</h5>
                    </div>
                    <hr>
                    <form action="{{ route('area.update', $area->id) }}" method="POST" class="row g-3">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12">
                            <label for="inputArea" class="form-label">Kabupaten</label>
                            <input type="text" name="area" class="form-control" id="inputArea"
                                value="{{ old('area', $area->area) }}" oninput="this.value = this.value.toUpperCase();" >
                        </div>
                        @error('area')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-md-12">
                            <label for="selectUsers" class="form-label">Users</label>
                            <select name="user_ids[]" class="multiple-select" id="selectUsers" multiple>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}" 
                                        {{ in_array($user->id, $area->users->pluck('id')->toArray()) ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        @error('user_ids[]')
                            <div class="mt-2 text-danger">{{ $message }}</div>
                        @enderror

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-sm">Save</button>
                            <a href="{{ route('area.index') }}" class="btn btn-secondary btn-sm">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
