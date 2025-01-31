<?php

namespace App\Controllers;

use Config\Services;
use App\Models\AgendaGuruModel;
use App\Models\PbmModel;
use App\Models\SiswaModel;
use App\Models\KeterlambatanModel;


// class Agenda extends BaseController
class AgendaGuru extends Pbm
{
  protected $helpers = ['form', 'text', 'cookie', 'date'];
  protected $pbm;
  //public $data;
  protected $session;

  public function __construct()
  {
    $this->pbm = new Pbm();

    //$data = session()->get();

  }


  public function index()
  {
    global $data;
    $this->sesi();
    //dd($this->data);
    $agendamodel = new AgendaGuruModel();
    $data['agenda'] = $agendamodel->where('kode_guru', $data['kode_pengguna'])->orderBy('dibuat', 'DESC')->paginate(10);


    // $data['agenda'] = $agendamodel->where('kode_guru', $data['kode_pengguna'])->findAll();


    $data['pager'] = $agendamodel->pager;

    $jadwal = $this->pbm->jadwal_data();
    // d($jadwal);
    // senin =>
    //         10 =>
    //               kelas =>
    //               mapel =>
    $data['rombel'] = $this->rombel_jadwal($jadwal);
    $data['mapel'] = $this->mapel_jadwal($jadwal);



    //d($data);

    return view('header')
      . view('menu', $data)
      . view('daftaragenda')
      //  .view('paginasi')
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

  public function baru($id)
  {
    //$data = session()->get();
    global $data;
    $this->sesi();
    $agendamodel = new AgendaGuruModel();
    $data['agenda'] = $agendamodel->where('id_agendaguru', $id)->first();
    //d($data);
    if ($this->request->is('get')) {
      $data['form'] = 1;
      return view('header')
        . view('menu', $data)
        . view('agendagurubaru')
        . view('footer');
    }

    //if ($this->request->is('post')) 
    else {
      $rules = [
        //'rombel_agenda' => 'required',
        'jp0' => 'required',
        'jp1' => 'required',
        //'mapel_agenda' => 'required',
        'materi' => 'required'
      ];

      $errors = [
        //'rombel_agenda' => ['required' =>'Rombel belum dipilih'],
        'jp0' => ['required' => 'Jam pelajaran awal belum dipilih'],
        'jp1' => ['required' => 'Jam pelajaran akhir belum dipilih'],
        //'mapel_agenda' => ['required' => 'Mapel belum dipilih'],
        'materi' => ['required' => 'Materi belum dipilih']
      ];

      if (! $this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
        //$data['form']=1;
        //return view('agendagurubaru',$data);
        //d($data); 
        return redirect()->back()->withInput();
      } else {

        $model = new AgendaGuruModel();
        // $guru = $this->request->getPost('kode_guru');
        // $rombel = $this->request->getPost('rombel_agenda');
        // $tgl = $this->request->getPost('tanggal');
        // $bln = $this->request->getPost('bulan');
        // $thn = date("Y");
        //$tanggal=date("dmY");
        // $tanggal=$tgl.$bln.$thn;
        // $kode_agenda=$guru."-".$tanggal."-".$rombel;
        $data = array(
          //'rombel' => $rombel,
          'jp0' => $this->request->getPost('jp0'),
          'jp1' => $this->request->getPost('jp1'),
          // 'mapel' => $this->request->getPost('mapel_agenda'),
          'materi' => $this->request->getPost('materi'),
          //'kode_agendaguru' => $kode_agenda,
          // 'kode_guru' => $guru,
          'status' => 1,
        );
        //$model->insert($data,false);
        $model->update($id, $data);
        return redirect()->to('/agendaguru');
      }
    } // end post  
    // return view('header')
    // .view('menu',$data)
    // .view('agendagurubaru')
    // .view('footer');
    //d($data);

  }

  public function _baru()
  {
    $data = session()->get();
    $data['waktu'] = $this->waktu();
    $jadwal = $this->pbm->jadwal_data();
    //d($jadwal);
    $data['rombel'] = $this->rombel_jadwal($jadwal);
    $data['mapel'] = $this->mapel_jadwal($jadwal);
    if ($this->request->is('get')) {
      $data['form'] = 1;
      return view('header')
        . view('menu', $data)
        . view('agendagurubaru')
        . view('footer');
    }

    //if ($this->request->is('post')) 
    else {
      $rules = [
        'rombel_agenda' => 'required',
        'jp0' => 'required',
        'jp1' => 'required',
        'mapel_agenda' => 'required',
        'materi' => 'required'
      ];

      $errors = [
        'rombel_agenda' => ['required' => 'Rombel belum dipilih'],
        'jp0' => ['required' => 'Jam pelajaran awal belum dipilih'],
        'jp1' => ['required' => 'Jam pelajaran akhir belum dipilih'],
        'mapel_agenda' => ['required' => 'Mapel belum dipilih'],
        'materi' => ['required' => 'Materi belum dipilih']
      ];

      if (! $this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
        //$data['form']=1;
        //return view('agendagurubaru',$data);
        //d($data); 
        return redirect()->back()->withInput();
      } else {

        $model = new AgendaGuruModel();
        $guru = $this->request->getPost('kode_guru');
        $rombel = $this->request->getPost('rombel_agenda');
        $tgl = $this->request->getPost('tanggal');
        $bln = $this->request->getPost('bulan');
        $thn = date("Y");
        //$tanggal=date("dmY");
        $tanggal = $tgl . $bln . $thn;
        $kode_agenda = $guru . "-" . $tanggal . "-" . $rombel;
        $data = array(
          'rombel' => $rombel,
          'jp0' => $this->request->getPost('jp0'),
          'jp1' => $this->request->getPost('jp1'),
          'mapel' => $this->request->getPost('mapel_agenda'),
          'materi' => $this->request->getPost('materi'),
          'kode_agendaguru' => $kode_agenda,
          'kode_guru' => $guru,
        );
        $model->insert($data, false);
        return redirect()->to('/agendaguru');
      }
    } // end post  
    // return view('header')
    // .view('menu',$data)
    // .view('agendagurubaru')
    // .view('footer');
    //d($data);

  }

  public function baru_telat()
  {
    //$data = session()->get();
    global $data;
    $this->sesi();
    $data['waktu'] = $this->waktu();
    $jadwal = $this->pbm->jadwal_data();
    //d($jadwal);
    $data['rombel'] = $this->rombel_jadwal($jadwal);
    $data['mapel'] = $this->mapel_jadwal($jadwal);
    if ($this->request->is('get')) {
      $data['form'] = 1;
      return view('header')
        . view('menu', $data)
        . view('agendagurubaru_telat')
        . view('footer');
    }

    //if ($this->request->is('post')) 
    else {
      $rules = [
        'rombel_agenda' => 'required',
        'jp0' => 'required',
        'jp1' => 'required',
        'mapel_agenda' => 'required',
        'materi' => 'required'
      ];

      $errors = [
        'rombel_agenda' => ['required' => 'Rombel belum dipilih'],
        'jp0' => ['required' => 'Jam pelajaran awal belum dipilih'],
        'jp1' => ['required' => 'Jam pelajaran akhir belum dipilih'],
        'mapel_agenda' => ['required' => 'Mapel belum dipilih'],
        'materi' => ['required' => 'Materi belum dipilih']
      ];

      if (! $this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
        //$data['form']=1;
        //return view('agendagurubaru',$data);
        //d($data); 
        return redirect()->back()->withInput();
      } else {

        $model = new AgendaGuruModel();
        $guru = $this->request->getPost('kode_guru');
        $rombel = $this->request->getPost('rombel_agenda');
        $tgl = $this->request->getPost('tanggal');
        $bln = $this->request->getPost('bulan');
        $thn = date("Y");
        //$tanggal=date("dmY");
        $tanggal = $tgl . $bln . $thn;
        $kode_agenda = $guru . "-" . $tanggal . "-" . $rombel;
        $data = array(
          'rombel' => $rombel,
          'jp0' => $this->request->getPost('jp0'),
          'jp1' => $this->request->getPost('jp1'),
          'mapel' => $this->request->getPost('mapel_agenda'),
          'materi' => $this->request->getPost('materi'),
          'kode_agendaguru' => $kode_agenda,
          'kode_guru' => $guru,
        );
        $model->insert($data, false);
        return redirect()->to('/agendaguru');
      }
    } // end post  
    // return view('header')
    // .view('menu',$data)
    // .view('agendagurubaru')
    // .view('footer');
    //d($data);

  }

  public function edit($id = FALSE)
  {
    //$data = session()->get();
    global $data;
    $this->sesi();
    $model = new AgendaGuruModel();
    if ($this->request->is('post')) {
      $rules = [
        'tanggal' => 'required',
        'bulan' => 'required',
        'tahun' => 'required',
        'rombel' => 'required',
        'jp0' => 'required',
        'jp1' => 'required',
        'mapel' => 'required',
        'materi' => 'required'
      ];

      $errors = [
        'tanggal' => ['required' => 'Tanggal belum dipilih'],
        'bulan' => ['required' => 'Bulan belum dipilih'],
        'tahun' => ['required' => 'Tahun belum dipilih'],
        'rombel' => ['required' => 'Rombel belum dipilih'],
        'jp0' => ['required' => 'Jam pelajaran awal belum dipilih'],
        'jp1' => ['required' => 'Jam pelajaran akhir belum dipilih'],
        'mapel' => ['required' => 'Mapel belum dipilih'],
        'materi' => ['required' => 'Materi belum dipilih']
      ];

      if (! $this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
        //$data['form']=1;
        //return view('agendagurubaru',$data);
        //d($data); 
        return redirect()->back()->withInput();
      } else {


        $data['agenda']['tanggal'] = $this->request->getVar('tahun') . '-' . $this->request->getVar('bulan') . '-' . $this->request->getVar('tanggal');
        $data['agenda']['materi'] = $this->request->getVar('materi');
        $data['agenda']['rombel'] = $this->request->getVar('rombel');
        $data['agenda']['mapel'] = $this->request->getVar('mapel');
        $data['agenda']['jp0'] = $this->request->getVar('jp0');
        $data['agenda']['jp1'] = $this->request->getVar('jp1');
        $data['agenda']['kode_guru'] = $data['kode_pengguna'];
        $data['agenda']['kode_agendaguru'] = $data['kode_pengguna'] . '-' . $this->request->getVar('tanggal') . $this->request->getVar('bulan') . $this->request->getVar('tahun');

        $model->update($id, $data['agenda']);
        return redirect()->to('/agendaguru');
        //return redirect()->to($this->request->getVar('link'));
      }
    } else {
      $jadwal = $this->pbm->jadwal_data();
      $data['agenda'] = $model->where('id_agendaguru', $id)->first();
      $data['rombel_jadwal'] = $this->rombel_jadwal($jadwal);
      $data['mapel_jadwal'] = $this->mapel_jadwal($jadwal);
      //d( $data );
      return view('header')
        . view('menu', $data)
        . view('editagendaguru')

        . view('footer');
    }


    //return redirect()->to( '/tuta' );

  }

  public function tutabaru()
  {
    //$data = session()->get();
    global $data;
    $this->sesi();
    //$data['waktu']=$this->waktu();

    if ($this->request->is('get')) {
      $data['form'] = 1;
    }

    if ($this->request->is('post')) {
      $rules = [
        'rombel_agenda' => 'required',
        'jp0' => 'required',
        'jp1' => 'required',
        'mapel_agenda' => 'required',
        'materi' => 'required'
      ];

      $errors = [
        'rombel_agenda' => ['required' => 'Rombel belum dipilih'],
        'jp0' => ['required' => 'Jam pelajaran awal belum dipilih'],
        'jp1' => ['required' => 'Jam pelajaran akhir belum dipilih'],
        'mapel_agenda' => ['required' => 'Mapel belum dipilih'],
        'materi' => ['required' => 'Materi belum dipilih']
      ];

      if (! $this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;
      } else {

        $data['agenda'] = 1;
        $data['rombel_agenda'] = $data['rombel'][$this->request->getVar('rombel_agenda')];
        $data['jp'] = $this->request->getVar('jp0') . "-" . $this->request->getVar('jp1');
        $data['mapel_agenda'] = $data['mapel'][$this->request->getVar('mapel_agenda')];
        $data['materi'] = $this->request->getVar('materi');
        $data['agenda'] = 1;

        $siswa = new SiswaModel();

        $data['siswa'] = $siswa->where('rombel', $data['rombel_agenda'])->findAll();
      }
    }

    //d($data);
    return view('header')
      . view('menu', $data)
      . view('agendatutabaru')
      . view('footer');
  }

  public function presensi($rombel, $id)
  {
    global $data;
    $this->sesi();
    $presensi = new SiswaModel();
    $agenda = new AgendaGuruModel();
    $data['agenda'] = $agenda->where(['id_agendaguru' => $id])->first();
    $data['siswa'] = $presensi->where('rombel', $rombel)->findAll();

    //$data['tess']=$presensi->getLastQuery();
    //d($data);


    return view('header')
      . view('menu', $data)
      . view('presensi_agenda')
      . view('footer');
  }

  public function simpanpresensi()
  {
    global $data;
    $this->sesi();
    $agenda = new AgendaGuruModel();
    $data['datapresensi'] = $this->request->getPost();
    //dd($data);
    $absen = array();
    $no_urut = 1;
    for ($a = 1; $a <= $data['datapresensi']['jumlah_siswa']; $a++) {
      if (!empty($data['datapresensi']['absensi' . $a])) {
        if ($data['datapresensi']['absensi' . $a] == "TL") {
          $absen['TL'][] = ['nis' => $this->request->getPost('nis' . $a), 'nama' => $this->request->getPost('nama_siswa' . $a), 'catatan' => $this->request->getPost('catatan' . $a)];
        }
        if ($data['datapresensi']['absensi' . $a] == "BL") {
          $absen['BL'][] = ['nis' => $this->request->getPost('nis' . $a), 'nama' => $this->request->getPost('nama_siswa' . $a), 'catatan' => $this->request->getPost('catatan' . $a)];
        }
        if ($data['datapresensi']['absensi' . $a] == "D") {
          $absen['D'][] = ['nis' => $this->request->getPost('nis' . $a), 'nama' => $this->request->getPost('nama_siswa' . $a), 'catatan' => $this->request->getPost('catatan' . $a)];
        }
        if ($data['datapresensi']['absensi' . $a] == "S") {
          $absen['S'][] = ['nis' => $this->request->getPost('nis' . $a), 'nama' => $this->request->getPost('nama_siswa' . $a), 'catatan' => $this->request->getPost('catatan' . $a)];
        }
        if ($data['datapresensi']['absensi' . $a] == "I") {
          $absen['I'][] = ['nis' => $this->request->getPost('nis' . $a), 'nama' => $this->request->getPost('nama_siswa' . $a), 'catatan' => $this->request->getPost('catatan' . $a)];
        }
        if ($data['datapresensi']['absensi' . $a] == "A") {
          $absen['A'][] = ['nis' => $this->request->getPost('nis' . $a), 'nama' => $this->request->getPost('nama_siswa' . $a), 'catatan' => $this->request->getPost('catatan' . $a)];
        }
      }
    }
    //$data['tess']=$presensi->getLastQuery();
    //dd($absen);
    $dataabsen = json_encode($absen);
    $data['update']['absensi'] = $dataabsen;
    //dd($data);
    $agenda->update($data['datapresensi']['id_agendaguru'], $data['update']);
    //$data['waktu']=$this->waktu();
    return redirect()->to('/agendaguru');
  }

  public function hapuspresensi($absensi, $nis, $id_agendaguru)
  {
    global $data;
    $this->sesi();

    $agenda = new AgendaGuruModel();
    $data['agenda'] = $agenda->where(['id_agendaguru' => $id_agendaguru])->first();

    $data_absensi = json_decode($data['agenda']['absensi'], true);
    $key = array_column($data_absensi[$absensi], $nis);
    
    for ($h = 0; $h < count($data_absensi[$absensi]); $h++) {
      if ($data_absensi[$absensi][$h]['nis'] == $nis) {
        unset($data_absensi[$absensi][$h]);
      }
    }
    
  //   foreach ($data_absensi as $key => $value) {
  //     if (count($value) < 0) {
  //        unset($data_absensi[$value]);
  //     }
  // }
    //$data_absensi=array_filter($data_absensi);
    //d($data_absensi);
    $this->update_absen($data_absensi, $id_agendaguru);
    return redirect()->to('/agendaguru');
  }

  //   function cari_nis($nis, $array) {
  //     foreach ($array as $key => $val) {
  //         if ($val['nis'] === $nis) {
  //             return $key;
  //         }
  //     }
  //     return null;
  //  }

  public function tambahpresensi($id_agendaguru)
  {
    global $data;
    $this->sesi();
    $presensi = new SiswaModel();
    $agenda = new AgendaGuruModel();
    $data['agenda'] = $agenda->where(['id_agendaguru' => $id_agendaguru])->first();
    $data['absen_lama'] = json_decode($data['agenda']['absensi'], true);
    //d($data);
    $data['siswa'] = $presensi->where('rombel', $data['agenda']['rombel'])->findAll();

    //$data['tess']=$presensi->getLastQuery();
    //d($data);


    return view('header')
      . view('menu', $data)
      . view('updatepresensi')
      . view('footer');
  }

  public function update_absen($absen, $id)
  {
    $agenda = new AgendaGuruModel();
    $absen=array_filter($absen);
    if (!empty($absen)) {
      $dataabsen = json_encode($absen);
    } else {
      $dataabsen = NULL;
    }
    $data['update']['absensi'] = $dataabsen;
    // if (is_null($data['update']['absensi']))
    // {
    //   unset($data['update']['absensi']);
    // }
    $agenda->update($id, $data['update']);
  }
  public function rombel_jadwal($jadwal)
  {
    $rombel = [];
    //d($jadwal);
    foreach ($jadwal as $j) {
      foreach ($j as $hari => $rom) {
        if (!in_array($rom['kelas'], $rombel)) {
          $rombel[$rom['kelas']] = $rom['kelas'];
        }
      }
    }
    return $rombel;
  }

  public function mapel_jadwal($jadwal)
  {
    $mapel = [];
    foreach ($jadwal as $j) {
      foreach ($j as $hari => $rom) {
        if (!in_array($rom['mapel'], $mapel)) {
          $mapel[$rom['mapel']] = $rom['mapel'];
        }
      }
    }
    return $mapel;
  }

  public function waktu()
  {
    return $waktu = date('l, j F Y, H:i');
  }

  public function absensi()
  {
    global $data;
    $this->sesi();
    $data['agenda'] = 1;

    if ($this->request->is('post')) {
      $rules = [
        'rombel_agenda' => 'required',
        'jp0' => 'required',
        'jp1' => 'required',
        'mapel_agenda' => 'required',
        'materi' => 'required'
      ];

      $errors = [
        'rombel_agenda' => ['required' => 'Rombel belum dipilih'],
        'jp0' => ['required' => 'Jam pelajaran awal belum dipilih'],
        'jp1' => ['required' => 'Jam pelajaran akhir belum dipilih'],
        'mapel_agenda' => ['required' => 'Mapel belum dipilih'],
        'materi' => ['required' => 'Materi belum dipilih']
      ];

      $data_ = $this->request->getPost(array_keys($rules));

      if (! $this->validateData($data_, $rules)) {
        return view('agendaguru', $data);
      }

      // If you want to get the validated data.
      $validData = $this->validator->getValidated();
      $data['valid'] = $validData;
    }

    return $data;
  }

  public function simpan()
  {
    $model = new AgendaGuruModel();
    $guru = $this->request->getPost('kode_guru');
    $rombel = $this->request->getPost('rombel_agenda');
    $tanggal = date("dmY");
    $kode_agenda = $guru . "-" . $tanggal . "-" . $rombel;
    $data = array(
      'rombel' => $rombel,
      'jp0' => $this->request->getPost('jp0'),
      'jp1' => $this->request->getPost('jp1'),
      'mapel' => $this->request->getPost('mapel_agenda'),
      'materi' => $this->request->getPost('materi'),
      'kode_agendaguru' => $kode_agenda,
      'kode_guru' => $guru,
    );
    //dd($data);
    $model->insert($data, false);
    return redirect()->to('/agendaguru');
  }



  public function hapus($id)
  {
    global $data;
    $this->sesi();
    $model = new AgendaGuruModel();
    if ($this->request->is('post')) {
      $id = $this->request->getPost('id');
      $model->delete($id);
    } else {
      $data['agenda'] = $model->where('id_agendaguru', $id)->first();
      $data['konfirmasi'] = 1;
      return view('header')
        . view('menu', $data)
        . view('daftaragenda')

        . view('footer');
    }
    return redirect()->to('/agendaguru');
  }

  public function tatapmuka()
  {
    global $data;
    $this->sesi();
    if ($this->request->is('post')) {
      $data['mapel_tm'] = $this->request->getPost('mapel');
      $data['rombel_tm'] = $this->request->getPost('rombel');
      $agendamodel = new AgendaGuruModel();
      $data['agenda'] =  $agendamodel->where(['kode_guru' => $data['kode_pengguna'], 'rombel' => $data['rombel_tm'], 'mapel' => $data['mapel_tm']])->orderBy('id_agendaguru', 'ASC')->findAll();

      $siswa = new SiswaModel();
      $data['siswa'] = $siswa->where('rombel', $data['rombel_tm'])->findAll();
      //$data['rombel_tm']=$rombel;
      //d($data);
      return view('header')
        . view('menu', $data)
        . view('rekap_tatapmuka')
        . view('footer');
    } else {
      $jadwal = $this->pbm->jadwal_data();
      $data['mapel'] = $this->mapel_jadwal($jadwal);
      $data['rombel'] = $this->rombel_jadwal($jadwal);
      //d($data);
      return view('header')
        . view('menu', $data)
        . view('form_tatapmuka')
        . view('footer');
    }
  }

  public function lapor2()
  {
    global $data;
    $this->sesi();

    $data['jadwal'] = $this->pbm->jadwal_data();
    $data['jam_sekarang'] = date("N") . $this->pbm->jam_ke();

    switch (date("N")) {
      case 1:
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
    
    if (date("N") !=6 || date("N") !=7)
    {
    $jam_ke=substr($data['jam_sekarang'], -1, 1);
    $jam_ke=$jam_ke+1;
    $data['jam_ke']=JP[date("N")][$jam_ke];
    //echo JP[$kode_hari][$jp];
    }
    else {
      $data['jam_ke']="";
    }
    
    if (isset($data['jadwal'][$h]))
    {
      $jadwal_hari_ini = $data['jadwal'][$h];
    
    

    foreach ($jadwal_hari_ini as $jam => $kelas) {

      if (!isset($durasi[$kelas['kelas']])) {
       //OK tp ga cocok kalau beda belas beruntun
        //$durasi[$jam] = ['rombel' => $kelas['kelas'], 'mapel' => $kelas['mapel']];
       $durasi[$kelas['kelas']] = ['mapel' => $kelas['mapel'],'jam_0'=>$jam];
       //$durasi[$kelas['kelas']]=['jam_0'=>$jam];
       
      //  if (!isset($durasi[$kelas['kelas']]['jam_0']))
      //  {
      //   $durasi[$kelas['kelas']]=['jam_0'=>$jam];
      //  }
      //  else {
      //   $durasi[$kelas['kelas']]=['jam_1'=>$jam];
      //  }
      //  $durasi[$kelas['kelas']] = ['mapel' => $kelas['mapel']];
        //$jpnya[]=$jam;
      }
      else {
        //$durasi[$kelas['kelas']]=['jam_1'=>$jam];
        $durasi[$kelas['kelas']]['jam_1'] =$jam;
      }
    }
    $data['info'] = $durasi;
    // $data['jp0']=reset($jpnya);
    // $jam_0=substr($data['jp0'], -1, 1);
    // $jam_0=$jam_0+1;
    // $data['jp1']=end($jpnya);
    // $jam_1=substr($data['jp1'], -1, 1);
    // $jam_1=$jam_1+1;
    // $data['jp0']=$jam_0;
    // $data['jp1']=$jam_1;
    }
    
    if ($this->request->is('post')) {

      $model = new AgendaGuruModel();
      // $data['jadwal']=$this->pbm->jadwal_data();
      $data['kode_guru'] = $data['kode_pengguna'];
      $data['rombel'] = $this->request->getPost('rombel');
      $data['mapel'] = $this->request->getPost('mapel');
      $data['lokasi'] = $this->request->getPost('lokasi');
       $data['jp0'] = $data['jp0'];
       $data['jp1'] = $data['jp1'];
      $data['tapel'] = TAPEL;
      $data['semester'] = 2;
      $data['tanggal'] = date("Y-m-d");
      $data['waktu'] = date("H:i:s");
      $data['kode_agendaguru'] = $data['kode_guru'] . "-" . date("dmY") . "-" . $data['rombel'];


      //d($data);
      $model->insert($data, false);
      return redirect()->to('/agendaguru');
    } else {
      //$jadwal=$this->pbm->jadwal_data();

      $data['rombel'] = $this->rombel_jadwal($data['jadwal']);
      $data['mapel'] = $this->mapel_jadwal($data['jadwal']);
      d($data);
      return view('header')
        . view('menu', $data)
        . view('form_lapor')
        . view('footer');
    }
  }

  public function lapor()
  {
    global $data;
    $this->sesi();

    $data['jadwal'] = $this->pbm->jadwal_data();
    $data['jam_sekarang'] = date("N") . $this->pbm->jam_ke();

    switch (date("N")) {
      case 1:
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
    
    if (date("N") !=6 || date("N") !=6)
    {
    $jam_ke=substr($data['jam_sekarang'], -1, 1);
    $jam_ke=$jam_ke+1;
    $data['jam_ke']=JP[date("N")][$jam_ke];
    //echo JP[$kode_hari][$jp];
    }
    else {
      $data['jam_ke']="";
    }
    
    if (isset($data['jadwal'][$h]))
    {
      $jadwal_hari_ini = $data['jadwal'][$h];
    
    

    foreach ($jadwal_hari_ini as $jam => $kelas) {

      if (!isset($durasi[$kelas['kelas']][$jam])) {
        $durasi[$jam] = ['rombel' => $kelas['kelas'], 'mapel' => $kelas['mapel']];
        // $durasi[$kelas['kelas']]['mapel']=$kelas['mapel'];
        $jpnya[]=$jam;
      } 
    }
    $data['info'] = $durasi;
    $data['jp0']=reset($jpnya);
    $jam_0=substr($data['jp0'], -1, 1);
    $jam_0=$jam_0+1;
    $data['jp1']=end($jpnya);
    $jam_1=substr($data['jp1'], -1, 1);
    $jam_1=$jam_1+1;
    $data['jp0']=$jam_0;
    $data['jp1']=$jam_1;
    }
    
    if ($this->request->is('post')) {

      $model = new AgendaGuruModel();
      // $data['jadwal']=$this->pbm->jadwal_data();
      $data['kode_guru'] = $data['kode_pengguna'];
      $data['rombel'] = $this->request->getPost('rombel');
      $data['mapel'] = $this->request->getPost('mapel');
      $data['lokasi'] = $this->request->getPost('lokasi');
       $data['jp0'] = $data['jp0'];
       $data['jp1'] = $data['jp1'];
      $data['tapel'] = TAPEL;
      $data['semester'] = 2;
      $data['tanggal'] = date("Y-m-d");
      $data['waktu'] = date("H:i:s");
      $data['kode_agendaguru'] = $data['kode_guru'] . "-" . date("dmY") . "-" . $data['rombel'];


      //d($data);
      $model->insert($data, false);
      return redirect()->to('/agendaguru');
    } else {
      //$jadwal=$this->pbm->jadwal_data();

      $data['rombel'] = $this->rombel_jadwal($data['jadwal']);
      $data['mapel'] = $this->mapel_jadwal($data['jadwal']);
      //d($data);
      return view('header')
        . view('menu', $data)
        . view('form_lapor')
        . view('footer');
    }
  }

  public function rekap_absensi()
  {
    global $data;
    $this->sesi();
    $model = new AgendaGuruModel();
    $data['absensi'] = $model->rekap_absensi();
    for ($a = 0; $a < count($data['absensi']); $a++) {
      if (!$data['absensi'][$a]['absensi'] || $data['absensi'][$a]['absensi'] == '[]') {
        $update = $model->update($data['absensi'][$a]['id_agendaguru'], ['rekap' => 1]);
      } else {
      }
    }
    //d($data);
    return view('header')
      . view('menu', $data)
      . view('rekap_absensi')
      . view('footer');
  }
}
