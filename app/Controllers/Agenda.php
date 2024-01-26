<?php

namespace App\Controllers;
use Config\Services;
use App\Models\AgendaModel;

class Agenda extends BaseController
{
  protected $helpers = ['form','text','cookie'];
    public function index()
    {

      $data = $this->session->get();
    //   $agendamodel = new AgendaModel();
    //   $jadwal = $agendamodel->where('kode_guru', $data['kode_pengguna'])->findAll();
      //               ->first();

      //$data=$data+$jadwal[0];
    //   $data_jadwal=$this->olah_jadwal($jadwal);
    //   $data['jadwal']=$this->gabung_jadwal($data_jadwal);
    //   d($jadwal);
      return view('header')
            .view('menu',$data)
            .view('agenda')
            .view('footer');

    }

    



}
