<?php

namespace App\Controllers;
use Config\Services;
use App\Models\InfoModel;
use App\Models\StafModel;
use App\Models\UpacaraModel;
use App\Models\HarianModel;


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

  public function rekap_upacara()
  {
    $data = $this->session->get();
    $upacaramodel = new UpacaraModel();
    $data ['absen']=  $upacaramodel->where(['kode_absen'=>$data['kode_absen']])->orderBy('waktu','DESC')->paginate(20);
    $data ['pager'] = $upacaramodel->pager;
   
    return view('header')
    . view('menu', $data)
    . view('rekap_upacara')
    . view('footer');
  }

  public function rekap_harian()
	{
		$data = session()->get();
		$model = new HarianModel();
		$data ['kehadiran']=  $model->where(['kode_absen'=>$data['kode_absen']])->orderBy('waktu','DESC')->paginate(20);
    $data ['pager'] = $model->pager;
		return view('header')
            . view('menu', $data)
            . view('rekap_harian')
            . view('footer');
	}

}
