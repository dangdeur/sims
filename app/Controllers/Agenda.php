<?php

namespace App\Controllers;
use Config\Services;
use App\Models\AgendaModel;
use App\Models\PbmModel;

// class Agenda extends BaseController
class Agenda extends Pbm
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

  $agendamodel = new AgendaModel();
  $kode_agenda="";
  $agenda = $agendamodel->where('kode_agenda', $kode_agenda)->findAll();
      //               ->first();
  $data['agenda']=$agenda;
  // $data['hari']= date('l');
  // $data['tanggal']= date('j');
  // $data['bulan']= date('F');
  // $data['tahun']= date('Y');
  // $data['jam']= date('H:i:s');
  //$data['waktu']=date('l, j F Y, H:i');
  $data['waktu']=date('l, j F Y, H:i',mktime(10,15,2,2,2,2024));
  $data['jadwal']=$this->pbm->jadwal_data();

  //dd($data['jadwal']);
  return view('header')
         .view('menu',$data)
         .view('agenda')
         .view('footer');
  }

  public function baru ()
  {
    $data = $this->session->get();
    if ($this->request->is('get')) 
    {
      $data['form']=1;
    }
    //d($data['form']);
    // $data=$this->pbm->jadwal_data();
    // dd($data);
    return view('header')
         .view('menu',$data)
         .view('agenda')
         .view('footer');
  }

  public function jadwal_pbm()
  {
    $jadwal = $this->pbm->where('kode_guru', $data['kode_pengguna'])->findAll();
    
    $data=$data+$jadwal[0];
    $data_jadwal=$this->olah_jadwal($jadwal);
    $data['jadwal']=$this->gabung_jadwal($data_jadwal);
      //d($jadwal);
  }


    



}
