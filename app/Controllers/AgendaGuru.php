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
  //$kode_gu="";
  //d($data);
  $agenda = $agendamodel->where('kode_guru', $data['kode_pengguna'])->findAll();
      //               ->first();
  $data['agenda']=$agenda;
  
  $data['waktu']=$this->waktu();
 
  
  //d($data);
  return view('header')
         .view('menu',$data)
         .view('agendaguru')
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
    
   
    //$data['waktu']=$this->waktu();
   
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
        //$data = session()->get();
        $data['agenda']=1;
        $data['rombel_agenda']=$data['rombel'][$this->request->getVar('rombel_agenda')];
        $data['jp']=$this->request->getVar('jp0')."-".$this->request->getVar('jp1');
        $data['mapel_agenda']=$data['mapel'][$this->request->getVar('mapel_agenda')]; 
        $data['materi']=$this->request->getVar('materi');
        $data['agenda']=1;
        //$data['siswa']=$this->siswa_rombel($data['rombel_agenda']);
        
        $siswa= new SiswaModel();
        //$data['siswa']=$siswa->getSiswaRombel($data['rombel_agenda'])->get();
        $data['siswa'] = $siswa->where('rombel', $data['rombel_agenda'])->findAll();
     
      }

      // $data_ = $this->request->getPost(array_keys($rules));

      //   if (! $this->validateData($data_, $rules)) {
      //       return view('agendaguru',$data);
      //   }

      //   // If you want to get the validated data.
      //   $validData = $this->validator->getValidated();
      //   $data['valid']=$validData;

    }  

    // if ($this->request->is('post')) 
    // {
    //   $data['form']=0;
    //   //jadwal
    // $jadwal=$this->pbm->jadwal_data();
    // $data['waktu']=$this->waktu();
    // $data['rombel']=$this->rombel_jadwal($jadwal['jadwal']);
    // $data['mapel']=$this->mapel_jadwal($jadwal['jadwal']);
    // // $data=$this->pbm->jadwal_data();
    // d($data);
    // return view('header')
    //      .view('menu',$data)
    //      .view('agendaguru')
    //      .view('footer');
    // }
    d($data);
    return view('header')
         .view('menu',$data)
         .view('agendaguru')
         .view('footer');

  }
   
  //$jadwal $jadwal[Senin][10]
  public function rombel_jadwal($jadwal)
  {
    
    $rombel=[];
    foreach($jadwal as $j)
    {
     foreach ($j as $hari => $rom)
     {
      if (!in_array($rom['kelas'],$rombel))
      {
        $rombel[]=$rom['kelas'];
        
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
        $mapel[]=$rom['mapel'];
        
      }
      
     }
    }
    
    return $mapel;
  }

  public function waktu()
  {
  //return $waktu=date('l, j F Y, H:i',mktime(10,15,2,2,2,2024));
  return $waktu=date('l, j F Y, H:i');
  }

  // public function siswa_rombel($rombel)
  // {
    
  //   $siswa=[];
  //   foreach($jadwal as $j)
  //   {
  //    foreach ($j as $hari => $rom)
  //    {
  //     if (!in_array($rom['kelas'],$rombel))
  //     {
  //       $rombel[]=$rom['kelas'];
        
  //     }
      
  //    }
  //   }
    
  //   return $rombel;
  // }

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

      // if (! $this->validate($rules, $errors)) 
      // {
      //   $data['validation'] = $this->validator;
      // }
      // else
      // {
      //   $data_agenda['rombel_agenda']=$this->request->getVar('rombel_agenda');
      //   $data_agenda['jp0']=$this->request->getVar('jp0');
      //   $data_agenda['jp1']=$this->request->getVar('jp1');
      //   $data_agenda['mapel_agenda']=$this->request->getVar('mapel_agenda');
      //   $data_agenda['materi']=$this->request->getVar('materi');

      //   $session->set($data_agenda);

      //   d($session);
      // }

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

  // public function index()
  //   {
  //       $model = new Product_model();
  //       $data['product']  = $model->getProduct()->getResult();
  //       $data['category'] = $model->getCategory()->getResult();
  //       echo view('product_view', $data);
  //   }

    public function simpan()
    {
        $model = new AgendaModel();
        $data = array(
            'product_name'        => $this->request->getPost('product_name'),
            'product_price'       => $this->request->getPost('product_price'),
            'product_category_id' => $this->request->getPost('product_category'),
        );
        $model->simpanAgenda($data);
        return redirect()->to('/product');
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
