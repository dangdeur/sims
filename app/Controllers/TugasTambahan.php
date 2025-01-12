<?php

namespace App\Controllers;

use Config\Services;
use App\Models\AgendaTutaModel;
use App\Models\PbmModel;
use App\Models\TutaModel;

// class Agenda extends BaseController

class TugasTambahan extends Pbm
{
    protected $helpers = ['form', 'text', 'cookie', 'date'];
    protected $pbm;
    protected $session;

    public function index()
    {
        $data = session()->get();

        $agendatuta = new AgendaTutaModel();
        $agenda = $agendatuta->where('kode_staf', $data['kode_pengguna'])->findAll();

        
        //paginasi
        $data['agenda'] = $agendatuta->where('kode_staf', $data['kode_pengguna'])->orderBy('tanggal', 'DESC')->paginate(10);
        $data['pager'] = $agendatuta->pager;
        

        return view('header')
            . view('menu', $data)
            . view('daftaragendatuta')
            //  .view( 'paginasi' )
            . view('footer');
    }

    public function baru()
    {
        $data = session()->get();
        
        if ($this->request->is('get')) {
            $data['form'] = 1;
        }

        if ($this->request->is('post')) {
            $rules = [
                'aktifitas' => 'required',
                'jabatan' => 'required'

            ];

            $errors = [
                'aktifitas' => ['required' => 'Aktifitas belum diisi'],
                'jabatan' => ['required' => 'Jabatan belum diisi']

            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                return redirect()->back()->withInput();

            } else {
                $data['tuta']['jabatan']=$this->request->getVar('jabatan');
                $data['tuta']['tanggal'] = $this->request->getVar('tahun') . '-' . $this->request->getVar('bulan') . '-' . $this->request->getVar('tanggal');
                $data['tuta']['aktifitas'] = $this->request->getVar('aktifitas');
                $data['tuta']['agenda'] = 1;
                
                $data['tuta']['kode_staf'] = $data['kode_pengguna'];
                $data['tuta']['kode_agendatuta'] = $data['kode_pengguna'] . '-' . $this->request->getVar('tanggal') . $this->request->getVar('bulan') . $this->request->getVar('tahun');

                $agendatuta = new AgendaTutaModel();
                d( $data );
                $agendatuta->insert($data['tuta'], false);
                return redirect()->to('/tuta');

            }
        }

        //d( $data );
        return view('header')
            . view('menu', $data)
            . view('agendatutabaru')
            . view('footer');
    }

    //   function cari_nis( $nis, $array ) {
    //     foreach ( $array as $key => $val ) {
    //         if ( $val[ 'nis' ] === $nis ) {
    //             return $key;
    //         }
    //     }
    //     return null;
    //  }

    // public function simpan() {
    //     $model = new AgendaGuruModel();
    //     $guru = $this->request->getPost( 'kode_guru' );
    //     $rombel = $this->request->getPost( 'rombel_agenda' );
    //     $tanggal = date( 'dmY' );
    //     $kode_agenda = $guru.'-'.$tanggal.'-'.$rombel;
    //     $data = array(
    //         'rombel' => $rombel,
    //         'jp0' => $this->request->getPost( 'jp0' ),
    //         'jp1' => $this->request->getPost( 'jp1' ),
    //         'mapel' => $this->request->getPost( 'mapel_agenda' ),
    //         'materi' => $this->request->getPost( 'materi' ),
    //         'kode_agendaguru' => $kode_agenda,
    //         'kode_guru' => $guru,
    // );
    //     //dd( $data );
    //     $model->insert( $data, false );
    //     return redirect()->to( '/agendaguru' );
    // }

    public function hapus($id)
    {
        $data = session()->get();
        $model = new AgendaTutaModel();
        if ($this->request->is('post')) {
            $id = $this->request->getPost('id');
            $model->delete($id);
        } else {
            $data['agenda'] = $model->where('id_agendatuta', $id)->first();
            $data['konfirmasi'] = 1;
            return view('header')
                . view('menu', $data)
                . view('daftaragendatuta')

                . view('footer');
        }
        return redirect()->to('/tuta');

    }

    public function edit($id = FALSE)
    {
        $data = session()->get();
        $model = new AgendaTutaModel();
        if ($this->request->is('post')) {
            $data['tuta']['tanggal'] = $this->request->getVar('tahun') . '-' . $this->request->getVar('bulan') . '-' . $this->request->getVar('tanggal');
            $data['tuta']['aktifitas'] = $this->request->getVar('aktifitas');
            //$data[ 'tuta' ][ 'agenda' ] = 1;
            $data['tuta']['kode_staf'] = $data['kode_pengguna'];
            $data['tuta']['kode_agendatuta'] = $data['kode_pengguna'] . '-' . $this->request->getVar('tanggal') . $this->request->getVar('bulan') . $this->request->getVar('tahun');
            //d( $data );
            // $model->where( 'id_agendatuta', $id );
            $model->update($id, $data['tuta']);
            return redirect()->to('/tuta');
        } else {
            $data['agenda'] = $model->where('id_agendatuta', $id)->first();
            //d( $data );
            return view('header')
                . view('menu', $data)
                . view('editagendatuta')

                . view('footer');
        }

        //return redirect()->to( '/tuta' );

    }

}
