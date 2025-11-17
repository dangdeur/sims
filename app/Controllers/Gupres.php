<?php

namespace App\Controllers;

use Config\Services;
use App\Models\AgendaGuruModel;
use App\Models\PbmModel;
use App\Models\SiswaModel;
use App\Models\KeterlambatanModel;
use CodeIgniter\I18n\Time;


// class Agenda extends BaseController
class AgendaGuru extends Pbm
{
  protected $helpers = ['form', 'text', 'cookie', 'date'];
  protected $pbm;

  protected $session;

  public function __construct()
  {
    $this->pbm = new Pbm();
  }


  public function index()
  {
    global $data;
    $this->sesi();

    $agendamodel = new AgendaGuruModel();
    $data['agenda'] = $agendamodel->where('kode_guru', $data['kode_pengguna'])->orderBy('dibuat', 'DESC')->paginate(10);

    $data['pager'] = $agendamodel->pager;

    $jadwal = $this->pbm->jadwal_data();

    $data['rombel'] = $this->rombel_jadwal($jadwal);
    $data['mapel'] = $this->mapel_jadwal($jadwal);


    return view('header')
      . view('menu', $data)
      . view('daftaragenda')
      . view('footer');
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
}
