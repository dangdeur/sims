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
      
      //d($data);
      return view('header')
            .view('menu',$data)
            .view('info')
            .view('footer');
    }

    public function getCookie() {

      return get_cookie( 'skendava');
      //echo has_cookie( 'skendava' );
      //echo $cookie;
  }



}
