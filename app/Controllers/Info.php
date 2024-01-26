<?php

namespace App\Controllers;
use Config\Services;
//use App\Models\PenggunaModel;

class Info extends BaseController
{
  protected $helpers = ['form','text','cookie'];
    public function index()
    {
      //$session=session();
      $data = $this->session->get();

      return view('header')
            .view('menu',$data)
            .view('info')
            .view('footer');
    }



}
