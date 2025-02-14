<?php

namespace App\Http\Controllers;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Http\Request;
use App\Conversations\FeedbackConversation;

class ChatController extends Controller
{
    public function handle(Request $request)
    {
        $botman = app('botman');

        $botman->hears('feedback', function (BotMan $bot) {
            $bot->startConversation(new FeedbackConversation());
        });

        $botman->listen();
    }
}
