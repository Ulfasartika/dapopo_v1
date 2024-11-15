<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--favicon-->
    <link rel="icon" href="{{ asset('assets/images/favicon-32x32.png') }}" type="image/png" />
    <!-- jQuery -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <!--plugins-->
    <link href="{{ asset('assets/plugins/notifications/css/lobibox.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/metismenu/css/metisMenu.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/smart-wizard/css/smart_wizard_all.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/select2/css/select2-bootstrap4.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/highcharts/css/highcharts.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet" />

    <!-- loader-->
    <link href="{{ asset('assets/css/pace.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/js/pace.min.js') }}"></script>

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
    <!-- Theme Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dark-theme.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/semi-dark.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/header-colors.css') }}" />
    <title>Data Potensi Power - NOP Dumai</title>
</head>

<body>
    <div class="wrapper">
        @include('component.sidebar')
        @include('component.header')

        <div class="page-wrapper">
            @yield('content')
        </div>

        @include('component.footer')
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

    <!-- plugins -->
    <script src="{{ asset('assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('assets/plugins/metismenu/js/metisMenu.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/plugins/smart-wizard/js/jquery.smartWizard.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>

    <!-- Custom Script for Select2, DataTables, Step Form -->
    <script>
        function initializeComponents() {
            // Feather Icons
            feather.replace();

            // Select2 initialization
            $('.multiple-select').select2({
                theme: 'bootstrap4',
                width: '100%',
                placeholder: 'Select an option',
                allowClear: true,
            });

            // DataTables initialization
            $('#example').DataTable();
            var table = $('#example2').DataTable({
                lengthChange: false,
            });


            // Step form initialization
            const steps = document.querySelectorAll('.form-step');
            const nextBtns = document.querySelectorAll('.next-step');
            const prevBtns = document.querySelectorAll('.prev-step');
            let currentStep = 0;

            nextBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    steps[currentStep].classList.add('d-none');
                    currentStep++;
                    steps[currentStep].classList.remove('d-none');
                });
            });

            prevBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    steps[currentStep].classList.add('d-none');
                    currentStep--;
                    steps[currentStep].classList.remove('d-none');
                });
            });
        }

        // Run on initial load
        document.addEventListener('DOMContentLoaded', initializeComponents);

        document.addEventListener("livewire:load", function () {
            initializeComponents();

            Livewire.hook('message.processed', () => {
                initializeComponents();
            });
        });
        
        document.addEventListener("DOMContentLoaded", function () {
        // Fungsi untuk mengatur recti_name secara otomatis
        document.getElementById('selectSite').addEventListener('change', function() {
            const siteId = this.value;
            if (siteId) {
                fetch(`/api/site/${siteId}/rectifiers-count`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('recti_name').value = `Rectifier ${data.count + 1}`;
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                document.getElementById('recti_name').value = '';
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Fungsi untuk menambah field baterai secara dinamis
        document.getElementById('button-addon2').addEventListener('click', function() {
            const batterySection = document.getElementById('battery-section');
            const newField = document.createElement('div');
            newField.classList.add('input-group', 'mb-3', 'battery-fields');
            newField.innerHTML = `
                <select class="form-select" name="battery_quantity[]" required>
                    <option selected>Choose...</option>
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
                <select class="form-select" name="battery_status[]" required>
                    <option selected hidden>Battery Status</option>
                    <option value="Good">Good</option>
                    <option value="Degraded">Degraded</option>
                    <option value="Stolen">Stolen</option>
                </select>
                <button type="button" class="btn btn-outline-danger remove-battery">Remove Battery</button>
            `;
            batterySection.appendChild(newField);

            // Event listener untuk menghapus field baterai
            newField.querySelector('.remove-battery').addEventListener('click', function() {
                newField.remove();
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function () {
        // Fungsi untuk menampilkan preview gambar
        document.getElementById('gambarRectiInput').addEventListener('change', function() {
            var fileInput = this.files[0];
            var preview = document.getElementById('gambarRectiPreview');
            var previewContainer = preview.parentElement;

            if (fileInput) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    previewContainer.removeAttribute('hidden');
                };

                reader.readAsDataURL(fileInput);
            }
        });
    });
    </script>
</body>
</html>
