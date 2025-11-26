<?php

namespace App\Controllers;

use Config\Services;
use App\Models\SaranaModel;
use App\Models\PbmModel;
use CodeIgniter\I18n\Time;


class Sarana extends BaseController
// class Sarana extends Pbm
{
  protected $helpers = ['form', 'text', 'cookie', 'date'];
  protected $pbm;

  protected $session;

  public function __construct()
  {
    // $this->pbm = new Pbm();
    //global $session;
    $session = session();
  }


  public function index()
  {

    $data = session()->get();

        return view('header')
      . view('menu', $data)
      . view('index')
      . view('footer');
  }

  
}
