<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class SellerVerificationComponent extends Component
{
    public Order $order;
    public $identity;

    public function mount(Order $order, $identity)
    {
        $this->order = $order;
        $this->identity = $identity;
    }

    #[On('deliverOrder')]
    public function deliverOrder()
    {
        if (is_null($this->order->delivered_at)) {
            $this->order->update([
                'delivered_at' => now(),
            ]);

            $this->order->refresh(); // ensure latest data
            $this->dispatch('orderDelivered'); // notify other components
        }
    }

    public function render()
    {
        return view('livewire.seller-verification-component');
    }
}