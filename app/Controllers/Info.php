<?php

namespace App\Controllers;

use Config\Services;
use App\Models\InfoModel;
use App\Models\StafModel;
use App\Models\UpacaraModel;
use App\Models\HarianModel;
use App\Models\PiketModel;
use App\Models\KegiatanModel;
use App\Models\VotingModel;


class Info extends Pbm
{
  protected $helpers = ['form', 'text', 'cookie', 'html'];

  protected $session;

  protected $pbm;

  public function __construct()
  {
    $session = session();
    $this->pbm = new Pbm();

  }


  public function sesi()
  {
    global $data;
    if (isset($_SESSION['kode_pengguna'])) {
      //  if (session()->has('kode_pengguna')) {
      $data = session()->get();
    } else {
      return redirect()->to('/logout');
    }
  }

  public function index()
  {
    $data = session()->get();
    $model = new InfoModel;
    //paginasi
    $data['info'] = $model->select('*')->orderBy('tanggal', 'DESC')->paginate(10);
    $data['pager'] = $model->pager;

    $kegiatanmodel = new KegiatanModel();
    $data['kegiatan'] = $kegiatanmodel->where('status', '1')->first();

    // d($data);

    return view('header')
      . view('menu', $data)
      . view('info')
      . view('footer');
  }

  public function siswa()
  {
    //global $data;
    $data = session()->get();

    $stafmodel = new StafModel();
    $datastaf = $stafmodel->select('kode_staf, nama,nama_gelar')->findAll();
    foreach ($datastaf as $staf) {
      $data['staf'][$staf['kode_staf']] = ['nama'=>$staf['nama'],'nama_gelar'=>$staf['nama_gelar']];
    }

    $pesan = $this->cekVoting();
    //  d($pesan);
    if ($pesan) {
      $dataarr = json_decode($pesan['data_voting'], true);
      // d($dataarr);
      $data['voting'] = $dataarr[$data['nis']];
    } else {
      $data['voting'] = FALSE;
    }

    // d($data);
    return view('header')
      . view('menusiswa', $data)
      . view('infosiswa')
      . view('footer');
  }


  public function profil()
  {
    global $data;
    $this->sesi();
    $stafmodel = new StafModel();
    $data['detail'] = $stafmodel->where('kode_staf', $data['kode_pengguna'])->first();
    // d($data);
    return view('header')
      . view('menu', $data)
      . view('profil')
      . view('footer');
  }

  public function rekap_upacara()
  {
    global $data;
    $this->sesi();
    $upacaramodel = new UpacaraModel();
    $data['absen'] = $upacaramodel->where(['kode_absen' => $data['kode_absen']])->orderBy('waktu', 'DESC')->paginate(20);
    $data['pager'] = $upacaramodel->pager;

    return view('header')
      . view('menu', $data)
      . view('rekap_upacara')
      . view('footer');
  }

  public function rekap_harian()
  {
    $data = session()->get();
    $model = new HarianModel();
    $data['kehadiran'] = $model->where(['kode_absen' => $data['kode_absen']])->orderBy('waktu', 'DESC')->paginate(20);
    $data['pager'] = $model->pager;
    return view('header')
      . view('menu', $data)
      . view('rekap_harian')
      . view('footer');
  }

  public function cekVoting()
  {
    $data = session()->get();
    // $kode_kelas = $this->pbm->kode_kelas($data['rombel']);
    $kode_kelas =$data['kode_kelas'];
    $votingmodel = new VotingModel();
    $ada = $votingmodel->where('kode_voting', $data['nis'] . "-" . $kode_kelas)->first();
    if ($ada) {
      //$pesan = TRUE;
      $data['voting'] = $ada;
    } else {
      $data['voting'] = FALSE;
    }
    return $data['voting'];
  }
}
