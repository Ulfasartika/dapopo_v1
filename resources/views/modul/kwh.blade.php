@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ route('kwh.create') }}" class="btn btn-primary btn-md">
                        <i class='bx bx-plus mr-1'></i>Add KWh Meter
                    </a>
                </div>
                <br />                
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">  
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Site ID-Site Name</th>
                                <th>ID Pelanggan PLN</th>
                                <th>Daya (kVA)</th>
                                <th>Kondisi KWh Meter</th>
                                <th>Arus (A) PLN</th>
                                <th>Phasa 1</th>
                                <th>Phasa 2</th>
                                <th>Phasa 3</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kwh as $kwh)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $kwh->site->site_id }} - {{ $kwh->site->site_name }}</td>
                                    <td>{{ $kwh->id_pelanggan}}</td>
                                    <td>{{ $kwh->daya }}</td>
                                    <td>{{ $kwh->kondisi_kwh }}</td>
                                    <td>{{ $kwh->arus_pln }}</td> 
                                    <td>{{ $kwh->phasa_1 }}</td>  
                                    <td>{{ $kwh->phasa_2 }}</td>  
                                    <td>{{ $kwh->phasa_3 }}</td>  
                                    <td>
                                        <div class="action-buttons">
                                            <form action="{{ route('kwh.edit', $kwh->id) }}" method="GET" style="display: inline;">
                                                <button type="submit" class="btn btn-warning btn-sm">
                                                    <i class="bx bx-edit"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('kwh.destroy', $kwh->id) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this data?')">
                                                    <i class="bx bx-trash-alt"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kwhDetail{{ $kwh->id }}">
                                                <i class="fadeIn animated bx bx-show-alt"></i>
                                            </button>
                                        </div>
                                        <div class="modal fade" id="kwhDetail{{ $kwh->id }}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Image KWh Meter</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xl mx-auto">
                                                            <div class="row mb-3">
                                                                <label class="col-md col-form-label">KWh Meter Photo</label>
                                                                <div class="col-md">
                                                                    <span class="form-control">
                                                                        <img src="{{asset('storage/' . $kwh->foto_kwh) }}"  alt="KWh Meter Image" class="img-fluid"/>                                                                 
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
                                <th>Site ID-Site Name</th>
                                <th>ID Pelanggan PLN</th>
                                <th>Daya (kVA)</th>
                                <th>Kondisi KWh Meter</th>
                                <th>Arus (A) PLN</th>
                                <th>Phasa 1</th>
                                <th>Phasa 2</th>
                                <th>Phasa 3</th>
                                <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
