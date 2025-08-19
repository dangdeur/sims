<?php

namespace App\Controllers;

use Config\Services;
use App\Models\PbmModel;
use CodeIgniter\I18n\Time;
use App\Models\SiswaModel;
use SebastianBergmann\Type\FalseType;

class Pbm extends BaseController
{
    protected $helpers = ['form', 'text', 'cookie'];
    protected $pbm = array();

    public function sesi()
    {
        global $data;
        if (isset($_SESSION['kode_pengguna'])) {
            $data = session()->get();
        } else {
            return redirect()->to('/logout');
        }
    }

    public function jadwal()
    {
        //$data = $this->session->get();
        $data = session()->get();
        //dd( $data );
        $pbmmodel = new PbmModel();
        $jadwal = $pbmmodel->where('kode_guru', $data['kode_pengguna'])->findAll();

        $data_jadwal = $this->olah_jadwal3($jadwal);

        $data['jadwal'] = $data_jadwal;
        $data['ramadhan'] = RAMADHAN;
        // d($jadwal);
        return view('header')
            . view('menu', $data)
            . view('jadwal')
            . view('footer');
    }

    public function jadwal_data()
    {
        $pbmmodel = new PbmModel();
        $data = session()->get();
        $jadwal = $pbmmodel->where('kode_guru', $data['kode_pengguna'])->findAll();

        $data_jadwal = $this->olah_jadwal3($jadwal);
        //d( $data_jadwal );
        return $data_jadwal;
    }

    public function jadwal_ekin()
    {
        $pbmmodel = new PbmModel();
        $data = session()->get();
        $jadwal = $pbmmodel->where('kode_guru', $data['kode_pengguna'])->findAll();

        $data_jadwal = $this->olah_jadwal2($jadwal);
        $kelas_cek = '';
        foreach ($data_jadwal as $harinya => $jadwalnya) {
            foreach ($jadwalnya as $j) {
                $jp = JAM_PBM[$j['jp']];
                $jpnya = explode('-', $jp);
                if ($kelas_cek != $j['kelas']) {

                    $data_ekin[$harinya][$j['kelas']] = [
                        'jp0' => $jpnya[0],
                        'mapel' => $j['mapel']
                    ];
                } else {
                    // jika kelasnya sama, gabungkan data
                    $data_ekin[$harinya][$j['kelas']]['jp1'] = $jpnya[1];
                }
                $kelas_cek = $j['kelas'];
            }
        }
        return $data_ekin;
    }

    public function jadwal_lapor()
    {
        $pbmmodel = new PbmModel();
        $data = session()->get();
        $jadwal = $pbmmodel->where('kode_guru', $data['kode_pengguna'])->findAll();

        $data_jadwal = $this->olah_jadwal2($jadwal);
        $kelas_cek = '';
        foreach ($data_jadwal as $harinya => $jadwalnya) {
            foreach ($jadwalnya as $j) {
                $jp = $j['jp'];
                //$jpnya = explode('-', $jp);
                if ($kelas_cek != $j['kelas']) {

                    $data_lapor[$harinya][$j['kelas']] = [
                        'jp0' => $jp,
                        'mapel' => $j['mapel']
                    ];
                } else {
                    // jika kelasnya sama, gabungkan data
                    $data_lapor[$harinya][$j['kelas']]['jp1'] = $jp;
                }
                $kelas_cek = $j['kelas'];
            }
        }
        return $data_lapor;
    }

    public function tglBulan($tahun, $bulan)
    {
        $bulantahun = $tahun . '-' . $bulan;
        $jumlah_hari = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
        for ($i = 1; $i <= $jumlah_hari; $i++) {
            $caritanggal = Time::parse($bulantahun . '-' . $i, 'Asia/Jakarta', 'id_ID');
            if ($caritanggal->format('w') == '1') {
                $tanggal[1][] = $i;
            }
            if ($caritanggal->format('w') == '2') {
                $tanggal[2][] = $i;
            }
            if ($caritanggal->format('w') == '3') {
                $tanggal[3][] = $i;
            }
            if ($caritanggal->format('w') == '4') {
                $tanggal[4][] = $i;
            }
            if ($caritanggal->format('w') == '5') {
                $tanggal[5][] = $i;
            }
        }
        return $tanggal;
    }

    public function jam_ke()
    {
        $data = array();

        $hari = date('w');

        $sekarang = Time::now('Asia/Jakarta', 'id_ID');
        $ramadhan = RAMADHAN;
        if (!$ramadhan) {

            if ($hari = 1) {
                $jp1 = '08:45';
                $jp2 = '09:30';
                $jp3 = '10:30';
                $jp4 = '11:15';
                $jp5 = '12:00';
                $jp6 = '13:10';
                $jp7 = '13:50';
                $jp8 = '14:30';
                $jp9 = '15:10';
                $jp10 = '15:50';
            } elseif ($hari = 2 || $hari = 3 || $hari = 4) {
                $jp1 = '08:00';
                $jp2 = '08:45';
                $jp3 = '09:30';
                $jp4 = '10:30';
                $jp5 = '11:15';
                $jp6 = '12:00';
                $jp7 = '13:10';
                $jp8 = '13:50';
                $jp9 = '14:30';
                $jp10 = '15:10';
            } elseif ($hari = 5) {
                $jp1 = '08:45';
                $jp2 = '09:30';
                $jp3 = '10:30';
                $jp4 = '11:15';
                $jp5 = '13:40';
                $jp6 = '14:20';
                $jp7 = '15:00';
            } else {
                $jp1 = '08:00';
                $jp2 = '08:45';
                $jp3 = '09:30';
                $jp4 = '10:30';
                $jp5 = '11:15';
                $jp6 = '12:00';
                $jp7 = '13:10';
                $jp8 = '13:50';
                $jp9 = '14:30';
                $jp10 = '15:10';
            }
        }
        //jika hari ramadhan
        else {
            if ($hari = 5) {
                $jp1 = '08:25';
                $jp2 = '08:50';
                $jp3 = '09:15';
                $jp4 = '09:40';
                $jp5 = '10:20';
                $jp6 = '10:45';
                $jp7 = '11:10';
                $jp8 = '11:35';
            } else {
                $jp1 = '08:25';
                $jp2 = '08:50';
                $jp3 = '09:15';
                $jp4 = '09:40';
                $jp5 = '10:05';
                $jp6 = '10:45';
                $jp7 = '11:10';
                $jp8 = '11:35';
                $jp9 = '12:00';
                $jp10 = '12:25';
            }
        }

        if ($hari == 5) 
            {
                if ($sekarang->isBefore($jp1, 'Asia/Jakarta')) {
                $data_jamke = '0';
            } elseif ($sekarang->isBefore($jp2, 'Asia/Jakarta')) {
                $data_jamke = '1';
            } elseif ($sekarang->isBefore($jp3, 'Asia/Jakarta')) {
                $data_jamke = '2';
            } elseif ($sekarang->isBefore($jp4, 'Asia/Jakarta')) {
                $data_jamke = '3';
            } elseif ($sekarang->isBefore($jp5, 'Asia/Jakarta')) {
                $data_jamke = '4';
            } elseif ($sekarang->isBefore($jp6, 'Asia/Jakarta')) {
                $data_jamke = '5';
            } elseif ($sekarang->isBefore($jp7, 'Asia/Jakarta')) {
                $data_jamke = '6';
            }
        } 
        elseif ($hari == 1 || $hari == 2 || $hari == 3 || $hari == 4) 
            {
                if ($sekarang->isBefore($jp1, 'Asia/Jakarta')) {
                $data_jamke = '0';
            } elseif ($sekarang->isBefore($jp2, 'Asia/Jakarta')) {
                $data_jamke = '1';
            } elseif ($sekarang->isBefore($jp3, 'Asia/Jakarta')) {
                $data_jamke = '2';
            } elseif ($sekarang->isBefore($jp4, 'Asia/Jakarta')) {
                $data_jamke = '3';
            } elseif ($sekarang->isBefore($jp5, 'Asia/Jakarta')) {
                $data_jamke = '4';
            } elseif ($sekarang->isBefore($jp6, 'Asia/Jakarta')) {
                $data_jamke = '5';
            } elseif ($sekarang->isBefore($jp7, 'Asia/Jakarta')) {
                $data_jamke = '6';
            } elseif ($sekarang->isBefore($jp8, 'Asia/Jakarta')) {
                $data_jamke = '7';
            } elseif ($sekarang->isBefore($jp9, 'Asia/Jakarta')) {
                $data_jamke = '8';
            } elseif ($sekarang->isBefore($jp10, 'Asia/Jakarta')) {
                $data_jamke = '9';
            } else {
                $data_jamke = '10';
            }
        } 
        else 
            {
            $data_jamke='100';
        }
        //$data_jamke=$data['jp'];
        return $data_jamke;
    }


    public function jadwal_kelas()
    {

        $kolom = date("w") . $this->jam_ke();

        $db = \Config\Database::connect();
        $builder = $db->table('jadwal');
        $builder->select('id_jadwal,kode_guru,nama_guru,' . $kolom);

        $builder->where('`' . $kolom . '` !=\'\'');
        $jadwal = $builder->get()->getResultArray();
        echo $db->getLastQuery();
        //d($jadwal);
    }

    // public function olah_jadwal($jadwal)
    // {
    //     $data = [];
    //     $hari = ['senin' => '1', 'selasa' => '2', 'rabu' => '3', 'kamis' => '4', 'jumat' => '5'];
    //     if (count($jadwal) > 0) {
    //         for (
    //             $a = 0;
    //             $a < count($jadwal);
    //             $a++
    //         ) {
    //             foreach ($hari as $h => $i) {
    //                 if ($this->cek($jadwal[$a][$i . '0'])) {
    //                     $data[$a][$h][$i . '0'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '0']), 'mapel' => $jadwal[$a]['mapel_guru']];
    //                 }

    //                 if ($this->cek($jadwal[$a][$i . '1'])) {
    //                     $data[$a][$h][$i . '1'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '1']), 'mapel' => $jadwal[$a]['mapel_guru']];
    //                 }

    //                 if ($this->cek($jadwal[$a][$i . '2'])) {
    //                     $data[$a][$h][$i . '2'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '2']), 'mapel' => $jadwal[$a]['mapel_guru']];
    //                 }

    //                 if ($this->cek($jadwal[$a][$i . '3'])) {
    //                     $data[$a][$h][$i . '3'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '3']), 'mapel' => $jadwal[$a]['mapel_guru']];

    //                 }

    //                 if ($this->cek($jadwal[$a][$i . '4'])) {
    //                     $data[$a][$h][$i . '4'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '4']), 'mapel' => $jadwal[$a]['mapel_guru']];

    //                 }

    //                 if ($this->cek($jadwal[$a][$i . '5'])) {
    //                     $data[$a][$h][$i . '5'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '5']), 'mapel' => $jadwal[$a]['mapel_guru']];

    //                 }

    //                 if ($this->cek($jadwal[$a][$i . '6'])) {
    //                     $data[$a][$h][$i . '6'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '6']), 'mapel' => $jadwal[$a]['mapel_guru']];

    //                 }

    //                 if ($this->cek($jadwal[$a][$i . '7'])) {
    //                     $data[$a][$h][$i . '7'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '7']), 'mapel' => $jadwal[$a]['mapel_guru']];

    //                 }

    //                 if ($i != 5) {
    //                     if ($this->cek($jadwal[$a][$i . '8'])) {
    //                         $data[$a][$h][$i . '8'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '8']), 'mapel' => $jadwal[$a]['mapel_guru']];

    //                     }
    //                     if ($this->cek($jadwal[$a][$i . '9'])) {
    //                         $data[$a][$h][$i . '9'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '9']), 'mapel' => $jadwal[$a]['mapel_guru']];

    //                     }
    //                 }
    //             }
    //         }
    //     }

    //     return $data;
    // }

    public function olah_jadwal2($jadwal)
    {
        $data = [];
        $hari = ['1' => '1', '2' => '2', '3' => '3', '4' => '4', '5' => '5'];
        if (count($jadwal) > 0) {
            for (
                $a = 0;
                $a < count($jadwal);
                $a++
            ) {
                foreach ($hari as $h => $i) {
                    if ($this->cek($jadwal[$a][$i . '0'])) {
                        $data[$h][] = ['jp' => $i . '0', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '0']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($this->cek($jadwal[$a][$i . '1'])) {
                        $data[$h][] = ['jp' => $i . '1', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '1']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($this->cek($jadwal[$a][$i . '2'])) {
                        $data[$h][] = ['jp' => $i . '2', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '2']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($this->cek($jadwal[$a][$i . '3'])) {
                        $data[$h][] = ['jp' => $i . '3', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '3']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($this->cek($jadwal[$a][$i . '4'])) {
                        $data[$h][] = ['jp' => $i . '4', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '4']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($this->cek($jadwal[$a][$i . '5'])) {
                        $data[$h][] = ['jp' => $i . '5', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '5']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($this->cek($jadwal[$a][$i . '6'])) {
                        $data[$h][] = ['jp' => $i . '6', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '6']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($i != 5) {

                        if ($this->cek($jadwal[$a][$i . '7'])) {
                            $data[$h][] = ['jp' => $i . '7', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '7']), 'mapel' => $jadwal[$a]['mapel_guru']];
                        }


                        if ($this->cek($jadwal[$a][$i . '8'])) {
                            $data[$h][] = ['jp' => $i . '8', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '8']), 'mapel' => $jadwal[$a]['mapel_guru']];
                        }
                        if ($this->cek($jadwal[$a][$i . '9'])) {
                            $data[$h][] = ['jp' => $i . '9', 'kelas' => $this->kelas_apa($jadwal[$a][$i . '9']), 'mapel' => $jadwal[$a]['mapel_guru']];
                        }
                    }
                }
            }
        }

        return $data;
    }

    public function olah_jadwal3($jadwal)
    {
        $data = [];
        $hari = ['Senin' => '1', 'Selasa' => '2', 'Rabu' => '3', 'Kamis' => '4', 'Jumat' => '5'];
        if (count($jadwal) > 0) {
            for (
                $a = 0;
                $a < count($jadwal);
                $a++
            ) {
                foreach ($hari as $h => $i) {
                    if ($this->cek($jadwal[$a][$i . '0'])) {
                        $data[$h][$i . '0'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '0']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($this->cek($jadwal[$a][$i . '1'])) {
                        $data[$h][$i . '1'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '1']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($this->cek($jadwal[$a][$i . '2'])) {
                        $data[$h][$i . '2'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '2']), 'mapel' => $jadwal[$a]['mapel_guru']];
                    }

                    if ($this->cek($jadwal[$a][$i . '3'])) {
                        $data[$h][$i . '3'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '3']), 'mapel' => $jadwal[$a]['mapel_guru']];
                        //$data[ $a ][ $h ][ $i.'3' ] = [];
                    }

                    if ($this->cek($jadwal[$a][$i . '4'])) {
                        $data[$h][$i . '4'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '4']), 'mapel' => $jadwal[$a]['mapel_guru']];
                        //$data[ $a ][ $h ][ $i.'4' ] = [];
                    }

                    if ($this->cek($jadwal[$a][$i . '5'])) {
                        $data[$h][$i . '5'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '5']), 'mapel' => $jadwal[$a]['mapel_guru']];
                        // $data[ $a ][ $h ][ $i.'5' ] = [];
                    }

                    if ($this->cek($jadwal[$a][$i . '6'])) {
                        $data[$h][$i . '6'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '6']), 'mapel' => $jadwal[$a]['mapel_guru']];
                        //$data[ $a ][ $h ][ $i.'6' ] = [];
                    }

                    if ($i != 5) {
                        if ($this->cek($jadwal[$a][$i . '7'])) {
                            $data[$h][$i . '7'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '7']), 'mapel' => $jadwal[$a]['mapel_guru']];
                            //$data[ $a ][ $h ][ $i.'7' ] = [];
                        }


                        if ($this->cek($jadwal[$a][$i . '8'])) {
                            $data[$h][$i . '8'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '8']), 'mapel' => $jadwal[$a]['mapel_guru']];
                            //$data[ $a ][ $h ][ $i.'8' ] = [];
                        }
                        if ($this->cek($jadwal[$a][$i . '9'])) {
                            $data[$h][$i . '9'] = ['kelas' => $this->kelas_apa($jadwal[$a][$i . '9']), 'mapel' => $jadwal[$a]['mapel_guru']];
                            // $data[ $a ][ $h ][ $i.'9' ] = [];
                        }
                    }
                    if (isset($data[$h])) {
                        ksort($data[$h]);
                    }
                }
            }
        }
        //$data = array_filter( $data );
        //d( $data );
        return $data;
    }

    public function kelas_apa($kelas)
    {
        if (!empty($kelas)) {
            $jenjang = ['1' => 'X', '2' => 'XI', '3' => 'XII'];
            $jur = [
                '1' => 'ATPH',
                '2' => 'APHP',
                '3' => 'TKR',
                '4' => 'TITL',
                '5' => 'DKV',
                '6' => 'TKJ',
                '7' => 'APL',
                '8' => 'TSM'
            ];
            $arr = str_split($kelas);

            if ($arr[0] == 'P') {
                $rombel = 'Piket';
            } else {
                $rombel = $jenjang[$arr[0]] . ' ' . $jur[$arr[1]] . $arr[2];
            }
        } else {
            $rombel = '';
        }
        return $rombel;
    }

    public function kode_kelas($rombel)
    {

        if (!empty($rombel)) {
            $arr = str_split($rombel);
            $jenjang = ['X' => '1', 'XI' => '2', '3' => 'XII'];
            $jur = [
                '1' => 'ATPH',
                '2' => 'APHP',
                '3' => 'TKR',
                '4' => 'TITL',
                '5' => 'DKV',
                '6' => 'TKJ',
                '7' => 'APL',
                '8' => 'TSM'
            ];


            if ($arr[0] == 'P') {
                $rombel = 'Piket';
            } else {
                $rombel = $jenjang[$arr[0]] . ' ' . $jur[$arr[1]] . $arr[2];
            }
        } else {
            $rombel = '';
        }
        return $rombel;
    }

    public function cek($data)
    {
        if (isset($data) && !empty($data)) {

            return true;
        }
        return false;
    }

    public function gabung_jadwal3($data)
    {
        $jadwal = [];
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                if (isset($value['senin'])) {
                    $jadwal['Senin'][$key] = $value['senin'];
                }

                if (isset($value['selasa'])) {
                    $jadwal['Selasa'][$key] = $value['selasa'];
                }

                if (isset($value['rabu'])) {
                    $jadwal['Rabu'][$key] = $value['rabu'];
                }

                if (isset($value['kamis'])) {
                    $jadwal['Kamis'][$key] = $value['kamis'];
                }

                if (isset($value['jumat'])) {
                    $jadwal['Jumat'][$key] = $value['jumat'];
                }
            }
        }
        //dd( $jadwal );
        usort($jadwal, fn($a, $b) => $a['Senin']['jp'] <=> $b['Senin']['jp']);
        return $jadwal;
    }

    // public function gabung_jadwal2($data)
    // {
    //     $jadwal = [];
    //     if (is_array($data)) {
    //         foreach ($data as $key => $value) {
    //             if (isset($value['senin'])) {
    //                 $jadwal['Senin'][] = $value['senin'];
    //             }

    //             if (isset($value['selasa'])) {
    //                 $jadwal['Selasa'][] = $value['selasa'];
    //             }

    //             if (isset($value['rabu'])) {
    //                 $jadwal['Rabu'][] = $value['rabu'];
    //             }

    //             if (isset($value['kamis'])) {
    //                 $jadwal['Kamis'][] = $value['kamis'];
    //             }

    //             if (isset($value['jumat'])) {
    //                 $jadwal['Jumat'][] = $value['jumat'];
    //             }
    //         }
    //     }

    //     usort($jadwal, fn($a, $b) => $a['Senin']['jp'] <=> $b['Senin']['jp']);
    //     return $jadwal;
    // }

    // public function gabung_jadwal($data)
    // {
    //     $jadwal = [];
    //     if (is_array($data)) {
    //         foreach ($data as $key => $value) {
    //             if (isset($value['senin'])) {

    //                 if (array_key_exists('Senin', $jadwal)) {
    //                     $jadwal['Senin'] = array_merge(array_values($value['senin']), array_values($jadwal['Senin']));
    //                 } else {
    //                     $jadwal['Kamis'] = $value['kamis'];
    //                 }
    //             }

    //             if (isset($value['selasa'])) {

    //                 if (array_key_exists('Selasa', $jadwal)) {
    //                     $jadwal['Selasa'] = array_merge(array_values($value['selasa']), array_values($jadwal['Selasa']));
    //                 } else {
    //                     $jadwal['Selasa'] = $value['selasa'];
    //                 }
    //             }

    //             if (isset($value['rabu'])) {

    //                 if (array_key_exists('Rabu', $jadwal)) {
    //                     $jadwal['Rabu'] = array_merge(array_values($value['rabu']), array_values($jadwal['Rabu']));
    //                 } else {
    //                     $jadwal['Rabu'] = $value['rabu'];
    //                 }
    //             }

    //             if (isset($value['kamis'])) {
    //                 if (array_key_exists('Kamis', $jadwal)) {
    //                     $jadwal['Kamis'] = array_merge(array_values($value['kamis']), array_values($jadwal['Kamis']));
    //                 } else {
    //                     $jadwal['Kamis'] = $value['kamis'];
    //                 }
    //             }

    //             if (isset($value['jumat'])) {

    //                 if (array_key_exists('Jumat', $jadwal)) {
    //                     $jadwal['Jumat'] = array_merge(array_values($value['jumat']), array_values($jadwal['Jumat']));
    //                 } else {
    //                     $jadwal['Jumat'] = $value['jumat'];
    //                 }
    //             }
    //         }
    //     }

    //     return $jadwal;
    // }

    // public function _gabung_jadwal($data)
    // {
    //     $jadwal = [];
    //     if (is_array($data)) {
    //         foreach ($data as $key => $value) {
    //             if (isset($value['senin'])) {
    //                 $jadwal['Senin'][] = $value['senin'];
    //             }

    //             if (isset($value['selasa'])) {
    //                 $jadwal['Selasa'][] = $value['selasa'];
    //             }

    //             if (isset($value['rabu'])) {
    //                 $jadwal['Rabu'][] = $value['rabu'];
    //             }

    //             if (isset($value['kamis'])) {
    //                 $jadwal['Kamis'][] = $value['kamis'];
    //             }

    //             if (isset($value['jumat'])) {
    //                 $jadwal['Jumat'][] = $value['jumat'];
    //             }
    //         }
    //     }

    //     return $jadwal;
    // }





    public function del_arr($arr, $del)
    {
        foreach ($del as $a) {
            unset($arr[$a]);
        }
        return $arr;
    }

    public function ijin_siswa()
    {
        global $data;
        $this->sesi();

        if ($siswa_cari != '') {
            $siswa = new SiswaModel();
            $data['nama_siswa'] = $siswa->where(['nama_siswa' => $siswa_cari])->findAll();

            echo json_encode($data['nama_siswa']);
        } else {
            echo 'rombel =' . $rombel;
        }
    }

    public function istirahatkah()
    {
    }
}
