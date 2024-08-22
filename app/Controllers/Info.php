<?php

namespace App\Controllers;
use Config\Services;
use App\Models\InfoModel;

class Info extends BaseController
{
  protected $helpers = ['form', 'text', 'cookie'];
  public function index()
  {
    $data = $this->session->get();
    $model = new InfoModel;
    //paginasi
    $data['info'] = $model->select('*')->orderBy('tanggal', 'DESC')->paginate(10);
    $data['pager'] = $model->pager;



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
    return view('header')
    . view('menu', $data)
    . view('profil')
    . view('footer');
  }



}
