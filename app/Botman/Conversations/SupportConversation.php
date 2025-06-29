<?php

namespace App\BotMan\Conversations;

use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class SupportConversation extends Conversation
{
    public function run()
    {
        $this->askBuyerOrSeller();
    }

    public function askBuyerOrSeller()
    {
        $question = Question::create("Are you a Buyer or Seller?")
            ->fallback("Please select an option.")
            ->callbackId('select_user_type')
            ->addButtons([
                Button::create('👤 Buyer')->value('buyer'),
                Button::create('🏪 Seller')->value('seller'),
            ]);

        $this->ask($question, function ($answer) {
            $value = $answer->getValue();

            if ($value === 'buyer') {
                $this->buyerOptions();
            } elseif ($value === 'seller') {
                $this->sellerOptions();
            } else {
                $this->say("Please click a button.");
                $this->repeat();
            }
        });
    }

    public function buyerOptions()
    {
        $question = Question::create("How can I help you as a Buyer?")
            ->addButtons([
                Button::create('👥I have a problem with my order')->value('order'),
                Button::create('🌐 I have another issue')->value('another'),
            ]);

        $this->ask($question, function ($answer) {
            if ($answer == 'order') {
                $question = Question::create("")
                    ->addButtons([
                        Button::create('💵 Issue with my currency/items')->value('items'),
                        Button::create('🚀 Issue with my boosting')->value('boosting'),
                        Button::create('👤 Issue with my account purchase')->value('account'),
                        Button::create('📦 How do I receive my purchase?')->value('recieve'),
                        Button::create('🛡️ How do I claim my extended warranty?')->value('warranty'),
                        Button::create('💸 My payment is not going through')->value('payment'),
                        Button::create('🔎 My account is being verified/reviewed')->value('reviewed'),
                        Button::create('😕 I can\'t find what I\'m looking for')->value('confused'),
                        Button::create('🛡️ How does Gamify protect me?')->value('security'),
                        Button::create('🛡️What is the dispute process like?')->value('dispute'),
                        Button::create('🌐 Other')->value('other'),
                    ]);
                
                $this->ask($question, function ($answer) {
                    
                });

            } else if ($answer == 'another') {

            }

            // $this->handleSupportOption($answer->getValue(), 'buyer');
        });
    }

    public function sellerOptions()
    {
        $question = Question::create("How can I help you as a Seller?")
            ->addButtons([
                Button::create('📜 Seller Rules')->value('rules'),
                Button::create('📦 Order Status')->value('order_status'),
                Button::create('✔️ Verification')->value('verification'),
                Button::create('❌ Close Conversation')->value('close'),
                Button::create('💬 Live Support')->value('live_support'),
            ]);

        $this->ask($question, function ($answer) {
            
            // $this->handleSupportOption($answer->getValue(), 'seller');
        });
    }

    

    public function handleSupportOption($value, $role)
    {
        switch ($value) {
            case 'payment':
                $this->say("💳 Payment info: Here's how payments work...");
                break;
            case 'refund':
                $this->say("💸 Refund policy: You can request a refund within 7 days.");
                break;
            case 'report':
                $this->say("🚨 Please describe your issue to report.");
                break;
            case 'rules':
                $this->say("📜 Seller Rules: Make sure to follow our platform policies.");
                break;
            case 'order_status':
                $this->say("📦 Order Status: You can view your orders in the seller dashboard.");
                break;
            case 'verification':
                $this->say("✔️ Verification: Submit your documents in the seller portal.");
                break;
            case 'close':
                $this->say("❌ Conversation closed. Thank you!");

                $question = Question::create("👋 Hi! Please click the button below to begin:")
                    ->addButtons([
                        Button::create('Start New Conversation')->value('start_over'),
                    ]);

                $this->ask($question, function ($answer) {
                    if ($answer->getValue() === 'start_over') {
                        $this->askBuyerOrSeller(); // Properly restart the flow here
                    }
                });
                return;
            case 'live_support':
                $this->say("💬 Notifying admin for live support... Please wait.");

                // 👇 Here you can trigger a Livewire event, store request in DB, send notification, etc.
                // event(new \App\Events\LiveSupportRequested($role)); // Example
                return;
            default:
                $this->say("❓ Unknown option.");
                break;
        }

        // After response, show options again
        // $role === 'buyer' ? $this->buyerOptions() : $this->sellerOptions();
    }
}
