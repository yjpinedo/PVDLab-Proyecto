<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ApplyCourseBeneficiary extends Mailable
{
    use Queueable, SerializesModels;

    public $emailFormat;

    /**
     * Create a new message instance.
     *
     * @param $emailFormat
     */
    public function __construct($emailFormat)
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
        return $this->markdown('email.courses.apply-course-beneficiary', [
            'url' => $this->emailFormat['urlBeneficiary']
        ])->subject('Información de cursos - PVDLABS')->from(['pvdlabs@admin.com', 'Administración']);
    }
}
