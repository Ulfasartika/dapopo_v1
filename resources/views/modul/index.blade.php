@extends('layout.main')
@section('content')
<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
    <div class="breadcrumb-title pe-3">Dashboard</div>
    <div class="ps-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0 p-0">
                <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-circle"></i></a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Data Potensi Power</li>
            </ol>
        </nav>
    </div>
</div>
<!--end breadcrumb-->
<div class="row">
    <div class="col-xl-9 mx-auto">
        <div class="card">
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
@endsection