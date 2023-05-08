<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendUserNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  QuoteCreated  $event
     * @return void
     */
    public function handle(QuoteCreated $event)
    {
        $id = $event->id;
        $type = $event->type;
        $breed = $event->breed;
        $name = $event->name;
        $gender = $event->gender;
        $age = $event->age;
        $date_rescued = $event->date_rescued;
        $place_rescued = $event->place_rescued;
        $email = 'jameschristian.villamin@tup.edu.ph';
        Mail::send(
            'email',
            ['id'=>$id, 'type'=>$type, 'breed'=>$breed, 'name'=>$name, 'gender'=>$gender, 'age'=>$age, 'date_rescued'=>$date_rescued, 'place_rescued'=>$place_rescued],
            function($message) use($email) {
                $message->from('admin@test.com','Admin');
                $message->to($email, '...');
                $message->subject('New Animal Rescued!');
            }
        );
    }
}
