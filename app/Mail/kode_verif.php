<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class kode_verif extends Mailable
{
    use Queueable, SerializesModels;
    public $user;
    public function __construct($user)
    {
        //
        $this->user = $user;
    }

    public function build(Request $request)
    {
        $user = $this->user;
        return $this->view('mail.kode_verif', compact('user'));
    }
}
