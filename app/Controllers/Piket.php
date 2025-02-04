<?php

namespace App\Controllers;

use Config\Services;
use App\Models\PiketModel;
use App\Models\PbmModel;
use App\Models\KeterlambatanModel;
use App\Models\SiswaModel;
//$encrypter = service('encrypter');


class Piket extends Pbm
{
  protected $helpers = ['form', 'text', 'cookie', 'html', 'session'];
  protected $db;
  protected $data;
  protected $pbm;

  public function __construct()
  {
    $this->db = \Config\Database::connect();
    $this->pbm = new Pbm();
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
    global $data;
    $this->sesi();
    //d($data);
   

     
    
   

    return view('header')
      . view('menu', $data)
      . view('daftaragendapiket')
     
      . view('footer');
  }

  public function lapor()
  {
    global $data;
    $this->sesi();

    //46 untuk jam 12 ke atas
    $data['jam_sekarang'] = date("N") . $this->pbm->jam_ke();
    if (date("N") !=6 || date("N") !=7)
    {
    $jam_ke=substr($data['jam_sekarang'], -1, 1);
    $jam_ke=$jam_ke+1;
    $data['jam_ke']=JP[date("N")][$jam_ke];
   
    }
    else {
      $data['jam_ke']="";
    }
    
    switch ($data['jam_ke']) {
      case "":
        $h = 'Senin';
        break;
      case 2:
        $h = 'Selasa';
        break;
      case 3:
        $h = 'Rabu';
        break;
      case 4:
        $h = 'Kamis';
        break;
      case 5:
        $h = 'Jumat';
        break;
      case 6:
        $h = 'Sabtu';
        break;
      case 7:
        $h = 'Minggu';
        break;
    }

    $data['kode_hari'] = date("N");
    
   
    
    // if (isset($data['jadwal'][$h]))
    // {
    //   $jadwal_hari_ini = $data['jadwal'][$h];
    
    

    // foreach ($jadwal_hari_ini as $jam => $kelas) {

    //   if (!isset($durasi[$kelas['kelas']][$jam])) {
    //     $durasi[$jam] = ['rombel' => $kelas['kelas'], 'mapel' => $kelas['mapel']];
        
    //     $jpnya[]=$jam;
    //   } 
    // }
    // $data['info'] = $durasi;
    // $data['jp0']=reset($jpnya);
    // $jam_0=substr($data['jp0'], -1, 1);
    // $jam_0=$jam_0+1;
    // $data['jp1']=end($jpnya);
    // $jam_1=substr($data['jp1'], -1, 1);
    // $jam_1=$jam_1+1;
    // $data['jp0']=$jam_0;
    // $data['jp1']=$jam_1;
    // }
    
    // if ($this->request->is('post')) {

    //   $model = new AgendaGuruModel();
     
    //   $data['kode_guru'] = $data['kode_pengguna'];
    //   $data['rombel'] = $this->request->getPost('rombel');
    //   $data['mapel'] = $this->request->getPost('mapel');
    //   $data['lokasi'] = $this->request->getPost('lokasi');
    //    $data['jp0'] = $data['jp0'];
    //    $data['jp1'] = $data['jp1'];
    //   $data['tapel'] = TAPEL;
    //   $data['semester'] = 2;
    //   $data['tanggal'] = date("Y-m-d");
    //   $data['waktu'] = date("H:i:s");
    //   $data['kode_agendaguru'] = $data['kode_guru'] . "-" . date("dmY") . "-" . $data['rombel'];

    //   $model->insert($data, false);
    //   return redirect()->to('/agendaguru');
    // } else {
      

    //   $data['rombel'] = $this->rombel_jadwal($data['jadwal']);
    //   $data['mapel'] = $this->mapel_jadwal($data['jadwal']);
     
    d($data);
    return view('header')
        . view('menu', $data)
        . view('form_laporpiket')
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
