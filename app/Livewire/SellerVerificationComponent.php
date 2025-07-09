<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Notifications\UserOrderDisputedNotification;
use App\Notifications\BoostingOfferNotification;
use App\Notifications\OrderDisputedNotification;
use App\Events\OrderEvent;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use Illuminate\Support\Facades\Notification;

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

        // Email
            if($orderStatus == 'delivered') {
                $emailData = [
                    'title'     => 'Order Delivered',
                    'name'      => $this->order->seller->username,
                    'data'      => 'Your Order has been delivered.',
                    'data1'     => $this->order->categoryGame->game->name.' - '.$this->order->categoryGame->category->name,
                    'data2'     => 'Buyer: '.auth()->user()->username,
                    'data3'     => $this->order->order_id,
                    'buyer_id'  => auth()->id(),
                    'link'      => url('order/' . $this->order->order_id),
                    'game_id'   => $this->order->categoryGame->game_id,
                    'admin'     => '0',
                ];

                $notification_exists = User::where('id',$this->order->buyer->id)->whereHas('emailNotifications', function($query){
                    $query->where('name','Order updates');
                })->first();
                
                if($notification_exists != null){
                    Mail::to($this->order->buyer->email)->send(new OrderMail($emailData));
                }
                    
            }
        // Email

        if($this->order->disputed == 1 && $orderStatus == 'received'){
            $this->order->update([
                'dispute_won' => $this->order->seller_id,
            ]);


            $data = [
                'title'     => 'Dispute won',
                'data1'     => $this->order->categoryGame->game->name. '-' .$this->order->categoryGame->category->name,
                'data2'     => '',
                'game_id'   => $this->order->categoryGame->game->id,
                'link'      => url('order/' . $this->order->order_id),
                'category'  => 'notification',
            ];

            $data1 = [
                'title'     => 'Dispute lost',
                'data1'     => $this->order->categoryGame->game->name. '-' .$this->order->categoryGame->category->name,
                'data2'     => '',
                'link'      => url('order/' . $this->order->order_id),
                'game_id'   => $this->order->categoryGame->game->id,
                'category'     => 'notification',
            ];

            Notification::send($this->conversation->seller, new BoostingOfferNotification($data));

            if(auth()->user()->role == 'admin')
            Notification::send($this->conversation->buyer, new BoostingOfferNotification($data1));
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

            
            // Email
                if (auth()->id() == $this->order->buyer_id) {
                    $cancelled_by = 'buyer';
                } else if (auth()->id() == $this->order->seller_id) {
                    $cancelled_by = 'seller';
                } else if (auth()->user()->role == 'admin') {
                    $cancelled_by = 'gamify';
                }

                if ($this->order->cancelation_reason == 1){
                    $cancel_reason = 'Buyer has provided incorrect account information';
                } elseif ($this->order->cancelation_reason == 2){
                    $cancel_reason = 'Out of stock';
                } elseif ($this->order->cancelation_reason == 3){
                    $cancel_reason = 'Buyer does not meet criteria for the order';
                } elseif ($this->order->cancelation_reason == 4){
                    $cancel_reason = 'Buyer is unresponsive';
                } elseif ($this->order->cancelation_reason == 5){
                    $cancel_reason = 'Buyer does not need it anymore';
                } elseif ($this->order->cancelation_reason == 6){
                    $cancel_reason = 'Mutual agreement';
                } else{
                    $cancel_reason = 'Other';
                } 

                $emailData = [
                    'title'     => 'Order Cancelled',
                    'name'      => $this->order->seller->username,
                    'reason'    => $cancel_reason,
                    'data'      => 'This Order has been cancelled by '.$cancelled_by.'.',
                    'data1'     => $this->order->categoryGame->game->name.' - '.$this->order->categoryGame->category->name,
                    'data2'     => 'Buyer: '.auth()->user()->username,
                    'data3'     => $this->order->order_id,
                    'buyer_id'  => auth()->id(),
                    'link'      => url('order/' . $this->order->order_id),
                    'game_id'   => $this->order->categoryGame->game_id,
                    'admin'     => '0',
                ];

                $notification_exists = User::where('id',$this->order->buyer->id)->whereHas('emailNotifications', function($query){
                    $query->where('name','Order updates');
                })->first();
                
                if($notification_exists != null){
                    Mail::to($this->order->buyer->email)->send(new OrderMail($emailData));
                }
            // Email

            if($this->order->disputed == 1){
                $this->order->update([
                    'dispute_won' => $this->order->buyer_id,
                ]);

                $data = [
                    'title'     => 'Dispute won',
                    'data1'     => $this->order->categoryGame->game->name. ' - ' .$this->order->categoryGame->category->name,
                    'data2'     => '',
                    'link'      => url('order/' . $this->order->order_id),
                    'game_id'   => $this->order->categoryGame->game->id,
                    'category'  => 'notification',
                ];

                $data1 = [
                    'title'     => 'Dispute lost',
                    'data1'     => $this->order->categoryGame->game->name. ' - ' .$this->order->categoryGame->category->name,
                    'data2'     => '',
                    'link'      => url('order/' . $this->order->order_id),
                    'game_id'   => $this->order->categoryGame->game->id,
                    'category'  => 'notification',
                ];

                Notification::send($this->conversation->buyer, new BoostingOfferNotification($data));
                
                if(auth()->user()->role == 'admin')
                Notification::send($this->conversation->seller, new BoostingOfferNotification($data1));
            }
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

            $admins = User::where('role','admin')->get();

            $data = [
                'title'     => 'Order Dispute',
                'data1'     => $this->order->categoryGame->game->name. ' - ' .$this->order->categoryGame->category->name,
                'reason'     => $reason,
                'link'      => url('order/' . $this->order->order_id),
                'admin'     => '1',
            ];

            $data1 = [
                'title'     => 'Dispute created',
                'data1'     => $this->order->categoryGame->game->name. ' - ' .$this->order->categoryGame->category->name,
                'data2'     => 'Buyer: '.$this->conversation->seller->username,
                'link'      => url('order/' . $this->order->order_id),
                'game_id'   => $this->order->categoryGame->game->id,
                'category'  => 'notification',
            ];

            Notification::send($admins, new OrderDisputedNotification($data));
            Notification::send($this->conversation->seller, new BoostingOfferNotification($data1));

            // Email
                if (auth()->id() == $this->order->buyer_id) {
                    $cancelled_by = 'buyer';
                } else if (auth()->user()->role == 'admin') {
                    $cancelled_by = 'gamify';
                }

                if ($this->order->dispute_reason == 1) {
                    $dispute_reason = 'Guaranteed delivery time is overdue';
                }elseif ($this->order->dispute_reason == 2) {
                    $dispute_reason = 'Seller claims goods were delivered, but the order was not received';
                }elseif ($this->order->dispute_reason == 3) {
                    $dispute_reason = 'Cannot claim purchase due to in-game issues';
                }elseif ($this->order->dispute_reason == 4) {
                    $dispute_reason = 'Order is not as described';
                }elseif ($this->order->dispute_reason == 5) {
                    $dispute_reason = 'Seller is unresponsive';
                }else {
                    $dispute_reason = 'Other';
                }
                
                $emailData = [
                    'title'     => 'Order Disputed',
                    'name'      => $this->order->seller->username,
                    'reason'    => $dispute_reason,
                    'data'      => 'This Order has been disputed by '.$cancelled_by.'.',
                    'data1'     => $this->order->categoryGame->game->name.' - '.$this->order->categoryGame->category->name,
                    'data2'     => 'Buyer: '.auth()->user()->username,
                    'data3'     => $this->order->order_id,
                    'buyer_id'  => auth()->id(),
                    'link'      => url('order/' . $this->order->order_id),
                    'game_id'   => $this->order->categoryGame->game_id,
                    'admin'     => '0',
                ];

                $notification_exists = User::where('id',$this->order->seller->id)->whereHas('emailNotifications', function($query){
                    $query->where('name','Dispute updates');
                })->first();
                
                if($notification_exists != null){
                    Mail::to($this->order->seller->email)->send(new OrderMail($emailData));
                }
            // Email

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