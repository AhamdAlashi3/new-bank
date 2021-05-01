<?php

namespace App\Mail;

use App\Models\Merchant;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

// implements ShouldQueue
class NewAdminWelcomEmail extends Mailable
{
    use Queueable, SerializesModels;
    public Merchant $merchant;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Merchant $merchant)
    {
        //
       $this->merchant= $merchant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('support@car-system.com')
        ->subject('Welcome in Car-System')
        ->cc('aalashi8@smail.ucas.edu.ps')
        ->markdown('email.new_admin_email');
    }
}