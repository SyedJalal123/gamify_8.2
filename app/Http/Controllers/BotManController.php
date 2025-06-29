<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use BotMan\BotMan\BotMan;
use App\BotMan\Conversations\SupportConversation;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;

class BotManController extends Controller
{
    public function handle(Request $request)
    {
        $botman = app('botman');

        $botman->hears('/start', function (BotMan $bot) {
            $bot->startConversation(new SupportConversation);
        });

        // $botman->listen();


        // Show the start button
        $botman->hears('/init', function (BotMan $bot) {
            $question = Question::create("👋 Hi! Please click the button below to begin:")
                ->addButtons([
                    Button::create('Start Conversation')->value('/start'),
                ]);

            $bot->reply($question);
        });

        $botman->listen();
    }
}