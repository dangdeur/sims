<?php

namespace App\Controllers;
use Config\Services;
// use App\Models\AgendaGuruModel;
// use App\Models\PbmModel;
use App\Models\SiswaModel;


// class Agenda extends BaseController
class Walas extends BaseController
{
  protected $helpers = ['form','text','cookie','date'];
  protected $pbm;
  protected $session;

  public function __construct()
  {
    //  $this->pbm= new Pbm();
    // $data = session()->get();
     
  }
  

  public function index()
  {
    $data = session()->get();
  $rombel=$data['walas'];
    $model = new SiswaModel();
  
    $data['siswa'] = $model->where('rombel', $rombel)->findAll();
  
   
  return view('header')
       .view('menu',$data)
       .view('siswa')
       .view('footer');

}
}
