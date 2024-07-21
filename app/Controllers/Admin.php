<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use App\Models\AgendaGuruModel;
use App\Models\PbmModel;
use App\Models\SiswaModel;

class Admin extends BaseController
{
    public function Isitgldibuat()
    {
        $agendamodel = new AgendaGuruModel();
        $agenda = $agendamodel->where('dibuat', '')->findAll();
        dd($agenda);
    }
}
