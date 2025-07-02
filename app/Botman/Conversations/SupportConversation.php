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
        $this->bot->typesAndWaits(1);
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
        $this->bot->typesAndWaits(1);
        $question = Question::create("How can I help you as a Buyer?")
            ->addButtons([
                Button::create('👥I have a problem with my order')->value('order'),
                Button::create('🌐 I have another issue')->value('another'),
            ]);

        $this->ask($question, function ($answer) {
            if ($answer == 'order') {

                $this->bot->typesAndWaits(1);
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
                    
                    $this->bot->typesAndWaits(1);
                    if ($answer == 'items') {
                        $question = Question::create("")
                            ->addButtons([
                                Button::create('✖️ My order was not delivered')->value('not_delivered'),
                                Button::create('😕 My order is not as described')->value('not_as_described'),
                                Button::create('💲 Refund & Return Policy')->value('refund'),
                                Button::create('📢 I would like to report my seller')->value('report_seller'),
                                Button::create('🌐 Other')->value('other'),
                            ]);
                        
                        $this->ask($question, function ($answer) {
                            $this->bot->typesAndWaits(1);

                            if ($answer == 'not_delivered') {
                                
                                $this->bot->reply('
                                    If your order wass not delivered within guaranteed delivery time, please raise a dispute and our team will cancel it within 15 minutes.<br><br>

                                    If there is another issue with your order delivery, please select the option below, it will redirect you to our team.');

                                $this->bot->typesAndWaits(1);
                                $question = Question::create("")
                                    ->addButtons([
                                        Button::create('👥 I have another issue')->value('other_issue'),
                                        Button::create('✔️ Close conversation')->value('close'),
                                    ]);
                                
                                $this->ask($question, function ($answer) {
                                    $this->bot->typesAndWaits(1);

                                    if($answer == 'other_issue') {
                                        $this->bot->reply('
                                            We are sorry to hear you have issues with your order.
                                            ​<br><br>
                                            Please fill out the form below and provide as much information as possible to support your claims.
                                            ​​<br><br>
                                            Usual response time is within 12 hours. 🕐
                                            ​<br><br>
                                            I will be closing this chat, but don\'t worry, you are still able to submit a ticket below!');
                                        
                                        $this->bot->typesAndWaits(1);
                                        $question = Question::create("")
                                            ->addButtons([
                                                Button::create('Create Ticket')->value('#')->url('#'),
                                            ]);

                                        $this->ask($question, function () {
                                            // Optional: Handle next response
                                        });
                                    } else if ($answer == 'close') {
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
                                    }
                                });
                            }
                        });
                    } else if ($answer == 'boosting') {
                        $question = Question::create("If there are any issues with your order, we recommend contacting your seller first. In any other case, we are here to help you!")
                            ->addButtons([
                                Button::create('✖️ Seller has ruined my account')->value('ruined_account'),
                                Button::create('✖️ Seller has taken items from my account')->value('taken_items'),
                                Button::create('✖️ Seller did not complete my order in time')->value('not_complete'),
                                Button::create('💲 Refund & Return Policy')->value('refund'),
                                Button::create('🌐 Other')->value('other'),
                            ]);
                        
                        $this->ask($question, function ($answer) {

                            $this->bot->typesAndWaits(1);
                            if ($answer == 'ruined_account') {
                                
                                $this->bot->reply('
                                    Please fill out the ticket below to send a report to our team.<br><br>

                                    I will be closing the chat, but don\'t worry, we will still receive your ticket.');

                                $this->bot->typesAndWaits(1);
                                $question = Question::create("")
                                    ->addButtons([
                                        Button::create('Create Ticket')->value('#')->url('#'),
                                    ]);

                                $this->ask($question, function () {
                                    // Optional: Handle next response
                                });
                            } else if ($answer == 'taken_items') {
                                
                                $this->bot->reply('
                                    Please fill out the ticket below to send a report to our team.<br><br>

                                    I will be closing the chat, but don\'t worry, we will still receive your ticket.');

                                $this->bot->typesAndWaits(1);
                                $question = Question::create("")
                                    ->addButtons([
                                        Button::create('Create Ticket')->value('#')->url('#'),
                                    ]);

                                $this->ask($question, function () {
                                    // Optional: Handle next response
                                });
                            } else if ($answer == 'not_complete') {
                                
                                $this->bot->reply('
                                    It seems like you\'re having an issue that needs to be addressed by our dispute team. You will be redirected to them, since our general support is not able to investigate your issue.<br><br>

                                    I will be closing the chat, but don\'t worry, we will still receive your ticket.');

                                $this->bot->typesAndWaits(1);
                                $question = Question::create("")
                                    ->addButtons([
                                        Button::create('Create Ticket')->value('#')->url('#'),
                                    ]);

                                $this->ask($question, function () {
                                    // Optional: Handle next response
                                });
                            } else if ($answer == 'refund') {
                                
                                $this->bot->reply('
                                    Your order is eligible for a refund, if:<br>
                                    <ul style="padding-inline-start: 10px;">
                                        <li>📌 The seller has failed to fully deliver the order within guaranteed delivery time.</li>
                                        <li>📌 The seller caused harm to the account (e.g., continuous demotions, loss of status such as OSRS Ironman, ruined stats like pure accounts, etc.).</li>
                                        <li>📌 The seller used/took valuable items from the account without your permission.*</li>
                                        <li>📌 The seller changed the login details of your account without your permission.*</li>
                                        <li>📌 The seller used third-party programs, leading to account restriction or banning.*</li>
                                    </ul>
                                ');

                                $this->bot->typesAndWaits(1);
                                $this->bot->reply('
                                    *In such cases, please report the seller to us immediately.
                                ');

                                $this->bot->typesAndWaits(1);
                                $this->bot->reply('
                                    Your order is not eligible for a refund, if:<br>
                                    <ul style="padding-inline-start: 10px;">
                                        <li>📌 You purchased the order by mistake and it was delivered.</li>
                                        <li>📌 Guaranteed delivery time has not passed</li>
                                        <li>📌 The seller was unable to proceed with the boost due to lack of access to the account or interruptions from outside actions.</li>
                                        <li>📌 Evidence of incomplete delivery is shared on external platforms other than Eldorado.</li>
                                        <li>📌 The boost was not purchased on Eldorado.</li>
                                        <li>📌 The account was banned/shadow banned due to your actions (i.e. botting, toxic behavior, contacting game developers, etc.).</li>
                                    </ul>
                                ');

                                $this->bot->typesAndWaits(1);
                                $question = Question::create("")
                                    ->addButtons([
                                        Button::create('Refund & Return Policy')->value('#')->url('#'),
                                    ]);

                                $this->ask($question, function () {
                                    // Optional: Handle next response
                                });
                            } else if ($answer == 'other') {
                                $this->bot->reply('
                                    ​Please describe your issue to the best of your ability in the message so I can transfer you to our team.');
                            }



                            //     $question = Question::create("")
                            //     ->addButtons([
                            //         Button::create('👥 I have another issue')->value('other_issue'),
                            //         Button::create('✔️ Close conversation')->value('close'),
                            //     ]);
                                
                            //     $this->ask($question, function ($answer) {
                            //         if($answer == 'other_issue') {
                            //             $this->bot->reply('
                            //                 We are sorry to hear you have issues with your order.
                            //                 ​<br><br>
                            //                 Please fill out the form below and provide as much information as possible to support your claims.
                            //                 ​​<br><br>
                            //                 Usual response time is within 12 hours. 🕐
                            //                 ​<br><br>
                            //                 I will be closing this chat, but don\'t worry, you are still able to submit a ticket below!');
                                        
                            //             $question = Question::create("")
                            //                 ->addButtons([
                            //                     Button::create('Create Ticket')->value('#')->url('#'),
                            //                 ]);

                            //             $this->ask($question, function () {
                            //                 // Optional: Handle next response
                            //             });
                            //         } else if ($answer == 'close') {
                            //             $this->say("❌ Conversation closed. Thank you!");

                            //             $question = Question::create("👋 Hi! Please click the button below to begin:")
                            //                 ->addButtons([
                            //                     Button::create('Start New Conversation')->value('start_over'),
                            //                 ]);

                            //             $this->ask($question, function ($answer) {
                            //                 if ($answer->getValue() === 'start_over') {
                            //                     $this->askBuyerOrSeller(); // Properly restart the flow here
                            //                 }
                            //             });
                            //         }
                            //     });
                            // }
                        });
                    }
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
