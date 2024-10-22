@extends('layout.main')
@section('content')
<div class="page-content">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card mt-4">
                        <div class="card-body">
                            <div id="chart1"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="chart2"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="chart3"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="chart4"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="chart5"></div>
                        </div>
                    </div>      
                </div>
            </div>    
</div>
<script>
    var power_distribution = @json($power_distribution);
    var power_percent = @json($power_percent);

    // Setup chart data
    var chartData = [
        { name: '7.7 kVA', y: power_percent['7_7_kva'] },
        { name: '10.5 kVA', y: power_percent['10_5_kva'] },
        { name: '13.2 kVA', y: power_percent['13_2_kva'] },
        { name: '16.5 kVA', y: power_percent['16_5_kva'] },
        { name: '23 kVA', y: power_percent['23_kva'] },
        { name: '33 kVA', y: power_percent['33_kva'] },
        { name: 'More than 33 kVA', y: power_percent['more_than_33_kva'] }
    ];
</script>
@endsection