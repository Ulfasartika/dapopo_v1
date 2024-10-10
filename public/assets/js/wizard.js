$(document).ready(function () {
    let rectifierCount = 1;

    function addBatteryInput() {
        var newInput = `
            <div class="input-group mb-3">
                <div class="col-8">
                    <select class="form-control" name="batteryInput[]">
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
                <select class="form-select" name="batteryStatus[]">
                    <option selected>Battery Status</option>
                    <option value="1">Good</option>
                    <option value="2">Degraded</option>
                </select>
                <i class="text-primary removeBattery" data-feather="minus-circle" style="cursor: pointer;"></i>
            </div>`;
        $("#additionalBattery").append(newInput);
        feather.replace(); // Reinisialisasi feather icon
    }

    function addRectifierInput() {
        rectifierCount++;
        var newInput = `
            <div class="card-body pg-5">
                <div class="row g-3">
                    <div class="col-md-12">
                        <label class="form-label">Rectifier Name</label>
                        <i class="text-primary removeRectifier" data-feather="minus-circle" style="cursor: pointer;"></i>
                        <input type="text" class="form-control" placeholder="Rectifier ${rectifierCount}" disabled>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Rectifier Brand</label>
                        <select class="form-control" name="rectifier_brand[]">
                            <option value="">--</option>
                            <option value="Emerson">Emerson</option>
                            <option value="Hariff">Hariff</option>
                            <option value="Vertiv">Vertiv</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Battery Brand</label>
                        <select class="form-control" name="battery_brand[]">
                            <option value="">--</option>
                            @foreach ($batteries as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->merk_battery }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Battery Type</label>
                        <select class="form-control" name="battery_type[]">
                            <option value="">--</option>
                            @foreach ($battery_type as $type)
                                <option value="{{ $type->id }}">{{ $type->battery_type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="additionalBattery input-group mb-3">
                                            <div class="col-md-12">
                                                <label class="form-label" for="batteryQuantity">Battery Quantity</label>
                                                <i type="button" class="text-primary" id="addBattery"
                                                    data-feather="plus-circle" style="cursor: pointer;"></i>
                                            </div>
                                            <div class="col-8">
                                                <select class="form-control" id="batteryQuantity">
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
                                                <option selected>Battery Status</option>
                                                <option value="1">Good</option>
                                                <option value="2">Degraded</option>
                                            </select>
                                        </div>
                    <div class="additionalBattery"></div>
                    <div class="col-md-12">
                        <label class="form-label">Battery Backup Time</label>
                        <select class="form-control">
                            <option value="">--</option>
                            <option value="0">0 Jam</option>
                            <option value="1">1 Jam</option>
                            <option value="2">2 Jam</option>
                            <option value="3">3 Jam</option>
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label">Equipment Connected</label>
                        <select class="multiple-select" multiple="multiple" name="equipment[]">
                            @foreach ($equipments as $item)
                                <option value="{{ $item->id }}">{{ $item->equipment_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>`;

        $("#additionalRectifier").append(newInput);
        feather.replace(); // Reinisialisasi feather icon
        $(".multiple-select").select2(); // Inisialisasi select2 pada multiple-select yang baru
    }

    // Tambahkan input Rectifier
    $("#addRectifier").on("click", function () {
        addRectifierInput();
    });

    // Tambahkan input Battery
    $("#addBattery").on("click", function () {
        addBatteryInput();
    });

    // Remove Rectifier
    $("#additionalRectifier").on("click", ".removeRectifier", function () {
        $(this).closest(".card-body").remove();
    });

    // Remove Battery
    $("#additionalBattery").on("click", ".removeBattery", function () {
        $(this).closest(".input-group").remove();
    });

    // Inisialisasi SmartWizard
    var btnFinish = $("<button></button>")
        .text("Submit")
        .addClass("btn btn-info")
        .on("click", function () {
            alert("Finish Clicked");
        });
    var btnCancel = $("<button></button>")
        .text("Cancel")
        .addClass("btn btn-danger")
        .on("click", function () {
            $("#smartwizard").smartWizard("reset");
        });

    $("#smartwizard").smartWizard({
        selected: 0,
        theme: "dots",
        transition: {
            animation: "slide-horizontal",
        },
        toolbarSettings: {
            toolbarPosition: "both",
            toolbarExtraButtons: [btnFinish, btnCancel],
        },
    });

    $(".single-select").select2({
        theme: "bootstrap4",
        width: "100%",
        placeholder: "Select an option",
        allowClear: true,
    });

    $(".multiple-select").select2({
        theme: "bootstrap4",
        width: "100%",
        placeholder: "Select options",
        allowClear: true,
    });

    $("#selectSite").on("change", function () {
        // Ambil alamat dari option yang dipilih
        var selectedOption = $(this).find("option:selected");
        var address = selectedOption.data("address");
    
        // Isi input alamat dengan nilai yang diambil
        $("#address").val(address);
    });
});
