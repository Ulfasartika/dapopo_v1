@extends('layout.main')
@section('content')
    <div class="page-content">
        @if(session('success'))
        <div class="alert border-0 border-start border-5 border-primary alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if(session('warning'))
    <div class="alert border-0 border-start border-5 border-secondary alert-dismissible fade show">
        {{ session('warning') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    
    @if(session('error'))
        <div class="alert  border-0 border-start border-5 border-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ route('power.create') }}" class="btn btn-primary btn-md">
                        <i class='bx bx-plus mr-1'></i>Submit Data
                    </a>
                    @if (Auth::user()->role !== 'user')
                    <a href="{{ route('rectifiers.export') }}" class="btn btn-outline-secondary btn-md">
                        <i class='bx bx-export mr-1'></i>Export
                    </a>                        
                    @endif
                </div>
                <br />                
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">  
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Daya PLN</th>
                                <th>Genset</th>
                                <th>Rectifier Name</th>
                                <th>APR Quantity</th>
                                <th>Backup Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rectifiers as $rectifier)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($rectifier->site)
                                            {{ $rectifier->site->site_id }} - {{ $rectifier->site->site_name }}
                                        @else
                                            No Site Assigned
                                        @endif
                                    </td>                                    
                                    <td>{{ $rectifier->site->kwh->daya ?? 'N/A' }} kVA</td>
                                    <td>
                                        {{ $rectifier->gensets->isNotEmpty() ? 'Ya' : 'Tidak' }}
                                    </td>
                                    <td>{{ $rectifier->recti_name }}</td>
                                    <td>{{ $rectifier->apr_quantity }}</td>
                                    <td>{{ $rectifier->backup_time }} Hours</td>                                    
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Daya PLN</th>
                                <th>Genset</th>
                                <th>Rectifier Name</th>
                                <th>APR Quantity</th>
                                <th>Backup Time</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
