<?php

namespace App\Http\Controllers;

use App\Services\NotificationService;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\Messages\Incoming\Answer;
use Illuminate\Http\Request;
use App\Conversations\FeedbackConversation;

class ChatController extends Controller
{
    protected $notificationService;

    public function __construct(NotificationService $notificationService)
    {
           $this->notificationService = $notificationService;
    }
    
    public function handle()
    {
        $botman = app('botman');

        $botman->hears('feedback', function (BotMan $bot) {
            $bot->startConversation(new FeedbackConversation($this->notificationService));
        });

        $botman->listen();
    }
}
