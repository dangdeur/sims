<?php

namespace App\Controllers;
use Config\Services;
use App\Models\PenggunaModel;
use App\Models\PollingModel;
use App\Models\StafModel;
$encrypter = service('encrypter');


class Polling extends BaseController
{
  protected $helpers = ['form', 'text', 'cookie','html'];
  
  public function index()
  {
    $enkripsi = service('encrypter');
    $data = $this->session->get();
    $model = new PenggunaModel;
   $data['nama_guru']=$model->nama(['peran'=>1]);
   $data['nama_staf']=$model->nama(['peran'=>6]);
   //$data['txt_guru']=$enkripsi->encrypt($nama_guru);
   //$data['txt_guru']=$nama_guru;
  d($data);

  //  $modelpolling = new PollingModel();
  //  $data['polling']=$modelpolling->data_polling();
   //($data['txt_guru']);

    return view('header')
       . view('menu', $data)
      . view('polling')
      . view('footer');
  }

  

 

 

}
