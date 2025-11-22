<?php

namespace App\Controllers;

use App\Models\TupoksiModel;
use Config\Services;
use App\Models\PenggunaModel;
use App\Models\WalasModel;
use App\Models\PiketModel;
use App\Models\TutaModel;
use App\Models\PengaturanModel;
use App\Models\SiswaModel;

class Login extends BaseController
{
    protected $helpers = ['form', 'text', 'cookie'];
    protected $session;

    public function __construct()
    {
        global $session;
        $session = session();
    }

    public function Index()
    {
        $data = [];
        //baru
        if ($this->request->is('post')) {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[3]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'email' => [
                    'required' => 'Email belum diisi',
                    'min_length' => 'Email kurang dari 6 karakter',
                    'max_length' => 'Email lebih dari 50 karakter',
                    'valid_email' => 'format email tidak sesuai'
                ],
                'password' => [
                    'validateUser' => 'Email atau Password salah'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                echo view('login');
            } else {
                $model = new PenggunaModel();
                //$model->join('piket','piket.kode_petugas = pengguna.kode_pengguna','inner');
                $user = $model->where('email', $this->request->getVar('email'))->first();
                $user['level'] = $this->siapaLogin($user, [$user['peran']]);
                //$model->join('kodenya','pengguna.kode_pengguna = piket.kode_petugas');

                //apakah walas ?
                $walasmodel = new WalasModel();
                $walikelas = $walasmodel->where('kode_walas', $user['kode_pengguna'])->first();
                if (!empty($walikelas['rombel'])) {
                    $user['walas'] = $walikelas['rombel'];
                }

                $piketmodel = new PiketModel();
                $piket = $piketmodel->where('kode_petugas', $user['kode_pengguna'])->orWhere('koordinator', $user['kode_pengguna'])->findAll();
                //d($piket);

                if ($piket) {


                    for ($p = 0; $p < count($piket); $p++) {
                        $user['piket'][] = $piket[$p];
                    }


                }

                // nanti ganti dg tupoksi
                $tutamodel = new TutaModel();
                $tuta = $tutamodel->where('kode_guru', $user['kode_pengguna'])->first();
                if (!empty($tuta['bidang'])) {
                    $user['tuta'] = $tuta;
                }

                $tupoksimodel = new TupoksiModel();
                $tupoksi = $tupoksimodel->where('kode_staf', $user['kode_pengguna'])->first();
                if (!empty($tupoksi['kode_staf'])) {
                    $user['tupoksi'] = $tupoksi;
                }
                //d($user);
                $this->setUserSession($user);

                //ingat
                if ($this->request->getVar('ingat') === '1') {
                    $token = random_string('alnum', 16);
                    set_cookie('skendava', $token, time() + (365 * 24 * 60 * 60));
                    $user['token'] = $token;
                    //d( $user );
                    $data_update['update']['token'] = $token;
                    $data['id'] = $user['id_pengguna'];
                    $data['update']['token'] = $token;
                    $this->update($data);
                }
                //d($user);
                if ($user['level'] == 'SuperAdmin') {
                    return redirect()->to('/admin')->withCookies();
                    // return redirect()->to(site_url('info'))->withCookies();
                    //redirect()->to('admin/dashboard');

                } 
                elseif ($user['level'] == 'Kepala Sekolah'){
                    return redirect()->to('/kepsek')->withCookies();

                }
                else {
                    return redirect()->to(site_url('info'))->withCookies();
                }
            }
        }
        //end post login normal
        else {

            if (get_cookie('skendava')) {

                $token = get_cookie('skendava');
                $model = new PenggunaModel();

                $user = $model->where('token', $token)->first();
                $walas = new WalasModel();
                $walikelas = $walas->where('kode_walas', $user['kode_pengguna'])->first();
                if (!empty($walikelas['rombel'])) {
                    $user['walas'] = $walikelas['rombel'];
                }
                $user['loginnya'] = 'dengan cookie';

                // d($user);
                $user['level'] = $this->siapaLogin($user, [$user['peran']]);
                $this->setUserSession($user);
                return redirect()->to(site_url('info'))->withCookies();
            } else {

                echo view('login');
            }
        }
        //end login cookies
    }
    //end index

    // public function autologin( $token ) {
    //   $model = new PenggunaModel();
    //   $user = $model->where( 'token', $token )->first();
    //   return redirect()->to( 'info' )->withCookies();
    //  }

    private function setUserSession($user)
    {
        $data = [
            'id_pengguna' => $user['id_pengguna'],
            'nama_lengkap' => $user['nama_lengkap'],
            'email' => $user['email'],
            'peran' => $user['peran'],
            'kode_pengguna' => $user['kode_pengguna'],
            'kode_absen' => $user['kode_absen'],
            'level' => $user['level'],
            //'tupoksi' => $user['tupoksi'],
            'token' => $user['token'],
            'isLoggedIn' => true,
        ];
        if (isset($user['walas'])) {
            $data['walas'] = $user['walas'];
            $data['jabatan']['Walikelas'] = 'Walikelas';
        }
        if (isset($user['piket'])) {
            //$data['tuta']=['Piket'];
            $data['piket'] = $user['piket'];
            $data['jabatan']['Piket'] = 'Piket';
        }
        if (isset($user['tuta'])) {
            //$data['tuta']=['Piket'];
            $data['tuta'] = $user['tuta'];
            $data['jabatan'][$user['tuta']['bidang']] = $user['tuta']['bidang'];
        }
        if ($this->request->getVar('password') == 'smkn2jaya') {
            $data['gantipassword'] = true;
        }

        session()->set($data);
        return true;
    }


    public function setSiswaSession($user)
    {
        // In a controller method or constructor

        global $session;

        $data = [
            'id_siswa' => $user['id_siswa'],
            'nama_siswa' => $user['nama_siswa'],
            'nis' => $user['nis'],
            'jk' => $user['jk'],
            'rombel' => $user['rombel'],
            'kode_walikelas' => $user['kode_walikelas'],
            'kode_kelas' => $this->kode_kelas($user['rombel']),
            'isLoggedIn' => true
        ];
        // d($data);
        if ($this->request->getVar('password') == 'skendava') {
            $data['gantipassword'] = true;
        }
        session()->set($data);
        // d($session->get());
        return true;
    }

    public function siapaLogin($user, $peran)
    {

        if ($user['peran'] == 1) {
            $login = 'Guru';
        } elseif ($user['peran'] == 2) {
            $login = 'Guru BP/BK';
        } elseif ($user['peran'] == 3) {
            $login = 'Walikelas';
        } elseif ($user['peran'] == 4) {
            $login = 'Kepala Sekolah';
        } elseif ($user['peran'] == 5) {
            $login = 'Admin';
        } elseif ($user['peran'] == -1) {
            $login = 'SuperAdmin';
        } elseif ($user['peran'] == 6) {
            $login = 'Tenaga Kependidikan';
        } elseif ($user['peran'] == 7) {
            $login = 'Sarpras';
        } elseif ($user['peran'] == 8) {
            $login = 'Pengelola Presensi';
        } elseif ($user['peran'] == 9) {
            $login = 'Piket';
        } else {
            $login = 'Siswa';
        }
        return $login;
    }

    private function setSessionPengguna($pengguna)
    {
        $data = [
            'id_pengguna' => $pengguna['id_pengguna'],
            'username' => $pengguna['username'],
            'jenis_user' => $pengguna['jenis_user'],
            'is_loggedin' => true,
        ];

        session()->set($data);
        return true;
    }

    public function logout()
    {
        session()->destroy();

        set_cookie('skendava', '', -1);
        //return redirect()->to( 'login' );
        echo view('login');
    }

    public function logoutsiswa()
    {
        session()->destroy();

        set_cookie('skendava', '', -1);
        //return redirect()->to( 'login' );
        echo view('loginsiswa');
    }

    public function gantipassword($id)
    {
        if ($this->request->is('post')) {

            $passwordbaru = $this->request->getVar('passwordbaru');
            $data['id'] = $id;
            $data['update']['password'] = $passwordbaru;
            $this->update($data);
            $this->logout();
            return redirect()->to('/');
        } else {
           $data = session()->get();
            //d( $data );
            return view('header')
                . view('menu', $data)
                . view('form_password')
                . view('footer');
        }
    }

    public function gantipasswordsiswa($id)
    {
        $data = session()->get();
        if ($this->request->is('post')) {

            $passwordbaru = $this->request->getVar('passwordbaru');
            $data['id_siswa'] = $id;
            $data['update']['password'] = password_hash($passwordbaru, PASSWORD_DEFAULT);
            ;
            $this->updatesiswa($data);
            $this->logout();
            return redirect()->to('/login/siswa');
        } else {

            // d($data);
            return view('header')
                . view('menusiswa', $data)
                . view('form_passwordsiswa')
                . view('footer');
        }
    }

    public function updatesiswa($data)
    {
        $siswa = new SiswaModel();
        $update = $siswa->update($data['id_siswa'], $data['update']);
    }

    public function update($data)
    {
        $pengguna = new PenggunaModel();
        $update = $pengguna->update($data['id'], $data['update']);
    }

    public function addCookie($token)
    {
        set_cookie('skendava', $token, 3600000, '/');
    }

    public function delCookie()
    {
        delete_cookie('skendava');
    }

    public function getCookie()
    {

        //return get_cookie( 'skendava' );
        echo has_cookie('skendava');
        //echo $cookie;
    }

    public function pengaturan()
    {
        $model = new PengaturanModel();
    }

    public function siswa()
    {
        $data = [];
        //baru
        if ($this->request->is('post')) {

            $rules = [
                'nis' => 'required|min_length[10]|max_length[10]',
                'password' => 'required|min_length[3]|max_length[255]|validateSiswa[nis,password]',
            ];

            $errors = [
                'nis' => [
                    'required' => 'NIS belum diisi, gunakan format misal 1025.012345',
                    'min_length' => 'Email kurang dari 10 karakter',
                    'max_length' => 'Email lebih dari 10 karakter',

                ],
                'password' => [
                    'validateSiswa' => 'NIS atau Password salah'
                ]
            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                echo view('loginsiswa');
            } else {
                $model = new SiswaModel();
                //$model->join('piket','piket.kode_petugas = pengguna.kode_pengguna','inner');
                $user = $model->where('nis', $this->request->getVar('nis'))->first();
                // $user['level'] = $this->siapaLogin($user, [$user['peran']]);
                //$model->join('kodenya','pengguna.kode_pengguna = piket.kode_petugas');



                // d($user);
                $this->setSiswaSession($user);


                // return true;  
                //ingat
                // if ($this->request->getVar('ingat') === '1') {
                //     $token = random_string('alnum', 16);
                //     set_cookie('skendava', $token, time() + (365 * 24 * 60 * 60));
                //     $user['token'] = $token;
                //     //d( $user );
                //     $data_update['update']['token'] = $token;
                //     $data['id'] = $user['id_pengguna'];
                //     $data['update']['token'] = $token;
                //     $this->update($data);
                // }
                // dd($data);
                return redirect()->to(site_url('infosiswa'))->withCookies();

            }

        }
        //end post login normal
        else {

            if (get_cookie('skendava')) {

                $token = get_cookie('skendava');
                $model = new SiswaModel();

                $user = $model->where('token', $token)->first();
                // $walas = new WalasModel();
                // $walikelas = $walas->where('kode_walas', $user['kode_pengguna'])->first();
                // if (!empty($walikelas['rombel'])) {
                //     $user['walas'] = $walikelas['rombel'];
                // }
                $user['loginnya'] = 'dengan cookie';

                // d($user);
                $user['level'] = $this->siapaLogin($user, [$user['peran']]);
                $this->setSiswaSession($user);
                return redirect()->to(site_url('info'))->withCookies();
            } else {

                echo view('loginsiswa');
            }
        }
        //end login cookies
    }
    //end index
    public function kode_kelas($rombel)
    {

        if (!empty($rombel)) {
            $arr = explode(" ", $rombel);
            $jenjang = ['X' => '1', 'XI' => '2', 'XII' => '3'];

            $jur_ = substr($arr[1], 0, -1);
            $jur = [
                'ATPH' => '1',
                'APHP' => '2',
                'TKR' => '3',
                'TITL' => '4',
                'DKV' => '5',
                'TKJ' => '6',
                'APL' => '7',
                'TSM' => '8'
            ];

            $kelas = substr($arr[1], -1);
            // dd($arr);

            $kode_kelas = $jenjang[$arr[0]] . $jur[$jur_] . $kelas;
            //   dd($kode_kelas);

            return $kode_kelas;
        }
    }
}
