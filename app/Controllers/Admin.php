<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use Config\Services;
use App\Models\AgendaGuruModel;
use App\Models\PenggunaModel;
use App\Models\PbmModel;
use App\Models\WalasModel;

class Admin extends BaseController
{
    
    public function index()
    {
        $data = $this->session->get();
        
        return view('admin/header')
         .view('admin/menu',$data)
         .view('admin/index')
       .view('admin/footer');
    }
    public function Isitgldibuat()
    {
        $agendamodel = new AgendaGuruModel();
        $agenda = $agendamodel->where('dibuat', '')->findAll();
        //dd($agenda);
    }

    public function ambil_alih ($id=FALSE)
    {
        $data = $this->session->get();
        $pengguna = new PenggunaModel();
        if ($id === false)
        {
        
        $data['pengguna']=$pengguna->findAll();
        //d($data);

        return view('admin/header')
         .view('admin/menu',$data)
       .view('admin/ambilalih',$data)
         .view('admin/footer');
        }
        else {
           
                $user = $pengguna->where( 'id_pengguna', $id)->first();
                $user[ 'level' ] = $this->siapaLogin( $user, [ $user[ 'peran' ] ] );
                //apakah walas ?
                $walas = new WalasModel();
                $walikelas = $walas->where( 'kode_walas', $user[ 'kode_pengguna' ] ) ->first();
                if (!empty($walikelas['rombel']))
                {
                    $user['walas']=$walikelas['rombel'];
                }
                
                //dd($walikelas);
                $this->setUserSession( $user );
                return redirect()->to( 'info' );
        }

    }

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
        if (isset($user['walas']))
                {
                    $data['walas']=$user['walas'];
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

    public function reset( $id ) {
       
        $passwordbaru = 'smkn2jaya';
        $pengguna = new PenggunaModel();
        //$data[ 'id' ] = $id;
        //$data[ 'update' ][ 'password' ] = $passwordbaru;
        $update = $pengguna->update( $id, ['password'=>$passwordbaru]);
        return redirect()->to( '/admin' );

    

   
    }

    
}
