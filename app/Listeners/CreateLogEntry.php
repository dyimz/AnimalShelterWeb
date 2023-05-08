<?php

namespace App\Listeners;

use App\Events\QuoteCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\AnimalLog;

class CreateLogEntry
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
        $animal_id = $event->id;
        $log_entry = new AnimalLog();
        $log_entry->animal_id = $animal_id;
        $log_entry->save();
    }
}
