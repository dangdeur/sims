<?php

namespace App\Controllers;

use Config\Services;
use App\Models\PeminjamanModel;
use CodeIgniter\I18n\Time;
use App\Models\SiswaModel;
use App\Models\StafModel;
use SebastianBergmann\Type\FalseType;

class Peminjaman extends BaseController
{
    protected $helpers = ['form', 'text', 'cookie'];
    protected $pbm = array();

    public function sesi()
    {
        global $data;
        if (isset($_SESSION['kode_pengguna'])) {
            $data = session()->get();
        } else {
            return redirect()->to('/logout');
        }
    }


}
