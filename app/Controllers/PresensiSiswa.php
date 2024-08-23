<?php

namespace App\Controllers;
use Config\Services;
use App\Models\AgendaGuruModel;
// use App\Models\PbmModel;
use App\Models\SiswaModel;


// class Agenda extends BaseController
class PresensiSiswa extends Pbm
{
  protected $helpers = ['form','text','cookie','date'];
  protected $pbm;
  protected $session;

  public function __construct()
  {
     $this->pbm= new Pbm();
     //$data = session()->get();
     
  }
  
  // public function index()
  // {
  // $data = session()->get();
  // $agendamodel = new AgendaGuruModel();
  // $agenda = $agendamodel->where('kode_guru', $data['kode_pengguna'])->findAll();
  // $data['agenda']=$agenda;
  // $data['waktu']=$this->waktu();
  // d($data);
  // return view('header')
  //        .view('menu',$data)
  //        .view('daftaragenda')
  //        .view('footer');
  // }

  public function baru ($rombel,$id)
  {
    
    $data = session()->get();
    $presensi = new SiswaModel();
    $agenda= new AgendaGuruModel();
    $data['agenda'] = $agenda->where(['id_agendaguru'=>$id,'absensi'=>NULL])->first();
    $data['siswa'] = $presensi->where('rombel', $rombel)->findAll();
    
    //$data['tess']=$presensi->getLastQuery();
    //d($data);

    
    return view('header')
         .view('menu',$data)
         .view('presensi')
         .view('footer');
  }
   
        public function simpan()
    {
        $presensi = new PresensiModel();
        $guru = $this->request->getPost('kode_guru');
        $rombel = $this->request->getPost('rombel_agenda');
        $mapel = $this->request->getPost('mapel');
        $tanggal=date("dmY");
        $kode_agenda=$guru."-".$tanggal."-".$rombel."-".$mapel;
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
