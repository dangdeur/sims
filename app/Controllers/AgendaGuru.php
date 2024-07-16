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
  $data['agenda']=$agenda;
  $data['waktu']=$this->waktu();
  //d($data);
  return view('header')
         .view('menu',$data)
         .view('daftaragenda')
         .view('footer');
  }

  public function baru ()
  {
    $data = session()->get();
    $data['waktu']=$this->waktu();
    $jadwal=$this->pbm->jadwal_data();
    $data['rombel']=$this->rombel_jadwal($jadwal['jadwal']);
    $data['mapel']=$this->mapel_jadwal($jadwal['jadwal']);
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
   
  public function rombel_jadwal($jadwal)
  {
    $rombel=[];
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

    public function update()
    {
        $model = new AgendaModel();
        $id = $this->request->getPost('product_id');
        $data = array(
            'product_name'        => $this->request->getPost('product_name'),
            'product_price'       => $this->request->getPost('product_price'),
            'product_category_id' => $this->request->getPost('product_category'),
        );
        $model->updateAgenda($data, $id);
        return redirect()->to('/product');
    }

    public function hapus()
    {
        $model = new AgendaModel();
        $id = $this->request->getPost('product_id');
        $model->hapusAgenda($id);
        return redirect()->to('/product');
    }
}
