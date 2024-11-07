@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5>Log Activity</h5>
                </div>
                <div class="table-responsive">
                    <table id="example" class="table table-striped table-bordered">
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
                                    @if(isset($activity->properties['old']))
                                        @foreach($activity->properties['old'] as $attribute => $oldValue)
                                            <strong>{{ $attribute }}</strong>: {{ $oldValue }}<br>
                                        @endforeach
                                    @else
                                        <em>No old data</em>
                                    @endif
                                </td>
                                <td>
                                    @if(isset($activity->properties['attributes']))
                                        @foreach($activity->properties['attributes'] as $attribute => $newValue)
                                            <strong>{{ $attribute }}</strong>: {{ $newValue }}<br>
                                        @endforeach
                                    @else
                                        <em>No changes</em>
                                    @endif
                                </td>
                                <td>{{ $activity->created_at->translatedFormat('j F Y H:i') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $activities->links() }}
            </div>
        </div>
    </div>
@endsection