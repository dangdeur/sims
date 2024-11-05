<?php

namespace App\Controllers;

use Config\Services;
use App\Models\AgendaTutaModel;
use App\Models\PbmModel;
use App\Models\TutaModel;

// class Agenda extends BaseController

class Fp extends BaseController
{
    protected $helpers = ['form', 'text', 'cookie', 'date'];
    protected $session;

    public function index()
    {
        $data = session()->get();

        $agendatuta = new AgendaTutaModel();
        $agenda = $agendatuta->where('kode_staf', $data['kode_pengguna'])->findAll();

        //OK
        // $data[ 'agenda' ] = $agenda;
        //$data[ 'waktu' ] = $this->waktu();

        //paginasi
        $data['agenda'] = $agendatuta->where('kode_staf', $data['kode_pengguna'])->orderBy('tanggal', 'DESC')->paginate(10);
        $data['pager'] = $agendatuta->pager;
        //  $data[ 'fungsi' ] = $this;
        //$jadwal = $this->pbm->jadwal_data();
        // d( $jadwal );
        // senin =>
        //         10 =>
        //               kelas =>
        //               mapel =>
        // $data[ 'rombel' ] = $this->rombel_jadwal( $jadwal );
        // $data[ 'mapel' ] = $this->mapel_jadwal( $jadwal );

        //d( $data );

        return view('header')
            . view('menu', $data)
            . view('daftaragendatuta')
            //  .view( 'paginasi' )
            . view('footer');
    }

   

}
