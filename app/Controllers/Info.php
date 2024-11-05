<?php

namespace App\Controllers;
use Config\Services;
use App\Models\InfoModel;
use App\Models\StafModel;

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
  //d($data);
    return view('header')
    . view('menu', $data)
    . view('profil')
    . view('footer');
  }



}
