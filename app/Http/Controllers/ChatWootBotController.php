<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatWootBotController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        // Log::info($payload);
        if ($payload['event'] === 'conversation_created') {
            
            $conversationId = $payload['id'];

            $response = Http::withHeaders([
                'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
            ])->post("https://app.chatwoot.com/api/v1/accounts/126164/conversations/{$conversationId}/toggle_typing_status", [
                'typing_status' => 'on'
            ]); 

            // Call your function to send quick action buttons
            $this->defaultQuestion($conversationId);
        }

        return response()->json(['status' => 'ok']);
    }

    public function defaultQuestion($conversationId)
    {

        $response = Http::withHeaders([
            'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
        ])->post("https://app.chatwoot.com/api/v1/accounts/126164/conversations/{$conversationId}/toggle_typing_status", [
            'typing_status' => 'off'
        ]); 
        
        $response = Http::withHeaders([
            'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
        ])->post('https://app.chatwoot.com/api/v1/accounts/126164/conversations/'.$conversationId.'/messages', [
            'content_type' => 'input_select',
            'content' => 'Select one of the items below',
            'content_attributes' => [
                'items' => [
                    ['title' => 'Buyer', 'value' => 'buyer'],
                    ['title' => 'Seller', 'value' => 'seller'],
                ],
            ],
        ]);


    }

    public function seletedOptions(Request $request) 
    {
        $payload = $request->all();

        if ($payload['event'] === 'message_updated' && isset($payload['content_attributes']['submitted_values'][0]['value'])) {
            // Log::info($payload);
            
            $conversationId = $payload['conversation']['id'];

            $response = Http::withHeaders([
                'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
            ])->post("https://app.chatwoot.com/api/v1/accounts/126164/conversations/{$conversationId}/toggle_typing_status", [
                'typing_status' => 'on'
            ]); 

            $this->answers($conversationId, $payload['content_attributes']['submitted_values'][0]['value']);
        }

        return response()->json(['status' => 'ok']);
    }

    public function answers($conversationId, $message) 
    {
        
        // Log::info($message);
        $data = null;
        $text = null;
        $text1 = null;
        $text2 = null;
        $text3 = null;
        $image_path = null;
        $image = null;
        $customer_support = 0;
        $close_conversation = 0;

        if($message == 'buyer') {
            $data = [
                'items' => [
                    ['title' => '👥 I have a problem with my order'     , 'value' => 'buyer_order'],
                    ['title' => '🌐 I have another issue'               , 'value' => 'buyer_another'],
                ],
            ];
        }

        // buyer

            if($message == 'buyer_order') {
                $data = [
                    'items' => [
                        ['title' => '💵 Issue with my currency/items'           , 'value' => 'buyer_items'],
                        ['title' => '🚀 Issue with my boosting'                 , 'value' => 'buyer_boosting'],
                        ['title' => '👤 Issue with my account purchase'         , 'value' => 'buyer_account'],
                        ['title' => '📦 How do I receive my purchase?'          , 'value' => 'buyer_recieve_purchase'],
                        ['title' => '🛡️ How do I claim my extended warranty?'   , 'value' => 'buyer_warranty'],
                        ['title' => '💸 My payment is not going through'        , 'value' => 'buyer_payment'],
                        ['title' => '🔎 My account is being verified/reviewed'  , 'value' => 'buyer_reviewed'],
                        ['title' => '😕 I can\'t find what I\'m looking for'    , 'value' => 'buyer_confused'],
                        ['title' => '🛡️ How does Gamify protect me?'            , 'value' => 'buyer_security'],
                        ['title' => '🛡️ What is the dispute process like?'       , 'value' => 'buyer_dispute_info'],
                        ['title' => '🌐 Other'                                  , 'value' => 'buyer_order_other'],
                        
                    ],
                ];
            }

            // buyer_order
                if($message == 'buyer_items') {
                    $data = [
                        'items' => [
                            ['title' => '✖️ My order was not delivered'        , 'value' => 'buyer_items_not_delivered'],
                            ['title' => '😕 My order is not as described'      , 'value' => 'buyer_items_not_as_described'],
                            ['title' => '💲 Refund & Return Policy'             , 'value' => 'buyer_items_refund'],
                            ['title' => '📢 I would like to report my seller'  , 'value' => 'buyer_report_seller'],
                            ['title' => '🌐 Other'                             , 'value' => 'buyer_items_other'],
                        ],
                    ];
                }

                // buyer_items
                    if($message == 'buyer_items_not_delivered') {
                        $text = "If your order wass not delivered within guaranteed delivery time, please raise a dispute and our team will cancel it within 15 minutes.";
                        $text1 = "If there is another issue with your order delivery, please select the option below, it will redirect you to our team.";
                        $data = [
                            'items' => [
                                ['title' => '👥 I have another issue'    , 'value' => 'buyer_items_another'],
                                ['title' => '✔️ Close conversation'      , 'value' => 'close_conversation'],
                            ],
                        ];
                    }

                    if (in_array($message, ['buyer_items_not_delivered','buyer_items_other','buyer_items_another','buyer_account_purchase_want_warranty'])) {
                        $text = "We are sorry to hear you have issues with your order.

                                \n\nPlease fill out the form below and provide as much information as possible to support your claims.

                                \n\nUsual response time is within 12 hours. 🕐";
                        $text1 = "I will be closing this chat, but don't worry, you are still able to submit a ticket below!";
                        $text2 = "[**Create Ticket 🎫**\nOrder issues.](" . url('/') . ")";
                    }

                    if($message == 'buyer_items_refund') {
                        $text = "**Your order is eligible for a refund, if:**\n\n" .
                                    "📌 The seller has failed to fully deliver the order within guaranteed delivery time.\n" .
                                    "📌 Seller has failed to notify you of certain risks (excluding RWT) that negatively impacted your account.\n" .
                                    "📌 Seller has only partially delivered your order within the guaranteed delivery time.\n" .
                                    "📌 Your account was affected by receiving currency or items obtained through cheating or fraud.\n";

                        $text1 = "**Your order is _not_ eligible for a refund, if:**\n\n" .
                                    "📌 Items/currency were not bought on Gamify.\n" .
                                    "📌 Guaranteed delivery time has not passed.\n" .
                                    "📌 Evidence of incomplete delivery is shared on external platforms other than Gamify.\n" .
                                    "📌 Your account was banned due to RWT or risks that were disclosed by the seller.\n";
                                    "📌 You provided a wrong account/character name and order was delivered.";
                                    "📌 You traded the items/currency back to a different account.";

                        $text2 = "***Never** accept any trades after the trade between you and the seller has been completed.\n[**Refund & Return Policy**\nBoosting - Your order is eligible for a refund if:.](" . url('/') . ")";
                    }

                // end buyer_items

                if($message == 'buyer_boosting') {
                    $data = [
                        'items' => [
                            ['title' => '✖️ Seller has ruined my account'               , 'value' => 'buyer_ruined_account'],
                            ['title' => '✖️ Seller has taken items from my account'     , 'value' => 'buyer_taken_items'],
                            ['title' => '✖️ Seller did not complete my order in time'   , 'value' => 'buyer_not_complete'],
                            ['title' => '💲 Refund & Return Policy'                     , 'value' => 'buyer_boosting_refund'],
                            ['title' => '🌐 Other'                                      , 'value' => 'buyer_order_other'],
                        ],
                    ];
                }

                // buyer_boosting
                    if($message == 'buyer_ruined_account' || $message == 'buyer_taken_items' || $message == 'buyer_report_seller') {
                        $text = "Please fill out the ticket below to send a report to our team.";
                        $text1 = "I will be closing the chat, but don't worry, we will still receive your ticket.";
                        $text2 = "[**Create Ticket 🎫**\nUser Reports.](" . url('/') . ")";
                    }

                    if($message == 'buyer_not_complete' || $message == 'buyer_another_refund_dispute') {
                        $text = "It seems like you\'re having an issue that needs to be addressed by our dispute team. You will be redirected to them, since our general support is not able to investigate your issue.";
                        $text1 = "I will be closing the chat, but don't worry, we will still receive your ticket.";
                        $text2 = "[**Create Ticket 🎫**\nDispute Claim.](" . url('/') . ")";
                    }

                    if($message == 'buyer_boosting_refund') {
                        $text = "**Your order is eligible for a refund, if:**\n\n" .
                                    "📌 The seller has failed to fully deliver the order within guaranteed delivery time.\n" .
                                    "📌 The seller caused harm to the account (e.g., continuous promotions, loss of status such as OSRS Ironman, ruined stats like pure accounts, etc).\n" .
                                    "📌 The seller used/took valuable items from the account without your permission.*\n" .
                                    "📌 The seller changed the login details of your account without your permission.*\n" .
                                    "📌 The seller used third-party programs, leading to account restriction or banning.*\n\n" .
                                    "*In such cases, please report the seller to us immediately.";

                        $text1 = "**Your order is not eligible for a refund, if:**\n\n" .
                                    "📌 You purchased the order by mistake and it was delivered.\n" .
                                    "📌 Guaranteed delivery time has not passed.\n" .
                                    "📌 The seller was unable to proceed with the boost due to lack of access to the account or interruptions from outside actions.\n" .
                                    "📌 Evidence of incomplete delivery is shared on external platforms other than Gamify.\n" .
                                    "📌 The boost was not purchased on Gamify.\n";
                                    "📌 The account was banned/shadow banned due to your actions (i.e. botting, toxic behavior, contacting game developers, etc.).";

                        $text2 = "[**Refund & Return Policy**\nBoosting - Your order is eligible for a refund if:.](" . url('/') . ")";
                    }

                    if (in_array($message, ['buyer_order_other','buyer_account_purchase_raising_dispute',
                            'buyer_account_purchase_another_issue','buyer_payment_card_another_issue','buyer_payment_crypto_other'])) {
                        $text = "Please describe your issue to the best of your ability so I can transfer you to our team.";
                    }  
                // end buyer_boosting 

                if($message == 'buyer_account_purchase') {
                    $text = "If there are any issues with your order, we recommend contacting your seller first.\nIn any other case, we are here to help you!";
                    $text1 = "Please select one of the options below and I will transfer you to the correct team! ✔️";
                    $text2 = "Have you bought extended warranty or do you need help with an active dispute?";
                    $data = [
                        'items' => [
                            ['title' => '🛡️ I need help with my extended warranty'  , 'value' => 'buyer_account_purchase_warranty'],
                            ['title' => '✖️ I don\'t have extended warranty'        , 'value' => 'buyer_account_purchase_want_warranty'],
                            ['title' => '👥 I have an active dispute'               , 'value' => 'buyer_account_purchase_dispute'],
                            ['title' => '🌐 I need help raising a dispute'          , 'value' => 'buyer_account_purchase_raising_dispute'],
                            ['title' => '🌐 I have another issue'                   , 'value' => 'buyer_account_purchase_another_issue'],
                            ['title' => '💲 Refund & Return Policy'                  , 'value' => 'buyer_account_purchase_return'],
                        ],
                    ];
                }

                // buyer_account_purchase
                    if($message == 'buyer_not_complete') {
                        $text = "**Before submitting a ticket**, please review the following information to enable us to assist you more effectively:
                            
                            \n\n**Information and proof of your warranty claim should be provided in the warranty chat or in the order chat with your seller.**
                            \nIf our team lacks information about your warranty claim, they will contact you on the warranty claim chat.";
                        $text1 = "Please be sure to **contact the seller** about your issue first and if something goes wrong, we got your back!
                                    \n\nI will be closing this chat, but don't worry, you are still able to submit a ticket below!";
                        $text2 = "[**Create Ticket 🎫**\nWarranty Claim Ticket.](" . url('/') . ")";
                    }

                    if($message == 'buyer_account_purchase_dispute') {
                        $text = "Please note that if you **must have an active dispute claim** on your order for our team to be able to assist you.";
                        $text1 = "I will be closing the chat, but don't worry, we will still receive your ticket.";
                        $text2 = "[**Create Ticket 🎫**\nDispute Claim.](" . url('/') . ")";
                    }

                    if($message == 'buyer_boosting_refund') {
                        $text = "**Your order is eligible for a refund, if:**\n\n" .
                                    "📌 The account was compromised.\n" .
                                    "📌 The account was not delivered within the guaranteed delivery time.\n" .
                                    "📌 The login details are wrong.*\n" .
                                    "📌 The account is not full access (you were not provided email access and you are unable to change the email to yours).\n" .
                                    "📌 The account is not as described, and you have not made any alterations to it, which could render the account unsellable.\n\n" .
                                    "**In case of dispute about login details not working, we’ll make sure the issue is handled fairly. We allow the seller at least 12 hours to investigate and address the problem before taking further steps to resolve it.";

                        $text1 = "**Your order is _not_ eligible for a refund, if:**\n\n" .
                                    "📌 You purchased the order by mistake and it was delivered.\n" .
                                    "📌 You changed the login details of the account (applicable to claims that the account was \"not as described\").*\n" .
                                    "📌 You altered the account by playing on it or purchasing items for it.\n" .
                                    "📌 The account was banned/shadow banned due to your actions (i.e. botting, toxic behavior, contacting game developers, etc.).\n" .
                                    "📌 Evidence of the account being \"not as described\" or \"not working\" is shared on external platforms other than Gamify.\n";
                                    "📌 The account was not purchased on Gamify.";

                        $text2 = "*You may always **contact the seller** and agree on **returning the account** in exchange for a refund or partial refund if the account is not damaged and may be sold again.";

                        $text3 = "[**Refund & Return Policy**\nLearn about Gamify refund and return policy for accouts...](" . url('/') . ")";

                    }
                // end buyer_account_purchase

                if($message == 'buyer_recieve_purchase') {
                    $text = "Depending on the delivery method, your product can be delivered instantly or within guaranteed delivery time set by the seller.
                            \n\nTo receive your purchase:
                            \n\n1. Go to your orders page.
                            \n2. Select your purchase.
                            \n3. Contact your seller to receive instructions for delivery.
                            \n\n_👥 You can converse with the seller in the order page._";
                    $text1 = "If you have any issues with your purchase, chat with your seller first and if you are not able to solve your issue - contact us!";
                    $data = [
                        'items' => [
                            ['title' => '✔️ Close conversation'  , 'value' => 'close_conversation'],
                            ['title' => '🌐 Contact Support'     , 'value' => 'contact_support'],
                        ],
                    ];
                }

                if($message == 'buyer_warranty') {
                    $text = "If you purchased an extended warranty with your account, you can claim it for any issues that arise after the order is completed, for the duration of the warranty period.

                        \n\nTo claim your extended warranty, visit the [order page](" . url('orders/sold') . ") for your purchase and select the product for which you want to claim the warranty. The option should appear on the right side of the order page.";
                    $image_path = 'images';
                    $image = 'gamify_claim_warranty.png';
                }

                if($message == 'buyer_payment') {
                    $text = "What payment method are you using?";
                    $data = [
                        'items' => [
                            ['title' => '💳 I paid by card'                 , 'value' => 'buyer_payment_card'],
                            ['title' => '💱I paid with crypto currency'     , 'value' => 'buyer_payment_crypto'],
                            ['title' => '💲Other'                           , 'value' => 'buyer_payment_other'],
                        ],
                    ];
                }

                // buyer_payment
                    if($message == 'buyer_payment_card') {
                        $text = "📌Reminder
                                \nWe accept these card payment methods:
                                \n\n1. VISA
                                \n2. MasterCard
                                \n3. Maestro
                                \n4. American Express
                                \n5. DinersClub
                                \n6. Discover
                                \n7. JCB
                                \n8. UnionPay";

                        $text1 = "Here are some troubleshooting steps to try:
                                \n\n1. Check if you have 3DS enabled on your card.
                                \n2. Check if you have international payments enabled on your card.
                                \n3. Check if you have enough balance in your bank account to cover the order price and fees of your purchase.
                                \n4. Check if the card used is not a prepaid card.
                                \n\n**If all steps above did not fix your issue**,\n please try another card or payment method: ex. try Apple Pay if you tried to play directly with card.";
                        $data = [
                            'items' => [
                                ['title' => '🌐 I have another issue'   , 'value' => 'buyer_payment_card_another_issue'],
                                ['title' => '✔️ Close conversation'     , 'value' => 'close_conversation'],
                            ],
                        ];
                        
                    }

                    if($message == 'buyer_payment_crypto') {
                        $text = "What issue are you facing?";

                        $data = [
                            'items' => [
                                ['title' => '✖️ Payment did not come'       , 'value' => 'buyer_payment_crypto_payment'],
                                ['title' => '💲 Order is overpaid/underpaid' , 'value' => 'buyer_payment_crypto_overpaid'],
                                ['title' => '🌐 Other'                      , 'value' => 'buyer_payment_crypto_other'],
                                ['title' => '✔️ Close conversation'         , 'value' => 'close_conversation'],
                            ],
                        ];
                        
                    }

                        if($message == 'buyer_payment_crypto_payment') {
                            $text = "Cryptocurrency payments can sometimes take up to an hour to process. If your transaction gets stuck for over an hour, don't hesitate to reach out to us! We're here to help. 🙌";

                            $data = [
                                'items' => [
                                    ['title' => '✔️ Close conversation'  , 'value' => 'close_conversation'],
                                    ['title' => '🌐 Contact Support'     , 'value' => 'contact_support'],   
                                ],
                            ];
                            
                        }

                        if($message == 'buyer_payment_crypto_overpaid') {
                            $text = "**Underpayment**
                                    \n\nNo worries if you sent less crypto than required! Your payment might not go through, but don't stress. We'll give you a friendly heads-up with a message, asking you to cover the remaining balance to make everything work smoothly. We're here to make it easy for you!
                                    \n\n**Overpayment**
                                    \n\nIf you accidentally sent more crypto than required, no worries! Just provide us with a wallet address where you'd like the extra crypto to be returned. If, for any reason, you closed the window and didn't receive the excess amount, please reach out to Coingate support at support@coingate.com. Just include your email and wallet address, and we'll make sure to get your cryptocurrency back to you. We're here to assist!";
                            
                            $text1 = "If you need further assistance, our team is here to help you 🤝";

                            $data = [
                                'items' => [
                                    ['title' => '✔️ Close conversation'  , 'value' => 'close_conversation'],
                                    ['title' => '🌐 Contact Support'     , 'value' => 'contact_support'],   
                                ],
                            ];
                            
                        }
                // end buyer_payment

                if($message == 'buyer_reviewed') {
                    $text = "_**Account is under review:**_
                            \n\n1. This is a check-up for safety measures.
                            \n2. This does not require any action from you unless asked by our support team.
                            \n3. It will be completed within 15 minutes.
                            \n\nVerification required:
                            \n1. This requires you to complete the verification process [found here](" . url('seller-verification') . ").
                            \n2. Once submitted our team will review it within 15 minutes.";
                    $text1 = "[**Verification 🎫**\In some cases, you may be asked to verify your identity or...](" . url('/') . ")";
                    
                }

                if($message == 'buyer_confused') {
                    $text = "To find what you're looking for, we suggest:
                            \n\n1. Searching products by keywords.
                            \n2. Searching for a seller with more experience to ensure smooth transaction process!
                            \n3. Filter options by platform, server, price, etc.
                            \n\n\n**OR**
                            \n\nIf you are unable to find your game or certain product, please fill out the form and it will automatically be added to our suggestions!";
                    
                    $text1 = "[**Add Suggestions 🎫**](" . url('/') . ")";
                                    
                }

                if($message == 'buyer_security') {
                    $text = "Gamify reserves the money spent until the trade is confirmed by buyer.
                            \n\nBuyers may raise disputes if any issues arise with their products.
                            \n\Gamify support has access to product information and conversations, ensuring thorough investigation in case of issue.";
                    
                }

                if($message == 'buyer_dispute_info') {
                    $text = "When you raise a dispute, our team is promptly notified and begins checking the situation within 15 minutes.

                            \n\nIf seller is actively assisting the buyer with the dispute, the process may take up to 3 days to ensure a fair outcome.
                            
                            \n\nAdditionally, our team keeps track of any updates on your order, checking every 24 hours to provide timely assistance.🛡️";

                    $text1 = "[**Order Dispute Process 🎫**\nEstablishing direct communication can resolve many problems...](" . url('/') . ")";
                }
            // end buyer_order
            
            if($message == 'buyer_another') {
                $data = [
                    'items' => [
                        ['title' => '💲 Payment Troubleshooting'    , 'value' => 'buyer_payment'],
                        ['title' => '💲 Refund Request'             , 'value' => 'buyer_another_refund'],
                        ['title' => '🌍 Contact live support'       , 'value' => 'live_support'],
                        ['title' => '✔️ Close conversation'         , 'value' => 'close_conversation'],
                    ],
                ];
            }

            // buyer_another
                if($message == 'buyer_another_refund') {
                    $data = [
                        'items' => [
                            ['title' => '❌ My order was cancelled'                 , 'value' => 'buyer_another_refund_order_cancel'],
                            ['title' => '👥 I have a dispute on my order'           , 'value' => 'buyer_another_refund_dispute'],
                            ['title' => '💲 I have balance on my Gamify account'    , 'value' => 'buyer_another_refund_balance'],
                            ['title' => '👤 I don\'t want to verify myself'         , 'value' => 'buyer_another_refund_verify'],
                            ['title' => '💱 Crypto currency refund request'         , 'value' => 'buyer_another_refund_crypto_refund'],
                            ['title' => '✔️ Close conversation'                     , 'value' => 'close_conversation'],
                        ],
                    ];
                }

                    if($message == 'buyer_another_refund_order_cancel' || $message == 'buyer_another_refund_balance') {
                        $text = "You have the option to make another purchase on our website using your Gamify balance.

                                \n\nIf you still prefer to proceed with a refund, please confirm. We're here to help make the process as easy as possible for you! ✅";

                        $data = [
                            'items' => [
                                ['title' => '💲 I wish to proceed with a refund'   , 'value' => 'buyer_another_refund_order_cancel_confirm'],
                                ['title' => '✔️ Close conversation'               , 'value' => 'close_conversation'],
                            ],
                        ];
                    }

                        if($message == 'buyer_another_refund_order_cancel_confirm' || $message == 'buyer_another_refund_verify_other') {
                            $text = "You are now in line for help from our support team. Hang tight, and one of our agents will be with you soon.🙌";
                            $customer_support = 1;
                        }
                    
                    if($message == 'buyer_another_refund_verify') {
                        $text = "Could you please tell us the reason for the refund? Your feedback is vital in our ongoing efforts to enhance our services.";

                        $data = [
                            'items' => [
                                ['title' => '😐 The process is too difficult'           , 'value' => 'buyer_another_refund_verify_dificult'],
                                ['title' => '👤 I do not want to share my information'  , 'value' => 'buyer_another_refund_verify_info'],
                                ['title' => '📑 I do not have a suitable document'      , 'value' => 'buyer_another_refund_verify_document'],
                                ['title' => '📌 Other'                                  , 'value' => 'buyer_another_refund_verify_other'],
                                ['title' => '✔️ Close conversation'                     , 'value' => 'close_conversation'],
                            ],
                        ];
                    }

                        if($message == 'buyer_another_refund_verify_dificult') {
                            $text = 'We\'re here to help you with any issues that may come up, if you need assistance from our human colleagues, please confirm below ✅';

                            $data = [
                                'items' => [
                                    ['title' => '🌍 Contact support'       , 'value' => 'live_support'],
                                    ['title' => '✔️ Close conversation'         , 'value' => 'close_conversation'],
                                ],
                            ];
                        }

                        if($message == 'buyer_another_refund_verify_info') {
                            $text = "Absolutely, before I transfer you, here are some key points about our verification process:
                                    \n✅ We prioritize the security of your information with end-to-end encryption.
                                    \n✅ Your photos are deleted after 90 days, and verification is a one-time process for confirming your identity.
                                    \n✅ We've successfully verified many customers over our 5 years in operation, and your information's safety is our top concern.
                                    
                                    \n\nIf you still wish to proceed with your payment refund, please confirm below. Your satisfaction is important to us!";

                            $data = [
                                'items' => [
                                    ['title' => '💲 I wish to proceed with a refund'   , 'value' => 'buyer_another_refund_order_cancel_confirm'],
                                    ['title' => '✔️ Close conversation'               , 'value' => 'close_conversation'],
                                ],
                            ];
                        }

                        if($message == 'buyer_another_refund_verify_document') {
                            $text == "I'll transfer you to a colleague who can help sort this out. Please make sure to enter your information below. Let them know the type of document you have and the specific information it might be missing. They'll assist you further.";
                        }


                    if($message == 'buyer_another_refund_crypto_refund') {
                        $text == "Please click below to submit a ticket for your crypto currency refund request.

                                \n\n1. Enter your username.
                                \n2. Enter your Bitcoin wallet address.
                                \n📌Refunds are only done in BTC network. Enter Bitcoin wallet address.
                                \n[Can check address validation here.](https://awebanalysis.com/en/bitcoin-address-validate/#google_vignette)
                                \n📌Refunds are sent within 3 business days.
                                \n📌Minimum refund amount is 5 USD.";
                        $text1 = "[**Create Ticket 🎫**\nCrypto currency refund request.](" . url('/') . ")";
                    }
            // end buyer_another

        // end buyer

        if($message == 'seller') {
            $data = [
                'items' => [
                    ['title' => '💱 Withdrawal methods'                 , 'value' => 'seller_withdrawals'],
                    ['title' => '✔️ Order statuses'                     , 'value' => 'seller_order_statuses'],
                    ['title' => '🤔 How do I become a seller?'          , 'value' => 'seller_becoming'],
                    ['title' => '📜 Seller Rules'                       , 'value' => 'seller_rules'],
                    ['title' => '✔️ Verification'                       , 'value' => 'seller_verification'],
                    ['title' => '💲 I wish to refund completed orders'  , 'value' => 'seller_refund'],
                    ['title' => '💬 Live Support'                       , 'value' => 'live_support'],
                    ['title' => '❌ Close Conversation'                 , 'value' => 'close_conversation'],
                ],
            ];
        }

        // seller
            if($message == 'seller_withdrawals') {
                $text = "Please refer to the article below for the latest information about our withdrawals.";
                $text1 = "I will be closing the chat, but don't worry, we will still receive your ticket.";
                $text2 = "[**Seller Withdrawals 🎫**\nSellers can make withdrawals of their Gamify banalnce via...](" . url('/') . ")";
            }
            
            if($message == 'seller_order_statuses') {
                $text = "There are a total of 6 order statuses:
                        \n\n1. **Pending delivery:** Customer is awaiting seller's delivery.
                        \n\n2. **Order delivered:** Seller has delivered the product.
                        \n\n3. **Order disputed/order delivered and disputed:** Buyer has raised a dispute on their order, awaiting resolution from seller.
                        \n\n4. **Order canceled:** Order has been canceled by the seller or Gamify dispute team.
                        \n\n5. **Order received:** Customer has marked the order as received.
                        \n\n6. **Order completed:** The order is finished, and the seller has received payment.
                        \n\nStatus will be displayed on the order page.";
            }

            if($message == 'seller_becoming') {
                $text = "Please consult these articles for guidance on the category in which you intend to sell.";
                $text1 = "[**How to sell?**\nPrerequisites To start selling in Gamify you must first...](" . url('/') . ")";
                $text2 = "[**How to sell an account?**\nIn order to sell your in-game account, your Gamify account...](" . url('/') . ")";
                $text3 = "[**How to sell boosting services?**\nNote: In order to sell your boosting services, your Gamify...](" . url('/') . ")";
            }

            if($message == 'seller_rules') {
                $text = "Please refer to these articles for the latest information:";
                $text1 = "[**Seller Rules**\nSeller rules for existing offers will be applied on December...](" . url('/') . ")";
                $text2 = "[**Account Seller Rules**\nPrepare to sell accounts on Gamify by learning about the...](" . url('/') . ")";
            }

            if($message == 'seller_verification') {
                $text = "We recommend using your phone for the verification process.
                    \n\n1. Once in [verification page](" . url('seller-verification') . "), click on verification required.
                    
                    \n\n2. Then fill in the details as instructed.
                    
                    \n\n3. Next steps will include you uploading your identity documents and selfie holding the document.
                    
                    \n\n4. **Full name, date of birth, expiration date, photo and nationality** must be visible on your document.
                    
                    \n\n5. Once your verification is submitted, our team will review it within 15 minutes.";

                $text1 = "[**Seller Verification Guide**\nVerification is a vital aspect of our website - it is here to...](" . url('/') . ")";

                $data = [
                    'items' => [
                        ['title' => '❌ Close Conversation'         , 'value' => 'close_conversation'],
                        ['title' => '💬 Live Support'               , 'value' => 'live_support'],
                    ],
                ];
            }

            if($message == 'seller_refund') {
                $text = "To request a manual refund for your orders, please fill out the form below. Be sure to include the order IDs for all orders that need to be refunded.";
                $text1 = "I will close this conversation, but please be sure to submit your ticket below!";
                $text2 = "[**Create Ticket 🎫**\nSellers request](" . url('/') . ")";
            }
        // end seller

        if($message == 'live_support') {
            $text = "Let me connect you with one of our agents!";

            $customer_support = 1;
        }

        if($message == 'close_conversation') {
            $response = Http::withHeaders([
                'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
            ])->post("https://app.chatwoot.com/api/v1/accounts/126164/conversations/{$conversationId}/toggle_status", [
                'status' => 'resolved',
            ]);
        }

        if ($customer_support == 1) {
            $response = Http::withHeaders([
                'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
            ])->post("https://app.chatwoot.com/api/v1/accounts/126164/conversations/{$conversationId}/assignments", [
                'assignee_id' => 130189,
            ]);

        }

        $response = Http::withHeaders([
                'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
            ])->post("https://app.chatwoot.com/api/v1/accounts/126164/conversations/{$conversationId}/toggle_typing_status", [
                'typing_status' => 'off'
        ]); 
        
        if($text != null) {
            $response = Http::withHeaders([
                'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
            ])->post('https://app.chatwoot.com/api/v1/accounts/126164/conversations/'.$conversationId.'/messages', [
                'content_type' => 'text',
                'content' => $text,
            ]);
        }

        if($text1 != null) {
            $response = Http::withHeaders([
                'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
            ])->post('https://app.chatwoot.com/api/v1/accounts/126164/conversations/'.$conversationId.'/messages', [
                'content_type' => 'text',
                'content' => $text1,
            ]);
        }

        if($text2 != null) {
            $response = Http::withHeaders([
                'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
            ])->post('https://app.chatwoot.com/api/v1/accounts/126164/conversations/'.$conversationId.'/messages', [
                'content_type' => 'text',
                'content' => $text2,
            ]);
        }

        if($text3 != null) {
                $response = Http::withHeaders([
                    'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
                ])->post('https://app.chatwoot.com/api/v1/accounts/126164/conversations/'.$conversationId.'/messages', [
                'content_type' => 'text',
                'content' => $text3,
            ]);
        }

        if($image != null) {
            // 2. Send image attachment
            $response = Http::withHeaders([
                    'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
                ])
                ->attach('attachments[]', file_get_contents(public_path($image_path.'/'.$image)), $image)
                ->post('https://app.chatwoot.com/api/v1/accounts/126164/conversations/'.$conversationId.'/messages', [
                    'message_type' => 'outgoing',
                ]);
        }

        if($data != null) {
            $response = Http::withHeaders([
                'api_access_token' => 'szzJ4Yq1RpPsxxArmZ8eTsz1',
            ])->post('https://app.chatwoot.com/api/v1/accounts/126164/conversations/'.$conversationId.'/messages', [
                'content_type' => 'input_select',
                'content' => 'Select one of the items below',
                'content_attributes' => $data,
            ]);
        }
    }
}

