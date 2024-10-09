@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="row">
            <div class="col-xl-12 mx-auto">
                <div class="card">
                    <div class="card-body">
                        <br />
                        <!-- SmartWizard html -->
                        <div id="smartwizard">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-1"> <strong>Step 1</strong>
                                        <br>Pilih Site</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-2"> <strong>Step 2</strong>
                                        <br>Submit Data KWh Electric</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#step-3"> <strong>Step 3</strong>
                                        <br>Submit Data Rectifier</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div id="step-1" class="tab-pane" role="tabpanel" aria-labelledby="step-1">
                                    <div class="card">
                                        <div class="card-body p-5">
                                            <form class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="inputFirstName" class="form-label">Site ID</label>
                                                    <select name="" id="" class="form-control">
                                                        <option value="">--</option>
                                                        <option value="">Site 1-Purnama</option>
                                                        <option value="">Dum 1-Sudirman</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="inputEmail" class="form-label">Alamat</label>
                                                    <input type="text" class="form-control" id="inputEmail" disabled>
                                                </div>
                                                <!-- button-->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-2" class="tab-pane" role="tabpanel" aria-labelledby="step-2">
                                    <div class="card">
                                        <div class="card-body p-5">
                                            <form action="" class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="inputPassword" class="form-label">ID Pelanggan</label>
                                                    <input type="text" class="form-control" id="inputEmail">
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="inputAddress" class="form-label">Daya PLN</label>
                                                    <select class="form-control">
                                                        <option value="">--</option>
                                                        <option value="">7.7 kVA</option>
                                                        <option value="">10.5 kVA</option>
                                                        <option value="">13.2 kVA</option>
                                                        <option value="">16.5 kVA</option>
                                                        <option value="">23 kVA</option>
                                                        <option value="">33 kVA</option>
                                                        <option value="">>33 kVA</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="inputAddress" class="form-label">Load</label>
                                                    <select name="" id="" class="form-control">
                                                        <option value=""></option>
                                                        <option value=""></option>
                                                        <option value=""></option>
                                                        <option value=""></option>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div id="step-3" class="tab-pane" role="tabpanel" aria-labelledby="step-3">
                                    <div class="card">
                                        <div class="card-body pg-5">
                                            <form action="" class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="addrecti" class="form-label">Rectifier</label>
                                                    <i class="text-primary" id="addrecti" data-feather="plus-circle" style="cursor: pointer;"></i>
                                                    <input type="text" class="form-control" id="rectifierInput" placeholder="Rectifier 1" disabled>
                                                </div>
                                                <div class="col-12">
                                                    <label for="inputAddress2" class="form-label">Merk Rectifier</label>
                                                    <select class="form-control">
                                                        <option value="">--</option>
                                                        <option value="">Emerson</option>
                                                        <option value="">Hariff</option>
                                                        <option value="">Vertiv</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="inputAddress2" class="form-label">Jenis Baterai</label>
                                                    <select class="form-control">
                                                        <option value="United States">--</option>
                                                        <option value="United States">Lithium</option>
                                                        <option value="United Kingdom">VRLA</option>
                                                    </select>
                                                </div>
                                                <!--tes-->
                                                <div class="input-group mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="addBattery">Jumlah Baterai </label>
                                                        <i type="button" class="text-primary" id="addBattery" data-feather="plus-circle" style="cursor: pointer;"></i>
                                                    </div>
                                                    <div class="col-8">
                                                        <select class="form-control" id="batteryInput">
                                                            <option value="">--</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value=">6">>6</option>
                                                        </select>
                                                    </div>
                                                    <select class="form-select" id="inputGroupSelect01">
                                                        <option selected>Kondisi Baterai</option>
                                                        <option value="1">Good</option>
                                                        <option value="2">Degraded</option>
                                                    </select>
                                                </div>
                                                <div id="additionalBattery"></div> <!-- Tempat untuk input baterai tambahan -->

                                                <div class="col-md-12">
                                                    <label class="form-label">Jumlah Module APR</label>
                                                    <select class="form-control">
                                                        <option value="">--</option>
                                                        <option value="">1</option>
                                                        <option value="">2</option>
                                                        <option value="">3</option>
                                                        <option value="">4</option>
                                                        <option value="">5</option>
                                                        <option value="">6</option>
                                                        <option value="">7</option>
                                                        <option value="">8</option>
                                                        <option value="">9</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="basic-addon2" class="form-label">Bus Voltage</label>
                                                    <div class="input-group input-group mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">Volt</span>
                                                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="basic-addon2" class="form-label">Load</label>
                                                    <div class="input-group input-group mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">Ampere</span>
                                                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Battery Backup Time</label>
                                                    <select class="form-control">
                                                        <option value="">--</option>
                                                        <option value="">0 Jam</option>
                                                        <option value="">1 Jam</option>
                                                        <option value="">2 Jam</option>
                                                        <option value="">3 Jam</option>
                                                        <option value="">4 Jam</option>
                                                        <option value="">5 Jam</option>
                                                        <option value="">6 Jam</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Equipment Connected</label>
                                                    <select class="multiple-select" multiple="multiple">
                                                        <option value="" selected>Baseband</option>
                                                        <option value="" selected>RRU</option>
                                                        <option value="" selected>Minilink TN</option>
                                                        <option value="">GPON</option>
                                                        <option value="">NEC</option>
                                                        <option value="">BSC</option>
                                                        <option value="">Router</option>
                                                        <option value="">OLT</option>
                                                    </select>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="additionalRectifiers"></div> <!-- Tempat untuk input baru -->
                </div>
            </div>
        </div> <!-- end page-wrapper -->
        <!--start overlay-->
        <div class="overlay toggle-icon"></div>
        <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:;" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
        <!--End Back To Top Button-->

    </div>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/input-tags/js/tagsinput.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="assets/plugins/smart-wizard/js/jquery.smartWizard.min.js"></script>
    <script src="assets/plugins/select2/js/select2.min.js"></script>


    <script>
        $(document).ready(function() {
            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Submit').addClass('btn btn-info').on('click', function() {
                alert('Finish Clicked');
            });
            var btnCancel = $('<button></button>').text('Cancel').addClass('btn btn-danger').on('click', function() {
                $('#smartwizard').smartWizard("reset");
            });
            // Step show event
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
                $("#prev-btn").removeClass('disabled');
                $("#next-btn").removeClass('disabled');
                if (stepPosition === 'first') {
                    $("#prev-btn").addClass('disabled');
                } else if (stepPosition === 'last') {
                    $("#next-btn").addClass('disabled');
                } else {
                    $("#prev-btn").removeClass('disabled');
                    $("#next-btn").removeClass('disabled');
                }
            });
            // Smart Wizard
            $('#smartwizard').smartWizard({
                selected: 0,
                theme: 'dots',
                transition: {
                    animation: 'slide-horizontal', // Effect on navigation, none/fade/slide-horizontal/slide-vertical/slide-swing
                },
                toolbarSettings: {
                    toolbarPosition: 'both', // both bottom
                    toolbarExtraButtons: [btnFinish, btnCancel]
                }
            });
            // External Button Events
            $("#reset-btn").on("click", function() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                return true;
            });
            $("#prev-btn").on("click", function() {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });
            $("#next-btn").on("click", function() {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });
            // Demo Button Events
            $("#got_to_step").on("change", function() {
                // Go to step
                var step_index = $(this).val() - 1;
                $('#smartwizard').smartWizard("goToStep", step_index);
                return true;
            });
            $("#is_justified").on("click", function() {
                // Change Justify
                var options = {
                    justified: $(this).prop("checked")
                };
                $('#smartwizard').smartWizard("setOptions", options);
                return true;
            });
            $("#animation").on("change", function() {
                // Change theme
                var options = {
                    transition: {
                        animation: $(this).val()
                    },
                };
                $('#smartwizard').smartWizard("setOptions", options);
                return true;
            });
            $("#theme_selector").on("change", function() {
                // Change theme
                var options = {
                    theme: $(this).val()
                };
                $('#smartwizard').smartWizard("setOptions", options);
                return true;
            });
        });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
    <script>
        $('.single-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#addBattery').click(function() {
                // Buat input baru dengan placeholder yang sesuai
                var newInput = `
                            <div class="input-group mb-3">
                                <div class="col-8">
                                    <select class="form-control" id="batteryInput">
                                        <option value="">--</option>
                                        <option value="">1</option>
                                        <option value="">2</option>
                                        <option value="">3</option>
                                        <option value="">4</option>
                                        <option value="">5</option>
                                        <option value="">6</option>
                                        <option value="">>6</option>
                                    </select>
                                </div>
                                <select class="form-select" id="inputGroupSelect01">
                                    <option selected>Kondisi Baterai</option>
                                    <option value="1">Good</option>
                                    <option value="2">Degraded</option>
                                </select>
                                <i class="text-primary removeBattery" data-feather="minus-circle" style="cursor: pointer;"></i>
                            </div>
    `;
                // Tambahkan input baru ke div tambahan
                $('#additionalBattery').append(newInput);
                feather.replace(); // Ganti ikon baru
            });

            // Event delegation untuk menghapus input
            $('#additionalBattery').on('click', '.removeBattery', function() {
                $(this).closest('.input-group').remove(); // Hapus input yang sesuai
            });
        });
    </script>

    <script>
       $(document).ready(function() {
            // $('.multiple-select').select2({
            //     placeholder: "Select Equipment",
            //     allowClear: true
            // });
            let rectifierCount = 1; // Mulai dari 1 karena ada input awal

            $('#addrecti').click(function() {
                rectifierCount++; // Increment count
                // Buat input baru dengan placeholder yang sesuai
                var newInput = `
                                    <div class="card">
                                        <div class="card-body pg-5">
                                            <form action="" class="row g-3">
                                                <div class="col-md-12">
                                                    <label for="addrecti" class="form-label">Rectifier</label>
                                                    <i class="text-primary removeRectifier" id="removeRectifier" data-feather="minus-circle" style="cursor: pointer;"></i>
                                                    <input type="text" class="form-control rectifierInput" id="rectifierInput${rectifierCount}" placeholder="Rectifier ${rectifierCount}" disabled>
                                                </div>

                                                <div class="col-12">
                                                    <label for="inputAddress2" class="form-label">Merk Rectifier</label>
                                                    <select class="form-control">
                                                        <option value="">--</option>
                                                        <option value="">Emerson</option>
                                                        <option value="">Hariff</option>
                                                        <option value="">Vertiv</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="inputAddress2" class="form-label">Jenis Baterai</label>
                                                    <select class="form-control">
                                                        <option value="United States">--</option>
                                                        <option value="United States">Lithium</option>
                                                        <option value="United Kingdom">VRLA</option>
                                                    </select>
                                                </div>
                                                <!--tes-->
                                                <div class="input-group mb-3">
                                                    <div class="col-md-12">
                                                        <label class="form-label" for="addBattery">Jumlah Baterai </label>
                                                        <i type="button" class="text-primary" id="addBattery" data-feather="plus-circle" style="cursor: pointer;"></i>
                                                    </div>
                                                    <div class="col-8">
                                                        <select class="form-control" id="batteryInput">
                                                            <option value="">--</option>
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="5">5</option>
                                                            <option value="6">6</option>
                                                            <option value=">6">>6</option>
                                                        </select>
                                                    </div>
                                                    <select class="form-select" id="inputGroupSelect01">
                                                        <option selected>Kondisi Baterai</option>
                                                        <option value="1">Good</option>
                                                        <option value="2">Degraded</option>
                                                    </select>
                                                </div>
                                                <div id="additionalBattery"></div> <!-- Tempat untuk input baterai tambahan -->


                                                <div class="col-md-12">
                                                    <label class="form-label">Jumlah Module APR</label>
                                                    <select class="form-control">
                                                        <option value="">--</option>
                                                        <option value="">1</option>
                                                        <option value="">2</option>
                                                        <option value="">3</option>
                                                        <option value="">4</option>
                                                        <option value="">5</option>
                                                        <option value="">6</option>
                                                        <option value="">7</option>
                                                        <option value="">8</option>
                                                        <option value="">9</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="basic-addon2" class="form-label">Bus Voltage</label>
                                                    <div class="input-group input-group mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">Volt</span>
                                                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label for="basic-addon2" class="form-label">Load</label>
                                                    <div class="input-group input-group mb-3"> <span class="input-group-text" id="inputGroup-sizing-sm">Ampere</span>
                                                        <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Battery Backup Time</label>
                                                    <select class="form-control">
                                                        <option value="">--</option>
                                                        <option value="">0 Jam</option>
                                                        <option value="">1 Jam</option>
                                                        <option value="">2 Jam</option>
                                                        <option value="">3 Jam</option>
                                                        <option value="">4 Jam</option>
                                                        <option value="">5 Jam</option>
                                                        <option value="">6 Jam</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-12">
                                                    <label class="form-label">Equipment Connected</label>
                                                    <select class="form-control multiple-select" multiple="multiple">
                                                        <option value="Baseband" selected>Baseband</option>
                                                        <option value="RRU" selected>RRU</option>
                                                        <option value="Minilink TN" selected>Minilink TN</option>
                                                        <option value="GPON">GPON</option>
                                                        <option value="NEC">NEC</option>
                                                        <option value="BSC">BSC</option>
                                                        <option value="Router">Router</option>
                                                        <option value="OLT">OLT</option>
                                                    </select>
                                                </div>
                                            </form>
                                            </div>
                                            </div>
    `;
                // Tambahkan input baru ke div tambahan
                $('#additionalRectifiers').append(newInput);
                feather.replace(); // Ganti ikon baru
                // $('.multiple-select').select2({
                //     placeholder: "Select Equipment",
                //     allowClear: true
                // });
            });

            // Event delegation untuk menghapus input
            $('#additionalRectifiers').on('click', '.removeRectifier', function() {
                $(this).closest('.card').remove(); // Hapus input yang sesuai
                rectifierCount--; // Decrement count jika dihapus
            });
        });
    </script>
    <script>
        feather.replace()
    </script>
    </div>
@endsection
