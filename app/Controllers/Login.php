<?php

namespace App\Controllers;
use Config\Services;
use App\Models\PenggunaModel;

class Login extends BaseController
{
  protected $helpers = ['form','text','cookie'];

    public function index()
    {
      $data = [];

    if(get_cookie('skendava'))
    {
      $this->autologin(get_cookie('skendava'));
      //view('salah');
    }

        //baru
         if ($this->request->is('post')) {
        //let's do the validation here
        $rules = [
          'email' => 'required|min_length[6]|max_length[50]|valid_email',
          'password' => 'required|min_length[4]|max_length[255]|validateUser[email,password]',
        ];

        $errors = [
          'email' => [
            'required' =>'Email belum diisi',
            'min_length' => 'Email kurang dari 6 karakter',
            'max_length' => 'Email lebih dari 50 karakter',
            'valid_email' => 'format email tidak sesuai'
          ],
          'password' => [
            'validateUser' => 'Email atau Password salah'
          ]
        ];


       //========================================================
        if (! $this->validate($rules, $errors)) {
          $data['validation'] = $this->validator;

        }else{
          $model = new PenggunaModel();

          $user = $model->where('email', $this->request->getVar('email'))
                        ->first();
          $user['level']=$this->siapaLogin($user,[$user['peran']]);


          //ingat
          if ($this->request->getVar('ingat')==1)
          {

            $newdata['token']=random_string('alnum', 16);
            // echo "<pre>";
            // print_r($user);
            // echo "</pre>";

            //exit();
            $user['token']=$newdata['token'];

            $update=$model->update($user['id_pengguna'],$newdata);
          }

          $this->setUserSession($user);
          if(!has_cookie('skendava'))
          {
            set_cookie('skendava',$user['token'],3600);
          }
          //dd($user);
          return redirect()->to('info')->withCookies();;


      }

    } //end post
echo view('login');

  }

public function autologin($token) {
  $model = new PenggunaModel();
  $user = $model->where('token',$token)->first();
  // if ($user) {
    $user['level']=$this->siapaLogin($user,[$user['peran']]);
    $this->setUserSession($user);
      return redirect()->to('profil')->withCookies();;
  // }


}

    private function setUserSession($user){
      $data = [
        'id_pengguna' => $user['id_pengguna'],
        'nama_lengkap' => $user['nama_lengkap'],
        'email' => $user['email'],
        'peran' => $user['peran'],
        'kode_pengguna' => $user['kode_pengguna'],
        'level' => $user['level'],
        'token' => $user['token'],
        'isLoggedIn' => true,
      ];

      session()->set($data);
      return true;
    }

    public function siapaLogin($user,$peran)
    {

      if ($user['peran']==1)
      {
        $login='Guru';
      }
      elseif ($user['peran']==2) {
        $login='Guru BP/BK';
      }
      elseif ($user['peran']==3) {
        $login='Walikelas';
      }
      elseif ($user['peran']==4) {
      $login='Kepala Sekolah';
      }
      elseif ($user['peran']==5) {
        $login='Admin';
      }
      elseif ($user['peran']==10) {
        $login='Superadmin';
      }
      else {
        $login='Siswa';
      }
      return $login;

    }

    private function setSessionPengguna($pengguna){
  		$data = [
  			'id_pengguna' => $pengguna['id_pengguna'],
        'username' => $pengguna['username'],
  			'jenis_user' => $pengguna['jenis_user'],
  			'is_loggedin' => true,
  		];

  		session()->set($data);
  		return true;
  	}

    public function logout(){
  		session()->destroy();
  		return redirect()->to('/');
  	}


   function addCookie()
   {
       set_cookie('skendava','token',3600);
       //echo "Congragulatio Cookie Set";
   }

   function delCookie()
   {
      delete_cookie('skendava');
   }

   function getCookie()
   {

     echo get_cookie('skendava');
    //echo $cookie;
   }


}
