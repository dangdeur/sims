<?php

namespace App\Controllers;
use Config\Services;
use App\Models\InfoModel;
use App\Models\StafModel;
use App\Models\UpacaraModel;

class Info extends BaseController
{
  protected $helpers = ['form', 'text', 'cookie','html'];
  public function index()
  {
    $data = $this->session->get();
    $model = new InfoModel;
    //paginasi
    $data['info'] = $model->select('*')->orderBy('tanggal', 'DESC')->paginate(10);
    $data['pager'] = $model->pager;

    //d($data);

    return view('header')
      . view('menu', $data)
      . view('info')
      . view('footer');
  }

  //   public function getCookie() {

  //     return get_cookie( 'skendava');

  // }

  public function profil()
  {
    $data = $this->session->get();
    $stafmodel = new StafModel();
  $data['detail'] = $stafmodel->where('kode_staf', $data['kode_pengguna'])->first();
  d($data);
    return view('header')
    . view('menu', $data)
    . view('profil')
    . view('footer');
  }

  public function upacara()
  {
    $data = $this->session->get();
    $upacaramodel = new UpacaraModel();
    //$data['detail'] = $upacaramodel->where('kode_absen', $data['kode_absen'])->findAll();
    $data ['absen']=  $upacaramodel->where(['kode_absen'=>$data['kode_absen']])->orderBy('waktu','DESC')->paginate(10);
    $data ['pager'] = $upacaramodel->pager;
    //d($data);
    return view('header')
    . view('menu', $data)
    . view('upacara')
    . view('footer');
  }

}
