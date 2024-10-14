@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Power</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $site)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $site['site_id']-['site_name'] }}</td>
                                    <td><span class="badge rounded-pill bg-info text-dark"></span></td>
                                    <td>{{ $site['created_at'] }}</td>
                                    <td>{{ $site['updated_at'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>No</th>
                                <th>Site ID - Site Name</th>
                                <th>Power</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div> 
    </div>
@endsection