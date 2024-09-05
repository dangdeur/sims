<?php
//d($agenda);
if (isset($agenda) && !empty($agenda)) {
    $rekap = [];
    for ($a = 0; $a < count($agenda); $a++) {
        //$rekap = [];
        $tanggal = explode("-", $agenda[$a]['kode_agendaguru']);
        $tgl = $tanggal[1];
        $data_detail_absen = json_decode($agenda[$a]['absensi'], true);



        // if (!isset($rekap[$tgl])) {

        //A
        if (isset($data_detail_absen['A'])) {
            foreach ($data_detail_absen['A'] as $ax => $ay) {
                $rekap[$tgl][$ay['nis']] =  'A';
            }
        }

        //S
        if (isset($data_detail_absen['S'])) {
            foreach ($data_detail_absen['S'] as $sx => $sy) {
                $rekap[$tgl][$sy['nis']] =  'S';
            }
        }

        //I
        if (isset($data_detail_absen['I'])) {
            foreach ($data_detail_absen['I'] as $ix => $iy) {
                $rekap[$tgl][$iy['nis']] =  'I';
            }
        }

        //TL
        if (isset($data_detail_absen['TL'])) {
            foreach ($data_detail_absen['TL'] as $tlx => $tly) {
                $rekap[$tgl][$tly['nis']] =  'TL';
            }
        }

        //BL
        if (isset($data_detail_absen['BL'])) {
            foreach ($data_detail_absen['BL'] as $blx => $bly) {
                $rekap[$tgl][$bly['nis']] =  'BL';
            }
        }

        //D
        if (isset($data_detail_absen['D'])) {
            foreach ($data_detail_absen['D'] as $dx => $dy) {
                $rekap[$tgl][$dy['nis']] =  'D';
            }
        }
        
    }
    //d($rekap);



?>
<div class="container">
<h4>Rekap PBM <?= $mapel_tm ?> : <?= $rombel_tm ?></h4><a class="btn btn-success" href="<?php base_url('agendaguru/tatapmuka'); ?>">Ganti Kelas/Mapel</a>
    <table class="table table-striped sticky-header">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <?php
                //$tgl_tm='';
                foreach ($rekap as $tgl_pbm => $absen_pbm) {
                    // $tgl_tm=substr($jum_tm[$b],0,4);
                    echo '<th>' . substr($tgl_pbm,0,4) . '</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>

        <?php
        $no = 1;
$jum_tm=count($rekap);
        for ($c = 0; $c < count($siswa); $c++) {


            echo '<tr>
                    <td>' . $no . '</td>
                    <td>' . $siswa[$c]['nis'] . '</td>
                    <td>' . $siswa[$c]['nama_siswa'] . '</td>';
                    $nis_cari=$siswa[$c]['nis'];

            foreach ($rekap as $tgl_tm) {
               
                 echo '<td>';
                    if (isset($tgl_tm[$nis_cari])) {
                        echo $tgl_tm[$nis_cari];
                    } else {
                        echo '-';
                    }
               
                echo '</td>';
               
            }
            echo '</tr>';
                $no++;
        }
        ?>
</tbody>
</table>
        <?php
    }
    else {
        echo 'Tidak ada data <a class="btn btn-success" href="'.base_url('agendaguru/tatapmuka').'">Ganti Kelas/Mapel</a>';
    }
        ?>


        
    </div>

    <script src="<?= base_url('bootstrap/extensions/sticky-header/bootstrap-table-sticky-header.js') ?>"></script>