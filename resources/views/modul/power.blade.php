@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="col">
                    <a href="{{ route('rectifier.create') }}" class="btn btn-primary btn-md"><i class='bx bx-plus mr-1'></i>Submit Data</a>
                </div>    
                <br/>        
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Customer ID</th>
                                <th>Power (Daya)</th>
                                <th>Rectifier Name</th>
                                <th>Rectifier Brand</th>
                                <th>APR Quantity</th>
                                <th>Bus Voltage</th>
                                <th>Load</th>
                                <th>Battery Brand</th>
                                <th>Battery Type</th>
                                <th>Battery Quantity</th>
                                <th>Battery Status</th>
                                <th>Backup Time</th>
                                <th>Equipment Connected</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rectifiers as $recti)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @foreach ($recti->sites as $site) 
                                        {{ $site->id }} - {{ $site->name }} @if (!$loop->last), @endif
                                        @endforeach                                    
                                    </td>                               
                                    <td>{{ $recti['id_pelanggan'] }}</td>
                                    <td>{{ $recti['daya'] }}</td>
                                    <td>{{ $recti['recti_name'] }}</td>
                                    <td>{{ $recti['recti_brand'] }}</td>
                                    <td>{{ $recti['apr_quantity'] }}</td>
                                    <td>{{ $recti['bus_voltage'] }}</td>
                                    <td>{{ $recti['load'] }}</td>
                                    <td>{{ $recti['battery_brand'] }}</td>
                                    <td>{{ $recti['battery_type'] }}</td>
                                    <td>{{ $recti['battery_quantity'] }}</td>
                                    <td>{{ $recti['battery_status'] }}</td>
                                    <td>{{ $recti['backup_time'] }}</td>
                                    <td>{{ $recti['id_equipment'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Customer ID</th>
                                <th>Power (Daya)</th>
                                <th>Rectifier Name</th>
                                <th>Rectifier Brand</th>
                                <th>APR Quantity</th>
                                <th>Bus Voltage</th>
                                <th>Load</th>
                                <th>Battery Brand</th>
                                <th>Battery Type</th>
                                <th>Battery Quantity</th>
                                <th>Battery Status</th>
                                <th>Backup Time</th>
                                <th>Equipment Connected</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div> 
    </div>
@endsection