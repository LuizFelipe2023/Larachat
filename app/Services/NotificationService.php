<?php

namespace App\Services;

use App\Models\Suporte;
use App\Models\User;
use App\Models\Feedback;
use App\Notifications\RecebeFeedback;
use App\Notifications\RecebeSuporte;

class NotificationService
{
    public function sendNotificationFeedback($id)
    {
        $users = User::all();
        $feedback = Feedback::findOrFail($id);

        foreach ($users as $user) {
            $user->notify(new RecebeFeedback($feedback));
        }
    }

    public function sendNotificationSuporte($id)
    {
           $users = User::all();
           $suporte = Suporte::findOrFail($id);

           foreach($users as $user){
                  $user->notify(new RecebeSuporte($suporte));
           }
    }
}
