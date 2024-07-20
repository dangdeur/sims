<?php

namespace App\Controllers;
use Config\Services;
use App\Models\PenggunaModel;
use App\Models\WalasModel;

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

            } else {
                $model = new PenggunaModel();
                $user = $model->where( 'email', $this->request->getVar( 'email' ) )->first();
                $user[ 'level' ] = $this->siapaLogin( $user, [ $user[ 'peran' ] ] );
                //apakah walas ?
                $walas=new WalasModel();
                $walikelas = $walas->where( 'kode_walas', $user['kode_pengguna'] ) ->first();
                $this->setUserSession( $user );

                //ingat
                if ( $this->request->getVar( 'ingat' ) == 1 ) {
                    $token = random_string( 'alnum', 16 );
                    $user[ 'token' ] = $token;
                     //dd( $user );
                     $data_update['update']['token']=$token;
                     $data[ 'id' ] = $user[ 'id_pengguna' ];
                        $data[ 'update' ][ 'token' ] = $token;
                        $this->update( $data );
                    //$update = $model->update( $user[ 'id_pengguna' ], $data_update );
                    //set_cookie( 'skendava', $user[ 'token' ], 360000 );
                    $this->addCookie( $token );
                }
                return redirect()->to( 'info' );
            }
        }
        //end post login normal
        else {

            //if ( !is_null( has_cookie( 'skendava' ) ) ) {
             if ( $this -> getCookie() ) {
                // $data = $this->session->get();
                $token = $this -> getCookie();
                $model = new PenggunaModel();

                $user = $model->where( 'token', $token )->first();
                //   d( $user );
                echo $model->getLastQuery();
                d( $user );
                $user[ 'level' ] = $this->siapaLogin( $user, [ $user[ 'peran' ] ] );
                $this->setUserSession( $user );
                return redirect()->to( 'info' )->withCookies();

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
            'level' => $user[ 'level' ],
            'token' => $user[ 'token' ],
            'isLoggedIn' => true,
        ];
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
        } elseif ( $user[ 'peran' ] == 10 ) {
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
        //return redirect()->to( 'login' );
        $this->delCookie();
        echo view( 'login' );

    }

    public function addCookie( $token ) {
        set_cookie( 'skendava', $token, 3600000 );

    }

    public function delCookie() {
        delete_cookie( 'skendava' );
    }

    public function getCookie() {

        return get_cookie( 'skendava' );
        //echo has_cookie( 'skendava' );
        //echo $cookie;
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

}
