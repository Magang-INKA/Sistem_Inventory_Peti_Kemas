<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Dashboard;
use App\Models\MasterContainer;
use App\Models\Mqtt;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardDetail extends Component
{
    public $name, $mqtt_all, $mqtt, $container, $mqtt_history;
    public $listener = ['ubahData' => 'changeData'];

    public function mount($name, $mqtt_all, $mqtt, $container, $mqtt_history)
    {
        $this->name = $name;
        $this->mqtt_all = $mqtt_all;
        $this->mqtt = $mqtt;
        $this->container = $container;
        $this->mqtt_history = $mqtt_history;
        // dd($name);
    }

    public function render()
    {
        // return response()->mqtt_history;
        // return $data;
        return view('livewire.dashboard-detail');
    }

    public function changeData($name, $mqtt_all, $mqtt, $container, $mqtt_history)
    {
        $this->name = $name;
        $this->mqtt_all = $mqtt_all;
        $this->mqtt = $mqtt;
        $this->container = $container;
        $this->mqtt_history = $mqtt_history;
        $this->emit('berhasilUpdate',['name' => $this->name, 'mqtt_all' => $this->mqtt_all, 'mqtt' => $this->mqtt, 'container' => $this->container, 'mqtt_history' => $this->mqtt_history]);
    }
}
