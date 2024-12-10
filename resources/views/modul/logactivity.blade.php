@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{ route('logactivity.export') }}" class="btn btn-outline-secondary btn-md">
                        <i class='bx bx-export mr-1'></i>Export
                    </a>
                </div>
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>User</th>
                                <th>Event</th>
                                <th>Old Data</th>
                                <th>Changes</th>
                                <th>Log At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($activities as $index => $activity)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $activity->causer ? $activity->causer->name : 'System' }}</td>
                                <td>{{ ucfirst($activity->description) }}</td>
                                <td>
                                    <span class="badge rounded-pill bg-warning text-dark" data-bs-toggle="modal" data-bs-target="#oldDataDetail{{ $activity->id }}">Detail</span>
                                    <div class="modal fade" id="oldDataDetail{{ $activity->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Detailed Old Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xl-9 mx-auto">
                                                            @if(isset($activity->properties['old']))
                                                            @foreach($activity->properties['old'] as $attribute => $oldValue)
                                                                <strong>{{ $attribute }}</strong>: {{ $oldValue }}<br>
                                                            @endforeach
                                                        @else
                                                            <em>No old data</em>
                                                        @endif   
                                                        </div>                                                      
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-info text-dark" data-bs-toggle="modal" data-bs-target="#newDataDetail{{ $activity->id }}">Detail</span>
                                    <div class="modal fade" id="newDataDetail{{ $activity->id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title">Detailed New Data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-xl-9 mx-auto">
                                                            @if(isset($activity->properties['attributes']))
                                                            @foreach($activity->properties['attributes'] as $attribute => $newValue)
                                                                <strong>{{ $attribute }}</strong>: {{ $newValue }}<br>
                                                            @endforeach
                                                        @else
                                                            <em>No changes</em>
                                                        @endif  
                                                        </div>                                                      </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $activity->created_at->translatedFormat('j F Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection