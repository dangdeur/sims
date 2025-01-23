<?php

namespace App\Controllers;

use Config\Services;
// use App\Models\PenggunaModel;
use App\Models\KeterlambatanModel;
// use App\Models\StafModel;
//$encrypter = service('encrypter');


class Piket extends BaseController
{
  protected $helpers = ['form', 'text', 'cookie', 'html','session'];

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
    $session=session();
    $model = new KeterlambatanModel();
    $tanggal = date("dmY");
    $kode = $nis . "-" . $tanggal;
    $data = array(
      'kode_keterlambatan' => $kode,
      'nis' => $nis,
      'jp' => 'jp',
      
    );
    d($data);
    $_SESSION['nis']=$nis;
    $session->setFlashdata('nis');
    $model->save($data, false);
    return redirect()->to('/form_terlambat');
  }
}
