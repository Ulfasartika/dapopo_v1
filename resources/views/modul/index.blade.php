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
    var power_distribution =$power_distribution;
    var power_percent = $power_percent;
    var apr_distribution =$apr_distribution;
    var apr_percent =$apr_percent;
    
    var chartData = [
        { name: '7.7 kVA', y: power_percent['7_7_kva'] },
        { name: '10.5 kVA', y: power_percent['10_5_kva'] },
        { name: '13.2 kVA', y: power_percent['13_2_kva'] },
        { name: '16.5 kVA', y: power_percent['16_5_kva'] },
        { name: '23 kVA', y: power_percent['23_kva'] },
        { name: '33 kVA', y: power_percent['33_kva'] },
        { name: 'More than 33 kVA', y: power_percent['more_than_33_kva'] }
    ];
    var chartDataApr = [
        { name: '1 Mod APR', y: apr_percent['1_mod_apr']},
        { name: '2 Mod APR', y: apr_percent['2_mod_apr']},
        { name: '3 Mod APR', y: apr_percent['3_mod_apr']},
        { name: '4 Mod APR', y: apr_percent['4_mod_apr']},
        { name: '5 Mod APR', y: apr_percent['5_mod_apr']},
        { name: '6 Mod APR', y: apr_percent['6_mod_apr']},
        { name: 'More Than 6 Mod APR', y: apr_percent['more_than_6_mod_apr']}
    ];
</script>
@endsection