<?php

namespace App\Http\Livewire;

use DB;
use App\Models\Barang;
use App\Models\Booking;
use Livewire\Component;
use App\Models\Dashboard;
use App\Models\MasterContainer;
use App\Models\Mqtt;
use FontLib\Table\Type\name;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class DashboardDetail extends Component
{
    public $name, $mqtt_all, $mqtt, $container, $mqtt_history, $allocated, $free, $persen;
    public $data = [];
    public $idmqtt;
    // public $listener = ['ubahData' => 'changeData'];
    // protected $listeners = ['refreshComponent' => 'getSections'];

    // public function getSections() {
    //     $this->cerated_sections = Section::all();
    // }
    protected $listeners = ['some-event' => '$refresh'];

    public function mount($idmqtt)
    {
        $topicid = $idmqtt;
        // $id_container = Mqtt::where('id', $idmqtt)->get('topic');
        $id_container = Mqtt::find($idmqtt);
        foreach ($id_container as $topic_container) {
            $topic_container = $id_container->topic;
        }
        $mqtt_dashboard = Dashboard::where('topicid', $topicid)->get();
        $mqtt = Mqtt::find($idmqtt);
        $name = Mqtt::find($idmqtt);
        $mqtt_all = Mqtt::all();
        $container = MasterContainer::find($id_container);
        $allocated = DB::table('master_barang')->join('booking', 'master_barang.id', '=', 'booking.id_barang')
        ->where('booking.no_container', '=', $topic_container)->sum('master_barang.berat');
        foreach ($container as $key => $rc) {
            $kapasitas = $rc->kapasitas;
        }
        $free = $kapasitas - $allocated;
        $persen = round(($allocated/$kapasitas)*100,2);
        $coba1 = ceil(16.7);
        $coba2 = floor(-16.7);

        foreach ($mqtt_dashboard as $key => $item) {
            $item['value'] = json_decode($item->value,true);
        }
        $mqtt['value'] = json_decode($mqtt->value,true);

        $data = array(
            'mqtt_history' => $mqtt_dashboard,
            'mqtt' => $mqtt,
            'name' => $name,
            'mqtt_all' => $mqtt_all,
            'container' => $container,
            'allocated' => $allocated,
            'free' => $free,
            'persen' => $persen
        );

        // $this->data = $data;
        $this->name = $name;
        $this->mqtt_all = $mqtt_all;
        $this->mqtt = $mqtt;
        $this->container = $container;
        $this->mqtt_history = $mqtt_dashboard;
        $this->allocated = $allocated;
        $this->free = $free;
        $this->persen = $persen;
        // $this->emitSelf('refresh-me');
        $this->emit('some-event');
        // return response()->json($data);
        // dd($coba2);
    }

    public function loadData()
    {
        // $this->data = $data;
        $this->name = $this->name;
        $this->mqtt_all = $this->mqtt_all;
        $this->mqtt = $this->mqtt;
        $this->container = $this->container;
        $this->mqtt_history = $this->mqtt_history;
        $this->allocated = $this->allocated;
        $this->free = $this->free;
        $this->persen = $this->persen;
        // return response()->json($data);
        // dd($name);
    }

    public function render()
    {
        // return response()->mqtt_history;
        // return $data;
        // return response()->json($this->data);
        return view('livewire.dashboard-detail')->with($this->data, $this->emit('some-event'), $this->mount($this->idmqtt));

    }

    // public function changeData($name, $mqtt_all, $mqtt, $container, $mqtt_history)
    // {
    //     $this->name = $name;
    //     $this->mqtt_all = $mqtt_all;
    //     $this->mqtt = $mqtt;
    //     $this->container = $container;
    //     $this->mqtt_history = $mqtt_history;
    //     $this->emit('berhasilUpdate',['name' => $this->name, 'mqtt_all' => $this->mqtt_all, 'mqtt' => $this->mqtt, 'container' => $this->container, 'mqtt_history' => $this->mqtt_history]);
    // }

    public function changeData()
    {
        $this->emit('some-event');

    }
}
