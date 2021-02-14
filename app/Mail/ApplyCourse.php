<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyCourse extends Mailable
{
    use Queueable, SerializesModels;

    public $emailFormat;

    /**
     * Create a new message instance.
     *
     * @param array $emailFormat
     */
    public function __construct(array $emailFormat)
    {
        $this->emailFormat = $emailFormat;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('email.courses.apply', [
            'url' => $this->emailFormat['url']
        ])->subject('Incripción a curso')->from(['pvdlabs@admin.com', 'Administración']);
    }
}
