<?php

namespace App\Controllers;

use Config\Services;
// use App\Models\PenggunaModel;
use App\Models\KeterlambatanModel;
// use App\Models\StafModel;
//$encrypter = service('encrypter');


class Piket extends BaseController
{
  protected $helpers = ['form', 'text', 'cookie', 'html'];

  public function sesi()
  {
    global $data;
    if (isset($_SESSION['kode_pengguna'])) {
      $data = session()->get();
    } else {
      return redirect()->to('/logout');
    }
  }

  public function index()
  {
    
  }

  public function simpan_tl($nis)
  {
    $this->sesi();
    $model = new KeterlambatanModel();
    $tanggal = date("dmY");
    $kode = $nis . "-" . $tanggal;
    $data = array(
      'kode' => $kode,
      'nis' => $nis,
      'jp' => 'jp',
      
    );
    //dd($data);
    $model->insert($data, false);
    return redirect()->to('/form_terlambat');
  }
}
