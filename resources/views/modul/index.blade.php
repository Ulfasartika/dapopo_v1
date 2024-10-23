@extends('layout.main')
@section('content')
<div class="page-content">
            <div class="row">
                <div class="col-xl-9 mx-auto">
                    <div class="card mt-4">
                        <div class="card-body">
                            <div id="chart1" data-chart-data="{{ json_encode($chartData) }}"></div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div id="chart2" data-chart-data="{{ json_encode($chartDataApr) }}"></div>
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

@endsection