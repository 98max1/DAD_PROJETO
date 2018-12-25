<?php

namespace App\Mail;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;
    
    public $token;
    public $email;

    public function __construct($token,$email)
    {
    	$this->token=$token;
    	$this->email=$email;
    }

    public function build()
    {
        return $this->markdown('Welcome')/*->with([
        	'token'=>$this->token,
        	'email'=>$this->email
        	])*/;
    }
}