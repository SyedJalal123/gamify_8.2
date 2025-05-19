<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Events\OrderEvent;

class SellerVerificationComponent extends Component
{
    public Order $order;
    public $identity;
    public $conversation;
    public $reciever;
    public $sender_id;

    public function mount(Order $order, $identity)
    {
        $this->order = $order;
        $this->identity = $identity;
        $this->sender_id = auth()->id();

        $this->reciever = $this->identity == 'seller'
                ? $this->conversation->buyer
                : $this->conversation->seller;
        
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

        broadcast(new OrderEvent($this->order->id, $this->reciever->id, $this->sender_id, $orderStatus));
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
        $this->dispatch('orderCancelled', orderStatus: $orderStatus);

        broadcast(new OrderEvent($this->order->id, $this->reciever->id, $this->sender_id, 'cancelled'));
    }

    #[On('disputeOrder')]
    public function disputeOrder($reason, $details)
    {
        if ($this->order->disputed == 0) {
            $this->order->update([
                'disputed_at' => now(),
                'dispute_reason' => $reason,
                'dispute_details' => $details,
                'disputed' => 1,
            ]);
        }
        $this->order->refresh(); // ensure latest data

        $this->dispatch('orderDisputed', orderStatus: 'disputed');

        broadcast(new OrderEvent($this->order->id, $this->reciever->id, $this->sender_id, 'disputed'));
    }

    #[On('order-update')]
    public function orderUpdate($data) {

        // dd($data);
        if($data['action'] == 'delivered' || $data['action']  == 'received'){
            $this->order->refresh();
            $this->dispatch('orderDelivered', orderStatus: $data['action']);
        }

        if($data['action'] == 'cancelled'){
            $this->order->refresh();
            $this->dispatch('orderCancelled', orderStatus: 'cancelled');
        }

        if($data['action'] == 'disputed'){
            $this->order->refresh();
            $this->dispatch('orderDisputed', orderStatus: 'disputed');
        }
        
    }

    public function render()
    {
        return view('livewire.seller-verification-component');
    }
}