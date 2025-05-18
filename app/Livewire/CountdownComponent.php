<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Order;
use Carbon\Carbon;
use Livewire\Attributes\On;

class CountdownComponent extends Component
{
    public Order $order;
    public $timeRemaining;
    public $isDelivered;
    public $now;
    public $maxDeliveryTime;
    public $deadline;

    public function mount(Order $order)
    {
        $this->order = $order;
        $this->isDelivered = !is_null($order->delivered_at);
        $this->now = now();

        $this->calculateTimeRemaining();
    }

    public function calculateTimeRemaining()
    {
        $maxTime = timeToSec($this->maxDeliveryTime); // assumed in hours or days
        
        if ($this->isDelivered) {
            $deadline = $this->order->created_at->addSeconds($maxTime);
            $deadline = $this->order->created_at->diffInSeconds($deadline, false);
            
            $this->deadline = $deadline;
            $this->timeRemaining = $this->order->created_at->diffInSeconds($this->order->delivered_at, false);
        } else {
            $deadline = $this->order->created_at->addSeconds($maxTime);
            $diff = Carbon::now()->diffInSeconds($deadline, false);
            $this->timeRemaining = $diff;
        }
    }

    #[\Livewire\Attributes\On('orderDelivered')]
    public function onOrderDelivered()
    {
        $this->order->refresh();
        $this->isDelivered = true;
        $this->calculateTimeRemaining();
        
    }

    public function render()
    {
        if (!$this->isDelivered) {
            $this->calculateTimeRemaining(); // Recalculate on each render
        }

        return view('livewire.countdown-component');
    }
}