<?php

namespace App\Controllers;

use Config\Services;
use App\Models\UpacaraModel;
use App\Models\HarianModel;
use App\Models\PresensiStafModel;
use Tatter\Pushover\Entities\Message;



class Push extends BaseController
{
    protected $helpers = ['form', 'text', 'cookie', 'date'];
    protected $session;

    public function pesan()
    {
    $pushover = service('pushover');
	
    $message = $pushover->message(['message' => 'Hellow world']);
    $message->send();
    }

}
