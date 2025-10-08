<?php

namespace App\Controllers;

use Config\Services;
use App\Models\AgendaTendikModel;
use App\Models\PbmModel;
use App\Models\tendikModel;

// class Agenda extends BaseController

class Tendik extends Pbm
{
    protected $helpers = ['form', 'text', 'cookie', 'date'];
    protected $pbm;
    protected $session;

    public function index()
    {
        $data = session()->get();

        $agendatendik = new AgendatendikModel();
        $agenda = $agendatendik->where('kode_staf', $data['kode_pengguna'])->findAll();

        
        //paginasi
        $data['agenda'] = $agendatendik->where('kode_staf', $data['kode_pengguna'])->orderBy('tanggal', 'ASC')->paginate(10);
        $data['pager'] = $agendatendik->pager;
        

        return view('header')
            . view('menu', $data)
            . view('daftaragendatendik')
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
                'aktifitas' => 'required'
                //'jabatan' => 'required'

            ];

            $errors = [
                'aktifitas' => ['required' => 'Aktifitas belum diisi']
                //'jabatan' => ['required' => 'Jabatan belum diisi']

            ];

            if (!$this->validate($rules, $errors)) {
                $data['validation'] = $this->validator;
                return redirect()->back()->withInput();

            } else {
                //$data['tendik']['jabatan']=$this->request->getVar('jabatan');
                $data['tendik']['tanggal'] = $this->request->getVar('tahun') . '-' . $this->request->getVar('bulan') . '-' . $this->request->getVar('tanggal');
                $data['tendik']['aktifitas'] = $this->request->getVar('aktifitas');
                $data['tendik']['agenda'] = 1;
                
                $data['tendik']['kode_staf'] = $data['kode_pengguna'];
                $data['tendik']['kode_agendatendik'] = $data['kode_pengguna'] . '-' . $this->request->getVar('tanggal') . $this->request->getVar('bulan') . $this->request->getVar('tahun');

                $agendatendik = new AgendatendikModel();
                //d( $data );
                $agendatendik->insert($data['tendik'], false);
                return redirect()->to('/tendik');

            }
        }

        //d( $data );
        return view('header')
            . view('menu', $data)
            . view('agendatendikbaru')
            . view('footer');
    }

    

    public function hapus($id)
    {
        $data = session()->get();
        $model = new AgendaTendikModel();
        if ($this->request->is('post')) {
            $id = $this->request->getPost('id');
            $model->delete($id);
        } else {
            $data['agenda'] = $model->where('id_agendatendik', $id)->first();
            $data['konfirmasi'] = 1;
            return view('header')
                . view('menu', $data)
                . view('daftaragendatendik')

                . view('footer');
        }
        return redirect()->to('/tendik');

    }

    public function edit($id = FALSE)
    {
        $data = session()->get();
        $model = new AgendaTendikModel();
        if ($this->request->is('post')) {
            $data['tendik']['tanggal'] = $this->request->getVar('tahun') . '-' . $this->request->getVar('bulan') . '-' . $this->request->getVar('tanggal');
            $data['tendik']['aktifitas'] = $this->request->getVar('aktifitas');
            //$data[ 'tendik' ][ 'agenda' ] = 1;
            $data['tendik']['kode_staf'] = $data['kode_pengguna'];
            $data['tendik']['kode_agendatendik'] = $data['kode_pengguna'] . '-' . $this->request->getVar('tanggal') . $this->request->getVar('bulan') . $this->request->getVar('tahun');
            //d( $data );
            // $model->where( 'id_agendatendik', $id );
            $model->update($id, $data['tendik']);
            return redirect()->to('/tendik');
        } else {
            $data['agenda'] = $model->where('id_agendatendik', $id)->first();
            //d( $data );
            return view('header')
                . view('menu', $data)
                . view('editagendatendik')

                . view('footer');
        }

        //return redirect()->to( '/tendik' );

    }

}
