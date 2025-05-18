<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;

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
    public function deliverOrder($orderStatus)
    {
        if (is_null($this->order->delivered_at)) {
            $this->order->update([
                'delivered_at' => now(),
                'order_status' => $orderStatus,
            ]);
        }else {
            $this->order->update([
                'order_status' => $orderStatus,
            ]);
        }

        $this->order->refresh(); // ensure latest data
        $this->dispatch('orderDelivered', orderStatus: $orderStatus); // notify other components
    }

    #[On('cancelOrder')]
    public function cancelOrder($reason, $details, $orderStatus)
    {
        if (is_null($this->order->cancelled_at)) {
            $this->order->update([
                'cancelled_at' => now(),
                'cancelation_reason' => $reason,
                'cancelation_details' => $details,
                'order_status' => $orderStatus,
            ]);
        }
        $this->order->refresh(); // ensure latest data
        $this->dispatch('orderCancelled', orderStatus: $orderStatus); // notify other components
    }

    public function render()
    {
        return view('livewire.seller-verification-component');
    }
}