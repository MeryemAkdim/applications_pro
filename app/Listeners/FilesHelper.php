<?php

namespace App\Listeners;

use App\Events\FileUploaded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class FilesHelper
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
     * @param  \App\Events\FileUploaded  $event
     * @return void
     */
    public function handle(FileUploaded $event)
    {
        $file = $event->file;
        $destination = $event->destination;

        if ($file) 
        {
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = $file->getClientOriginalExtension();
            $filenametostore = $filename . '_' . time() . '.' . $extension; // Unique filename

            $filenametostore = str_replace(' ', '', $filenametostore);  // Remove spaces
            $path = $file->storePubliclyAs($destination, $filenametostore);

            return $path; // Return the path after successful upload
        }

        return null;
    }
}   
