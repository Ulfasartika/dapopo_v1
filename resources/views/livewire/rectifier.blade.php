<div>
    @foreach ($rectifiers as $index => $rectifier)
                <div class="mb-3">
                    <label for="recti_name_{{ $index }}" class="form-label">Rectifier Name</label>
                    <input type="text" class="form-control" id="recti_name_{{ $index }}" wire:model="rectifiers.{{ $index }}.recti_name">
                </div>
                <div class="mb-3">
                    <label for="inRectiBrand_{{ $index }}" class="form-label">Rectifier Brand</label>
                    <select name="recti_brand_{{ $index }}" id="inRectiBrand_{{ $index }}" class="form-select single-select">
                        <option hidden value="">-- Select Brand --</option>
                        <option value="Emerson">Emerson</option>
                        <option value="Hariff">Hariff</option>
                        <option value="Vertiv">Vertiv</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label" for="inAprQuantity_{{ $index }}">APR Quantity</label>
                    <select class="form-select single-select" id="inAprQuantity_{{ $index }}" name="apr_quantity_{{ $index }}">
                        <option hidden>-- Select Qty --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="bus_voltage_{{ $index }}" class="form-label">Bus Voltage (V)</label>
                    <input type="number" class="form-control" id="bus_voltage_{{ $index }}" name="bus_voltage_{{ $index }}"
                        step="0.1">
                </div>
                <div class="mb-3">
                    <label for="load_{{ $index }}" class="form-label">Load (A)</label>
                    <input type="number" class="form-control" id="load_{{ $index }}" name="load_{{ $index }}" step="0.1">
                </div>
                <div class="mb-3">
                    <label for="inBatteryBrand_{{ $index }}" class="form-label">Battery Brand</label>
                    <select id="inBatteryBrand_{{ $index }}" class="form-select single-select" name="battery_brand_{{ $index }}">
                        <option hidden>-- Select Brand --</option>
                        <option value="Sacredsun">Sacredsun</option>
                        <option value="ZTE">ZTE</option>
                        <option value="Sonneinchen">Sonneinchen</option>
                        <option value="Maxlife">Maxlife</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="inBatteryType_{{ $index }}" class="form-label">Battery Type</label>
                    <select id="inBatteryType_{{ $index }}" class="form-select single-select" name="battery_type_{{ $index }}" required>
                        <option hidden>-- Select Type --</option>
                        <option value="Lithium">Lithium</option>
                        <option value="VRLA">VRLA</option>
                    </select>
                </div>
                <div id="battery-section">
                    <label class="form-label" for="batteryQuantity_{{ $index }}">Battery Quantity</label>
                    <div class="input-group mb-3 battery-fields">
                        <select class="form-select" id="batteryQuantity_{{ $index }}" name="battery_quantity[]_{{ $index }}" required>
                            <option hidden>-- Battery Qty --</option>
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
                        <select class="form-select" name="battery_status[]_{{ $index }}" required>
                            <option hidden>Battery Status</option>
                            <option value="Good">Good</option>
                            <option value="Degraded">Degraded</option>
                            <option value="Stolen">Stolen</option>
                        </select>
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2">Add
                            Battery</button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="backup_time_{{ $index }}" class="form-label">Backup Time (Hour)</label>
                    <input type="number" class="form-control" id="backup_time_{{ $index }}" name="backup_time_{{ $index }}">
                </div>
                <div class="mb-3">
                    <label for="id_equipment_{{ $index }}" class="form-label">Equipment</label>
                    <select class="multiple-select" id="id_equipment_{{ $index }}" name="id_equipment[]_{{ $index }}"
                        multiple="multiple">
                        @foreach ($equipments as $equip)
                            <option value="{{ $equip->id }}">{{ $equip->equipment_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="image_{{ $index }}" class="form-label">Upload Image</label>
                    <small class="form-text text-muted">Please upload an image captured with a camera that
                        includes a timestamp.</small>
                    <input type="file" name="image_{{ $index }}" id="gambarRectiInput" accept="image/png, image/jpeg"
                        class="form-control" onchange="previewImage(this)">
                    <div class="mt-2" hidden>
                        <img src="" alt="" id="gambarRectiPreview"
                            style="max-width: 100%; height: 300px;  display:block; margin:auto;">
                    </div>
                </div>
                <button type="button" class="btn btn-danger" wire:click="removeRecti({{ $index }})">
                    Remove
                </button>
    @endforeach
    <br>
    <button type="button" class="btn btn-outline-secondary mt-3" wire:click="addrecti">Add Rectifier</button>     
</div>
