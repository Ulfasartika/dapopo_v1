<?php

namespace App\Livewire;

use App\Models\Equipment;
use Livewire\Component;

class Rectifier extends Component
{
    public $rectifiers = [];
    public $equipments = [];

    public function mount()
    {
        $this->equipments = Equipment::all(); 
    }

    public function addrecti()
    {
        $this->rectifiers[] = [
            'recti_name' => '',
            'recti_brand' => '',
            'apr_quantity' => '',
            'bus_voltage' => '',
            'load' => '',
            'battery_brand' => '',
            'battery_type' => '',
            'battery_quantity' => '',
            'battery_status' => '',
            'backup_time' => '',
            'id_equipment' => []
        ];
    }

    public function render()
    {
        return view('livewire.rectifier');
    }

    public function removeRecti($index)
{
    unset($this->rectifiers[$index]);
    $this->rectifiers = array_values($this->rectifiers); // Reindex array
}

}
