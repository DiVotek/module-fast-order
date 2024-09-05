<?php

namespace Modules\FastOrder\Livewire;

use Livewire\Component;
use Modules\FastOrder\Models\FastOrder;

class FastOrderComponent extends Component
{
    public $name;
    public $phone;
    public $product_id;
    public $modalEvent = 'fastOrder';
    public function render()
    {
        return view('template::' . setting(config('settings.fastOrder.design'),'fastOrder.default'));
    }

    public function submit()
    {
        $this->validate([
            'name' => 'required',
            'phone' => 'required',
            'product_id' => 'required'
        ]);
        FastOrder::query()->create([
            'name' => $this->name,
            'phone' => $this->phone,
            'product_id' => $this->product_id
        ]);
        $this->reset();
        $this->dispatch('close' . $this->modalEvent);
    }
}
