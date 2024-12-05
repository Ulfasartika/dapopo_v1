@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ route('genset.create') }}" class="btn btn-primary btn-md">
                        <i class='bx bx-plus mr-1'></i>Add Genset
                    </a>
                </div>
                <br />                
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">  
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Genset Brand</th>
                                <th>Genset Capacity</th>
                                <th>Genset Condition</th>
                                <th>ATS Condition</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($genset as $genset)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $genset->site->site_id }} - {{ $genset->site->site_name }}</td>
                                    <td>{{ $genset->genset_brand}}</td>
                                    <td>{{ $genset->capacity }}</td>
                                    <td>{{ $genset->genset_condition }}</td>
                                    <td>{{ $genset->ats }}</td>  
                                    <td>
                                        <div class="action-buttons">
                                            <form action="{{ route('genset.edit', $genset->id) }}" method="GET" style="display: inline;">
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('genset.destroy', $genset->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">
                                                    <i class="bx bx-trash-alt"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#gensetDetail{{ $genset->id }}">
                                                <i class="fadeIn animated bx bx-show-alt"></i>
                                            </button>
                                        </div>
                                        <div class="modal fade" id="gensetDetail{{ $genset->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Detailed Genset Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xl mx-auto">
                                                            <div class="row mb-3">
                                                                <label class="col-md col-form-label">ATS Photo</label>
                                                                <div class="col-md">
                                                                    <span class="form-control">
                                                                        <img src="{{asset('storage/' . $genset->foto_ats) }}"  alt="ATS Image" class="img-fluid"/>                                                                 
                                                                    </div>
                                                            </div>
                                                            <div class="row mb-3">
                                                                <label class="col-md col-form-label">Genset Photo</label>
                                                                <div class="col-md">
                                                                    <span class="form-control">
                                                                        <img src="{{asset('storage/' . $genset->foto_genset) }}"  alt="Genset Image" class="img-fluid"/>                                                                 
                                                                    </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                <th>Genset Brand</th>
                                <th>Genset Capacity</th>
                                <th>Genset Condition</th>
                                <th>ATS Condition</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
