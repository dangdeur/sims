<?php

namespace App\Controllers;

use Config\Services;

use App\Models\PbmModel;
use App\Models\SiswaModel;
use App\Models\VotingModel;
use CodeIgniter\I18n\Time;


// class Agenda extends BaseController
class Gupres extends Pbm
{
  protected $helpers = ['form', 'text', 'cookie', 'date'];
  protected $pbm;

  protected $session;

  public function __construct()
  {
    $this->pbm = new Pbm();
    //global $session;
    $session = session();
  }


  public function index()
  {

    $data = session()->get();

    $kode_kelas = $this->pbm->kode_kelas($data['rombel']);

    $data['guru'] = $this->cariGuru($kode_kelas);
    // $data['kode_kelas'] = $kode_kelas;
    //session()->set('kode_kelas', $kode_kelas);


    return view('header')
      . view('menusiswa', $data)
      . view('form_voting')
      . view('footer');

  }

  public function gupresedit()
  {

    $data = session()->get();

    $votingmodel = new VotingModel();
    $data['datavoting'] = $votingmodel->where('kode_voting', $data['nis'] . "-" . $data['kode_kelas'])->first();
    //  dd($data); 
    $data['guru'] = $this->cariGuru($data['kode_kelas']);
    $data['voting_sebelumnya'] = json_decode($data['datavoting']['data_voting'], true);
    // d($data['voting_sebelumnya'][$data['nis']]);
    //session()->set('kode_kelas', $kode_kelas);


    return view('header')
      . view('menusiswa', $data)
      . view('form_voting_edit')
      . view('footer');

  }

  public function gupreshapus()
  {

    $data = session()->get();
    $votingmodel = new VotingModel();
    $votingmodel->where('kode_voting', $data['nis'] . "-" . $data['kode_kelas'])->delete();

   return redirect()->to('/infosiswa');

  }

  public function cariGuru($kelas)
  {

    $sql = "SELECT `kode_guru`,`nama_guru`,`mapel_guru` FROM jadwal WHERE " . $kelas . " IN (`10`,`11`,`12`,`13`,`14`,`15`,`16`,`17`,`18`,`19`,`20`,`21`,`22`,`23`,`24`,`25`,`26`,`27`,`28`,`29`,`30`,`31`,`32`,`33`,`34`,`35`,`36`,`37`,`38`,`39`,`40`,`41`,`42`,`43`,`44`,`45`,`46`,`47`,`48`,`49`,`50`,`51`,`52`,`53`,`54`,`55`,`56`);";
    $db = db_connect();
    return $query = $db->query($sql)->getResultArray();
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

  public function simpanvoting()
  {
    $data = session()->get();
    $votingmodel = new VotingModel();
    $data['datavoting'] = $this->request->getPost();
    // d($data);
    $voting = array();
    // $no_urut = 1;
    for ($a = 1; $a <= $data['datavoting']['jumlah_guru']; $a++) {
      if (!empty($data['datavoting']['nilai' . $a])) {
        $voting[$data['nis']][] = ['id_voting' => $data['nis'] . '-' . $data['kode_kelas'], 
                                  'kode_guru' => $this->request->getPost('kode_guru' . $a),
                                  'mapel' => $this->request->getPost('mapel' . $a),
                                  'nilai' => $this->request->getPost('nilai' . $a)];
      }
    }
    //$data['tess']=$presensi->getLastQuery();
// d($voting);
    $votingdb = json_encode($voting);
    $datadb = [
      'kode_voting' => $data['nis'] . '-' . $data['kode_kelas'],
      'data_voting' => $votingdb,
      'waktu_voting' => Time::now(),
      'status' => 0,
    ];

    //  d($votingdb);
    // echo $dbvoting;
    //$data['update']['nilai'] = $data['datavoting'];
    $votingmodel->save($datadb);
    //dd($data);
    //$votingmodel->update($data['datapvoting']['id_agendaguru'], $data['update']);
    //$data['waktu']=$this->waktu();
    return redirect()->to('/infosiswa');
  }

  // public function cekVoting()
  // {
  //   $data = session()->get();
  //   $votingmodel = new VotingModel();
  //   $ada = $votingmodel->where('kode_voting', $data['nis'] . "-" . $data['kode_kelas'])->first();
  //   if ($ada) {
  //     $pesan = 'Anda sudah melakukan voting';
  //   }
  //   return $pesan;
  // }
}
