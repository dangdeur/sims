<?php

namespace App\Controllers;
use Config\Services;
use App\Models\AgendaGuruModel;
use App\Models\PbmModel;
use App\Models\SiswaModel;


// class Agenda extends BaseController
class AgendaGuru extends Pbm
{
  protected $helpers = ['form','text','cookie','date'];
  protected $pbm;
  protected $session;

  public function __construct()
  {
     $this->pbm= new Pbm();
     $data = session()->get();
     
  }
  

  public function index()
  {
  $data = session()->get();
  
  $agendamodel = new AgendaGuruModel();
  $agenda = $agendamodel->where('kode_guru', $data['kode_pengguna'])->findAll();
  
 //OK
  // $data['agenda']=$agenda;
  $data['waktu']=$this->waktu();
  
  //paginasi
  $data ['agenda']=  $agendamodel->where('kode_guru', $data['kode_pengguna'])->orderBy('dibuat','DESC')->paginate(10);
  $data ['pager'] = $agendamodel->pager;
  

  
  //d($data);
  
  return view('header')
         .view('menu',$data)
         .view('daftaragenda')
        //  .view('paginasi')
         .view('footer');
  }

  public function baru ()
  {
    $data = session()->get();
    $data['waktu']=$this->waktu();
    $jadwal=$this->pbm->jadwal_data();
    //d($jadwal);
    $data['rombel']=$this->rombel_jadwal($jadwal);
    $data['mapel']=$this->mapel_jadwal($jadwal);
    if ($this->request->is('get')) 
      {
      $data['form']=1;
      }

    if ($this->request->is('post')) 
      {
      $rules = [
        'rombel_agenda' => 'required',
        'jp0' => 'required',
        'jp1' => 'required',
        'mapel_agenda' => 'required',
        'materi' => 'required'
      ];

      $errors = [
        'rombel_agenda' => ['required' =>'Rombel belum dipilih'],
        'jp0' => ['required' => 'Jam pelajaran awal belum dipilih'],
        'jp1' => ['required' => 'Jam pelajaran akhir belum dipilih'],
        'mapel_agenda' => ['required' => 'Mapel belum dipilih'],
        'materi' => ['required' => 'Materi belum dipilih']
      ];

      if (! $this->validate($rules, $errors)) {
        $data['validation'] = $this->validator;

      }
      else
      {
        
        $data['agenda']=1;
        $data['rombel_agenda']=$data['rombel'][$this->request->getVar('rombel_agenda')];
        $data['jp']=$this->request->getVar('jp0')."-".$this->request->getVar('jp1');
        $data['mapel_agenda']=$data['mapel'][$this->request->getVar('mapel_agenda')]; 
        $data['materi']=$this->request->getVar('materi');
        $data['agenda']=1;
        
        $siswa= new SiswaModel();
        
        $data['siswa'] = $siswa->where('rombel', $data['rombel_agenda'])->findAll();
      }
    }  

    //d($data);
    return view('header')
         .view('menu',$data)
         .view('agendagurubaru')
         .view('footer');
  }
  
  public function presensi($rombel,$id)
  {
    $data = session()->get();
    $presensi = new SiswaModel();
    $agenda= new AgendaGuruModel();
    $data['agenda'] = $agenda->where(['id_agendaguru'=>$id])->first();
    $data['siswa'] = $presensi->where('rombel', $rombel)->findAll();
    
    //$data['tess']=$presensi->getLastQuery();
    //d($data);

    
    return view('header')
         .view('menu',$data)
         .view('presensi_agenda')
         .view('footer');
  }

  public function simpanpresensi()
  {
    $data = session()->get();
    $agenda= new AgendaGuruModel();
    $data['datapresensi']=$this->request->getPost();
    //dd($data);
    $absen=array();
    $no_urut=1;
    for ($a=1;$a<=$data['datapresensi']['jumlah_siswa'];$a++)
    {
      if (!empty($data['datapresensi']['absensi'.$a]))
      {
        if ($data['datapresensi']['absensi'.$a]=="TL")
        {
        $absen['TL'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="BL")
        {
        $absen['BL'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="D")
        {
        $absen['D'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="S")
        {
        $absen['S'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="I")
        {
        $absen['I'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="A")
        {
        $absen['A'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }

      }
    }
    //$data['tess']=$presensi->getLastQuery();
    //dd($absen);
    $dataabsen=json_encode($absen);
    $data[ 'update' ][ 'absensi' ] = $dataabsen;
    //dd($data);
    $agenda->update( $data['datapresensi']['id_agendaguru'], $data[ 'update' ]);
    //$data['waktu']=$this->waktu();
    return redirect()->to('/agendaguru');
  }

  public function hapuspresensi($absensi,$nis,$id_agendaguru)
  {
    $data = session()->get();
    
    $agenda= new AgendaGuruModel();
    $data['agenda'] = $agenda->where(['id_agendaguru'=>$id_agendaguru])->first();

    $data_absensi=json_decode($data['agenda']['absensi'],true);
    $key=array_column($data_absensi[$absensi], $nis);
    //dd($data_absensi);
    for($h=0;$h<count($data_absensi[$absensi]);$h++)
    {
      if ($data_absensi[$absensi][$h]['nis']==$nis)
      {
        unset($data_absensi[$absensi][$h]);
      }
    }
    
    $this->update_absen($data_absensi,$id_agendaguru);
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

public function tambahpresensi($absensi,$id_agendaguru)
  {
    $data = session()->get();
    $agenda= new AgendaGuruModel();
    // $data['agenda'] = $agenda->where(['id_agendaguru'=>$id_agendaguru])->first();
  }

  public function update_absen($absen,$id)
  {
    $agenda= new AgendaGuruModel();
    $dataabsen=json_encode($absen);
    $data[ 'update' ][ 'absensi' ] = $dataabsen;
    $agenda->update( $id, $data[ 'update' ]);
  }
  public function rombel_jadwal($jadwal)
  {
    $rombel=[];
    //d($jadwal);
    foreach($jadwal as $j)
    {
     foreach ($j as $hari => $rom)
     {
      if (!in_array($rom['kelas'],$rombel))
      {
        $rombel[$rom['kelas']]=$rom['kelas'];
      }
      }
    }
    return $rombel;
  }

  public function mapel_jadwal($jadwal)
  {
    $mapel=[];
    foreach($jadwal as $j)
    {
     foreach ($j as $hari => $rom)
     {
      if (!in_array($rom['mapel'],$mapel))
      {
        $mapel[$rom['mapel']]=$rom['mapel'];
      }
     }
    }
    return $mapel;
  }

  public function waktu()
  {
  return $waktu=date('l, j F Y, H:i');
  }

  public function absensi()
  {
    $data = session()->get();
    $data['agenda']=1;

    if ($this->request->is('post')) 
    {
      $rules = [
        'rombel_agenda' => 'required',
        'jp0' => 'required',
        'jp1' => 'required',
        'mapel_agenda' => 'required',
        'materi' => 'required'
      ];

      $errors = [
        'rombel_agenda' => ['required' =>'Rombel belum dipilih'],
        'jp0' => ['required' => 'Jam pelajaran awal belum dipilih'],
        'jp1' => ['required' => 'Jam pelajaran akhir belum dipilih'],
        'mapel_agenda' => ['required' => 'Mapel belum dipilih'],
        'materi' => ['required' => 'Materi belum dipilih']
      ];

      $data_ = $this->request->getPost(array_keys($rules));

        if (! $this->validateData($data_, $rules)) {
            return view('agendaguru',$data);
        }

        // If you want to get the validated data.
        $validData = $this->validator->getValidated();
        $data['valid']=$validData;
    } 

    return $data;

  }

      public function simpan()
    {
        $model = new AgendaGuruModel();
        $guru = $this->request->getPost('kode_guru');
        $rombel = $this->request->getPost('rombel_agenda');
        $tanggal=date("dmY");
        $kode_agenda=$guru."-".$tanggal."-".$rombel;
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
        $model->insert($data,false);
        return redirect()->to('/agendaguru');
    }

    

    public function hapus($id)
    {
              $data['id_agendaguru']=$id;
          $model = new AgendaGuruModel();
          $model->delete($data);
          
          return redirect()->to('/agendaguru');
    
       
        
    }
}
