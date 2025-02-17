@extends('layout.main')
@section('content')
    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs nav-primary" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" data-bs-toggle="tab" href="#primaryPln" role="tab" aria-selected="true">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-home font-18 me-1'></i>
                                </div>
                                <div class="tab-title">PLN</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primaryrectifier" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-user-pin font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Rectifier</div>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" data-bs-toggle="tab" href="#primarygenset" role="tab" aria-selected="false">
                            <div class="d-flex align-items-center">
                                <div class="tab-icon"><i class='bx bx-microphone font-18 me-1'></i>
                                </div>
                                <div class="tab-title">Genset</div>
                            </div>
                        </a>
                    </li>
                </ul>
                <div class="tab-content py-3">
                    <div class="tab-pane fade show active" id="primarypln" role="tabpanel">
                        <form action="{{ route('power.storeKwh') }}" id="kwhForm" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="selectSiteKwh" class="form-label">Site ID</label>
                                <select class="single-select" id="selectSiteKwh" name="id_site" required>
                                    <option disabled selected hidden>-- Select Site --</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->site_id }} - {{ $site->site_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="id_pelanggan" class="form-label">ID Pelanggan PLN</label>
                                <input type="text" class="form-control" id="id_pelanggan" name="id_pelanggan" maxlength="14" pattern="\d+" required>
                                <small>Masukkan ID Pelanggan berupa angka dengan maksimal 14 karakter.</small>
                            </div>
                            <div class="mb-3">
                                <label for="daya" class="form-label">Daya PLN (kvA)</label>
                                <input type="number" class="form-control" id="daya" name="daya" step="0.1" min="0" required>
                                <small>Masukkan daya PLN dalam kvA, minimal 0.</small>
                            </div>
                            <div class="mb-3">
                                <label for="kondisiKwh" class="form-label">Kondisi KWh Meter</label>
                                <select name="kondisi_kwh" class="form-select" id="kondisiKwh" required>
                                    <option disabled selected hidden>-- Choose --</option>
                                    <option value="Bagus">Bagus</option>
                                    <option value="Terbakar">Terbakar</option>
                                    <option value="Bypass">Bypass</option>
                                </select>
                                <small>Pilih kondisi KWh Meter: Bagus, Terbakar, atau Bypass.</small>
                            </div>
                            <div class="mb-3">
                                <label for="kondisiSegel" class="form-label">Kondisi Segel</label>
                                <select name="kondisi_segel" class="form-select" id="kondisiSegel" required>
                                    <option disabled selected hidden>-- Choose --</option>
                                    <option value="Bersegel">Bersegel</option>
                                    <option value="Tidak Bersegel">Tidak Bersegel</option>
                                </select>
                                <small>Pilih kondisi segel: Bersegel atau Tidak Bersegel.</small>
                            </div>
                            <div class="mb-3">
                                <label for="arusR" class="form-label">Arus R (A)</label>
                                <input type="number" class="form-control" id="arusR" name="arus_r" min="0" required>
                                <small>Masukkan nilai arus R dalam Ampere, minimal 0.</small>
                            </div>
                            <div class="mb-3">
                                <label for="arusS" class="form-label">Arus S (A)</label>
                                <input type="number" class="form-control" id="arusS" name="arus_s" min="0" required>
                                <small>Masukkan nilai arus S dalam Ampere, minimal 0.</small>
                            </div>
                            <div class="mb-3">
                                <label for="arusT" class="form-label">Arus T (A)</label>
                                <input type="number" class="form-control" id="arusT" name="arus_t" min="0" required>
                                <small>Masukkan nilai arus T dalam Ampere, minimal 0.</small>
                            </div>
                            <div class="mb-3">
                                <label for="phasaR" class="form-label">Phasa R (V)</label>
                                <input type="number" class="form-control" id="phasaR" name="phasa_r" min="160" max="260">
                                <small>Masukkan nilai phasa R dalam Volt antara 160-260 (opsional).</small>
                            </div>
                            <div class="mb-3">
                                <label for="phasaS" class="form-label">Phasa S (V)</label>
                                <input type="number" class="form-control" id="phasaS" name="phasa_s" min="160" max="260">
                                <small>Masukkan nilai phasa S dalam Volt antara 160-260 (opsional).</small>
                            </div>
                            <div class="mb-3">
                                <label for="phasaT" class="form-label">Phasa T (V)</label>
                                <input type="number" class="form-control" id="phasaT" name="phasa_t" min="160" max="260">
                                <small>Masukkan nilai phasa T dalam Volt antara 160-260 (opsional).</small>
                            </div>
                            <div class="mb-3">
                                <label for="fotoKwh" class="form-label">Upload Image</label>
                                <br>
                                <small>Foto tampak depan KWh Meter dengan pintu terbuka. Format file: JPEG atau PNG. Maksimal ukuran file: 10 MB.</small>
                                <input type="file" name="foto_kwh" accept="image/png, image/jpeg" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form> 
                        <div id="alert-message" class="mt-3"></div>                       
                    </div>
                    <div class="tab-pane fade" id="primaryrectifier" role="tabpanel">
                        <form action="{{ route('rectifier.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="selectSiteRecti" class="form-label">Site ID</label>
                                <select class="single-select" id="selectSiteRecti" name="id_site" required>
                                    <option disabled selected hidden>-- Select Site --</option>
                                    @foreach ($sites as $site)
                                        <option value="{{ $site->id }}">{{ $site->site_id }} - {{ $site->site_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recti_name" class="form-label">Rectifier Name</label>
                                <input type="text" class="form-control" name="recti_name">
                                <small class="text-muted">Masukkan nama rectifier (maksimal 255 karakter).</small>
                            </div>
        
                            <!-- Rectifier Brand -->
                            <div class="mb-3">
                                <label for="recti_brand" class="form-label">Rectifier Brand</label>
                                <select name="recti_brand" class="form-select">
                                    <option disabled selected hidden>-- Select Brand --</option>
                                    <option value="Emerson">Emerson</option>
                                    <option value="Hariff">Hariff</option>
                                    <option value="Vertiv">Vertiv</option>
                                </select>
                                <small class="text-muted">Pilih merek rectifier yang tersedia.</small>
                            </div>
        
                            <!-- APR Quantity -->
                            <div class="mb-3">
                                <label for="apr_quantity" class="form-label">APR Quantity</label>
                                <select class="form-select" name="apr_quantity">
                                    <option disabled selected hidden>-- Select Qty --</option>
                                    @for ($i = 0; $i <= 9; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                                <small class="text-muted">Pilih jumlah APR (minimal 0).</small>
                            </div>
        
                            <!-- Bus Voltage -->
                            <div class="mb-3">
                                <label for="bus_voltage" class="form-label">Bus Voltage (V)</label>
                                <input type="number" class="form-control" name="bus_voltage" step="0.1">
                                <small class="text-muted">Masukkan nilai tegangan bus antara 40 hingga 60 V.</small>
                            </div>
        
                            <!-- Load -->
                            <div class="mb-3">
                                <label for="load" class="form-label">Load (A)</label>
                                <input type="number" class="form-control" name="load" step="0.1">
                                <small class="text-muted">Masukkan beban (load) antara 0 hingga 200 A.</small>
                            </div>
        
                            <!-- Battery Brand -->
                            <div class="mb-3">
                                <label for="battery_brand" class="form-label">Battery Brand</label>
                                <select name="battery_brand" class="form-select">
                                    <option disabled selected hidden>-- Choose --</option>
                                    @foreach ($batterybrand as $battery_brand)
                                        <option value="{{ $battery_brand->id }}">{{ $battery_brand->battery_brand }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Pilih merek baterai yang tersedia.</small>
                            </div>
        
                            <!-- Battery Type -->
                            <div class="mb-3">
                                <label for="battery_type" class="form-label">Battery Type</label>
                                <select name="battery_type" class="form-select">
                                    <option disabled selected hidden>-- Choose --</option>
                                    @foreach ($batterytype as $battery_type)
                                        <option value="{{ $battery_type['battery_type'] }}">{{ $battery_type['battery_type'] }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Pilih tipe baterai yang sesuai.</small>
                            </div>
        
                            <!-- Total Battery -->
                            <div class="mb-3">
                                <label for="total_battery" class="form-label">Total Battery</label>
                                <input type="number" class="form-control" name="total_battery">
                                <small class="text-muted">Masukkan total baterai (minimal 0).</small>
                            </div>
                            
                            <div class="mb-3">
                            <label for="good_battery" class="form-label">
                                Good Battery (<span id="battery-unit-${i}">Unit</span>)
                            </label>
                            <input type="number" class="form-control" name="good_battery">
                            <small class="text-muted">Masukkan jumlah baterai dalam kondisi Good (Bagus)(minimal 0).</small>
                            </div>
                            <div class="mb-3">
                                <label for="degraded_battery" class="form-label">
                                    Degraded Battery (<span id="battery-unit-${i}">Unit</span>)
                                </label>
                                <input type="number" class="form-control" name="degraded_battery">
                                <small class="text-muted">Masukkan jumlah baterai dalam kondisi Degraded (Rusak)(minimal 0).</small>
                            </div>
                            <div class="mb-3">
                                <label for="stolen_battery" class="form-label">
                                    Stolen Battery (<span id="battery-unit-${i}">Unit</span>)
                                </label>
                                <input type="number" class="form-control" name="stolen_battery">
                                <small class="text-muted">Masukkan jumlah baterai yang hilang(minimal 0).</small>
                            </div>
        
                            <!-- Backup Time -->
                            <div class="mb-3">
                                <label for="backup_time" class="form-label">Backup Time (Hour)</label>
                                <input type="number" class="form-control" name="backup_time">
                                <small class="text-muted">Masukkan waktu backup dalam jam (antara 0 hingga 8 jam).</small>
                            </div>
        
                            <!-- Equipment -->
                            <div class="mb-3">
                                <label for="id_equipment" class="form-label">Equipment</label>
                                <select class="multiple-select" name="id_equipment[]" multiple>
                                    @foreach ($equipments as $equip)
                                        <option value="{{ $equip->id }}">{{ $equip->equipment_name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-muted">Pilih peralatan yang terhubung dengan rectifier ini.</small>
                            </div>
        
                            <!-- Upload Image -->
                            <div class="mb-3">
                                <label for="image" class="form-label">Upload Image</label>
                                <br>
                                <small>Foto tampak depan rectifier dengan pintu terbuka. Format gambar harus JPEG/PNG dan ukuran maksimal 10 MB.</small>
                                <input type="file" name="image" accept="image/png, image/jpeg" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                        <div class="alert alert-success" id="successMessage" style="display:none;"></div>
                        <div class="alert alert-danger" id="errorMessage" style="display:none;"></div>
                    
                    <div class="tab-pane fade" id="primarygenset" role="tabpanel">
                        <form action="{{ route('genset.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="selectSiteGenset" class="form-label">Site ID</label>
                            <select class="single-select" id="selectSiteGenset" name="id_site" required>
                                <option disabled selected hidden>-- Select Site --</option>
                                @foreach ($sites as $site)
                                    <option value="{{ $site->id }}">{{ $site->site_id }} - {{ $site->site_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="gensets[${i}][genset_name]" class="form-label">Genset Name</label>
                            <input type="text" class="form-control" name="gensets[${i}][genset_name]" required>
                            <small class="form-text text-muted">
                                Harus diisi, berupa teks, maksimal 255 karakter.
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="gensets[${i}][genset_brand]" class="form-label">Brand</label>
                            <input type="text" class="form-control" name="gensets[${i}][genset_brand]" required>
                            <small class="form-text text-muted">
                                Harus diisi, berupa teks, maksimal 255 karakter.
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="gensets[${i}][capacity]" class="form-label">Capacity (kVA)</label>
                            <select class="single-select" name="gensets[${i}][capacity]" required>
                                <option disabled selected hidden>-- Select Capacity --</option>
                                <option value="20" data-numeric="20">20</option>
                                <option value="22" data-numeric="22">22</option>
                                <option value="22.5" data-numeric="22.5">22.5</option>
                                <option value="30" data-numeric="30">30</option>
                                <option value="40" data-numeric="40">40</option>
                                <option value="50" data-numeric="50">50</option>
                                <option value="60" data-numeric="60">60</option>
                                <option value="80" data-numeric="80">80</option>
                            </select>
                            <small class="form-text text-muted">
                                Harus diisi, pilih kapasitas genset yang tersedia.
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="gensets[${i}][genset_condition]" class="form-label">Genset Condition</label>
                            <select class="form-select" name="gensets[${i}][genset_condition]" required>
                                <option disabled selected hidden>-- Select Condition --</option>
                                <option value="Bagus">Bagus</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                            <small class="form-text text-muted">
                                Harus diisi, pilih salah satu: "Bagus" atau "Rusak".
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="gensets[${i}][ats]" class="form-label">ATS</label>
                            <select class="form-select" name="gensets[${i}][ats]" required>
                                <option disabled selected hidden>-- Select Condition --</option>
                                <option value="Bagus">Bagus</option>
                                <option value="Rusak">Rusak</option>
                            </select>
                            <small class="form-text text-muted">
                                Harus diisi, pilih salah satu: "Bagus" atau "Rusak".
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="gensets[${i}][photo_genset]" class="form-label">Genset Photo</label>
                            <input type="file" class="form-control" name="gensets[${i}][photo_genset]" accept="image/*" required>
                            <small class="form-text text-muted">
                                Harus diisi, berupa file gambar dengan format jpeg, png, atau jpg, maksimal ukuran 10MB.
                            </small>
                        </div>
                        <div class="mb-3">
                            <label for="gensets[${i}][photo_ats]" class="form-label">ATS Photo</label>
                            <input type="file" class="form-control" name="gensets[${i}][photo_ats]" accept="image/*" required>
                            <small class="form-text text-muted">
                                Harus diisi, berupa file gambar dengan format jpeg, png, atau jpg, maksimal ukuran 10MB.
                            </small>
                        </div>
                        <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#kwhForm').on('submit', function(e) {
            e.preventDefault(); // Mencegah reload halaman

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#alert-message').html(`
                        <div class="alert alert-success">Data saved successfully.</div>
                    `);
                },
                error: function(xhr) {
                    let errors = xhr.responseJSON.errors;
                    let errorHtml = '<div class="alert alert-danger"><ul>';
                    $.each(errors, function(key, value) {
                        errorHtml += '<li>' + value[0] + '</li>';
                    });
                    errorHtml += '</ul></div>';
                    $('#alert-message').html(errorHtml);
                }
            });
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const batteryTypeSelect = document.getElementById("battery_type");
        const batteryUnitSpans = document.querySelectorAll("#battery-unit");

        function updateBatteryUnit() {
            const selectedValue = batteryTypeSelect.value;
            let unitText = "Unit"; // Default

            if (selectedValue === "Lithium") {
                unitText = "Pack";
            } else if (selectedValue === "VRLA" || selectedValue === "Floating") {
                unitText = "Unit";
            }

            // Update semua elemen dengan id "battery-unit"
            batteryUnitSpans.forEach(span => span.textContent = unitText);
        }

        // Jalankan update pertama kali saat halaman dimuat
        updateBatteryUnit();

        // Jalankan setiap kali pilihan battery type berubah
        batteryTypeSelect.addEventListener("change", updateBatteryUnit);
    });
</script>
<script>
    $(document).ready(function () {
        $('#rectifierForm').on('submit', function (e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: "{{ route('rectifier.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    $('#successMessage').text(response.message).show();
                    $('#rectifierForm')[0].reset(); // Kosongkan form setelah submit
                    loadRectifiers(response.rectifiers); // Perbarui daftar rectifier
                },
                error: function (xhr) {
                    let errors = xhr.responseJSON.error;
                    let errorMessage = '';
                    $.each(errors, function (key, value) {
                        errorMessage += value + "<br>";
                    });
                    $('#errorMessage').html(errorMessage).show();
                }
            });
        });

        function loadRectifiers(rectifiers) {
            let html = '';
            rectifiers.forEach(function (rectifier) {
                html += `<tr>
                            <td>${rectifier.recti_name}</td>
                            <td>${rectifier.recti_brand}</td>
                            <td>${rectifier.bus_voltage}</td>
                            <td>${rectifier.load}</td>
                            <td><img src="/storage/${rectifier.image}" width="50"></td>
                         </tr>`;
            });
            $('#rectifierList').html(html);
        }
    });
</script>


@endsection