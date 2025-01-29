<?php

namespace App\Controllers;

use Config\Services;
// use App\Models\PenggunaModel;
use App\Models\KeterlambatanModel;
use App\Models\SiswaModel;
//$encrypter = service('encrypter');


class Piket extends BaseController
{
  protected $helpers = ['form', 'text', 'cookie', 'html', 'session'];
  protected $db;

  public function __construct()
  {
    $this->db = \Config\Database::connect();
  }


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

  public function form_terlambat()
  {
    //$data = session()->get();
    global $data;
    $this->sesi();
    //dd($data);

    $siswa = new SiswaModel();

    $siswa->distinct()->select('rombel')->orderBy('rombel', 'ASC');

    $data['rombel'] = $siswa->get()->getResultArray();
    // d($data);


    return view('header')
      . view('menu', $data)
      . view('form_terlambat')
      . view('footer');


  }

  public function tampil_siswa($rombel = false)
  {

    if ($rombel != '') {
      // $siswa = new SiswaModel();
      // $data['nama_siswa'] = $siswa->where(['rombel' => $rombel])->join('keterlambatan','keterlambatan.nis=siswa.nis')->findAll();

      $db = \Config\Database::connect();
      $builder = $db->table('siswa');
      $builder->select('siswa.*');
      $builder->where('siswa.rombel', $rombel);
      $builder->join('keterlambatan', 'siswa.nis=keterlambatan.nis','right');
      
      //$data=array();
      //$query = $builder->get();
      $query = $builder->get()->getResultArray();
      // foreach ($query->getRow() as $key => $value) {
      //   $data[]=[$key=>$value];
      //   }

      //echo json_encode($data['nama_siswa']);
      echo json_encode($query);
    } else {
      echo 'rombel =' . $rombel;
      //echo json_encode($data['rombel']=$rombel);
    }

  }

  public function simpan_tl($nis)
  {
    $this->sesi();
    $session = session();
    $model = new KeterlambatanModel();
    $tanggal = date("dmY");
    $kode = $nis . "-" . $tanggal;
    $data = array(
      'kode_keterlambatan' => $kode,
      'nis' => $nis,
      'jp' => 'jp',

    );
    d($data);
    $_SESSION['nis'] = $nis;
    $session->setFlashdata('nis');
    $model->save($data, false);
    return redirect()->to('/form_terlambat');
  }
}
