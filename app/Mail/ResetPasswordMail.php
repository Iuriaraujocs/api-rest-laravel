<?php

/**  author: Iuri Cardoso Araujo
 *   email: iuriaraujoc.eng@gmail.com
 *   
 * 
 * This class still not being used. 
 * Currently, the reset password email is reused from the laravel / ui --auth package
 * */

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        // $this->user = 
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.user-reset-password');
    }
}
