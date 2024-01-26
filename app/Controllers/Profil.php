<?php

namespace App\Controllers;
use Config\Services;
use App\Models\PenggunaModel;

class Profil extends BaseController
{
  protected $helpers = ['form','text','cookie'];
    public function index()
    {
      //$session=session();
      $data = $this->session->get();

      return view('profil',$data);
    }

    // public function siapaLogin($peran)
    // {
    //
    //   if ($Pengguna['jenis_user']==1)
    //   {
    //     $login='guru';
    //   }
    //   elseif ($pengguna['jenis_user']==2) {
    //     $login='bpbk';
    //   }
    //   elseif ($pengguna['jenis_user']==3) {
    //     $login='walikelas';
    //   }
    //   elseif ($pengguna['jenis_user']==4) {
    //   $login='kepsek';
    //   }
    //   elseif ($pengguna['jenis_user']==5) {
    //     $login='admin';
    //   }
    //   elseif ($pengguna['jenis_user']==10) {
    //     $login='superadmin';
    //   }
    //   else {
    //     $login='siswa';
    //   }
    //   return $login;
    //
    // }



}
