<?php

namespace App\Controllers;
use Config\Services;
use App\Models\PenggunaModel;
use App\Models\WalasModel;
use App\Models\PiketModel;
use App\Models\TutaModel;

class Login extends BaseController {
    protected $helpers = [ 'form', 'text', 'cookie' ];

    public function Index() {
        $data = [];
        //baru
        if ( $this->request->is( 'post' ) ) {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[3]|max_length[255]|validateUser[email,password]',
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

            if ( ! $this->validate( $rules, $errors ) ) {
                $data[ 'validation' ] = $this->validator;
                echo view( 'login' );

            } else {
                $model = new PenggunaModel();
                //$model->join('piket','piket.kode_petugas = pengguna.kode_pengguna','inner');
                $user = $model->where( 'email', $this->request->getVar( 'email' ) )->first();
                $user[ 'level' ] = $this->siapaLogin( $user, [ $user[ 'peran' ] ] );
                //$model->join('kodenya','pengguna.kode_pengguna = piket.kode_petugas');
                
                //apakah walas ?
                $walasmodel = new WalasModel();
                $walikelas = $walasmodel->where( 'kode_walas', $user[ 'kode_pengguna' ] ) ->first();
                if (!empty($walikelas['rombel']))
                {
                    $user['walas']=$walikelas['rombel'];
                }
                
                $piketmodel = new PiketModel();
                $piket = $piketmodel->where( 'kode_petugas', $user[ 'kode_pengguna' ] ) ->first();
                if (!empty($piket['hari']))
                {
                    $user['piket']=$piket;
                }

                $tutamodel = new TutaModel();
                $tuta = $tutamodel->where( 'kode_guru', $user[ 'kode_pengguna' ] ) ->first();
                if (!empty($tuta['bidang']))
                {
                    $user['tuta']=$tuta;
                }
                //d($user);
                $this->setUserSession( $user );

                //ingat
                if ( $this->request->getVar( 'ingat' ) === '1' ) {
                    $token = random_string( 'alnum', 16 );
                    set_cookie( 'skendava', $token, time() + ( 365 * 24 * 60 * 60 ) );
                    $user[ 'token' ] = $token;
                    //d( $user );
                    $data_update[ 'update' ][ 'token' ] = $token;
                    $data[ 'id' ] = $user[ 'id_pengguna' ];
                    $data[ 'update' ][ 'token' ] = $token;
                    $this->update( $data );

                }
                //d($user);
                if ($user['level']==='Superadmin')
                {
                    return redirect()->to( site_url('admin') )->withCookies();
                }
                else {
                    return redirect()->to( site_url('info'))->withCookies();
                }
                

            }
        }
        //end post login normal
        else {

            if ( get_cookie( 'skendava' ) ) {

                $token = get_cookie( 'skendava' );
                $model = new PenggunaModel();

                $user = $model->where( 'token', $token )->first();
                $walas=new WalasModel();
                $walikelas = $walas->where( 'kode_walas', $user[ 'kode_pengguna' ] ) ->first();
                if (!empty($walikelas['rombel']))
                {
                    $user['walas']=$walikelas['rombel'];
                }
                $user['loginnya']='dengan cookie';
                //   d( $user );
                //echo $model->getLastQuery();
                //d( $user );
                $user[ 'level' ] = $this->siapaLogin( $user, [ $user[ 'peran' ] ] );
                $this->setUserSession( $user );
                return redirect()->to( site_url('info') )->withCookies();

            } else {

                echo view( 'login' );
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

    private function setUserSession( $user ) {
        $data = [
            'id_pengguna' => $user[ 'id_pengguna' ],
            'nama_lengkap' => $user[ 'nama_lengkap' ],
            'email' => $user[ 'email' ],
            'peran' => $user[ 'peran' ],
            'kode_pengguna' => $user[ 'kode_pengguna' ],
            'kode_absen' => $user[ 'kode_absen' ],
            'level' => $user[ 'level' ],
            'token' => $user[ 'token' ],
            'isLoggedIn' => true,
        ];
        if (isset($user['walas']))
                {
                    $data['walas']=$user['walas'];
                    $data['jabatan']['Walikelas']='Walikelas';
                }
                if (isset($user['piket']))
                {
                    //$data['tuta']=['Piket'];
                    $data['piket']=$user['piket'];
                    $data['jabatan']['Piket']='Piket';
                }
                if (isset($user['tuta']))
                {
                    //$data['tuta']=['Piket'];
                    $data['tuta']=$user['tuta'];
                    $data['jabatan'][$user['tuta']['bidang']]=$user['tuta']['bidang'];
                }
        if ( $this->request->getVar( 'password' ) == 'smkn2jaya' ) {
            $data[ 'gantipassword' ] = true;
        }

        session()->set( $data );
        return true;
    }

    public function siapaLogin( $user, $peran ) {

        if ( $user[ 'peran' ] == 1 ) {
            $login = 'Guru';
        } elseif ( $user[ 'peran' ] == 2 ) {
            $login = 'Guru BP/BK';
        } elseif ( $user[ 'peran' ] == 3 ) {
            $login = 'Walikelas';
        } elseif ( $user[ 'peran' ] == 4 ) {
            $login = 'Kepala Sekolah';
        } elseif ( $user[ 'peran' ] == 5 ) {
            $login = 'Admin';
        } elseif ( $user[ 'peran' ] = 10 ) {
            $login = 'Superadmin';
        } elseif ( $user[ 'peran' ] == 6 ) {
            $login = 'Piket';
        } elseif ( $user[ 'peran' ] == 7 ) {
            $login = 'Sarpras';
        } elseif ( $user[ 'peran' ] == 8 ) {
            $login = 'Pengelola Presensi';
        } elseif ( $user[ 'peran' ] == 9 ) {
            $login = 'Piket';
        } else {
            $login = 'Siswa';
        }
        return $login;

    }

    private function setSessionPengguna( $pengguna ) {
        $data = [
            'id_pengguna' => $pengguna[ 'id_pengguna' ],
            'username' => $pengguna[ 'username' ],
            'jenis_user' => $pengguna[ 'jenis_user' ],
            'is_loggedin' => true,
        ];

        session()->set( $data );
        return true;
    }

    public function logout() {
        session()->destroy();
        
        set_cookie( 'skendava', '', -1) ;
        //return redirect()->to( 'login' );
        echo view('login');

    }

    public function gantipassword( $id ) {
        if ( $this->request->is( 'post' ) ) {

            $passwordbaru = $this->request->getVar( 'passwordbaru' );
            $data[ 'id' ] = $id;
            $data[ 'update' ][ 'password' ] = $passwordbaru;
            $this->update( $data );
            $this->logout();
            return redirect()->to( '/' );

        } else {
            $data = $this->session->get();
            //d( $data );
            return view( 'header' )
            .view( 'menu', $data )
            .view( 'form_password' )
            .view( 'footer' );
        }

    }

    public function update( $data ) {
        $pengguna = new PenggunaModel();
        $update = $pengguna->update( $data[ 'id' ], $data[ 'update' ] );
    }

    public function addCookie( $token ) {
        set_cookie( 'skendava', $token, 3600000,'/' );

    }

    public function delCookie() {
        delete_cookie( 'skendava' );
    }

    public function getCookie() {

        //return get_cookie( 'skendava' );
        echo has_cookie( 'skendava' );
        //echo $cookie;
    }

}
