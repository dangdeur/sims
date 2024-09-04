<?php
d($agenda);
if (isset($agenda) && !empty($agenda)) {
    //$rekap = [];
    for ($a = 0; $a < count($agenda); $a++) {
        $rekap = [];
        $tanggal = explode("-", $agenda[$a]['kode_agendaguru']);
        $tgl = $tanggal[1];
        $data_detail_absen = json_decode($agenda[$a]['absensi'], true);

        foreach ($data_detail_absen as $absennya => $orangnya)
        {
            //$rekap[$orangnya['nis']]=$absennya;
            echo $tgl."-".$absennya."<br />";
            d($orangnya);
        }

        // if (!isset($rekap[$tgl])) {
            
        //     if (isset($data_detail_absen['A'])) {
        //         foreach ($data_detail_absen['A'] as $ax => $ay) {
                  
        //            $rekap[$tgl][$ay['nis']] =  'A';
                 
        //         }
        //     }
            
        // }
        // else {
        //     foreach ($data_detail_absen['A'] as $ax => $ay) {
        //     $rekap[$tgl][]= [$ay['nis']=>'A'];
        //     }
        // } 
    //    d($data_detail_absen);
    //    echo '---------------------';


    }
    dd($rekap);



?>
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <?php
                //$tgl_tm='';
                foreach ($rekap as $tgl_pbm => $absen_pbm) {
                    // $tgl_tm=substr($jum_tm[$b],0,4);
                    echo '<th>' . $tgl_pbm . '</th>';
                }
                ?>
            </tr>
        </thead>
        <tbody>

        <?php
        $no = 1;

        for ($c = 0; $c < count($siswa); $c++) {

            echo '<tr>
                    <td>' . $no . '</td>
                    <td>' . $siswa[$c]['nis'] . '</td>
                    <td>' . $siswa[$c]['nama_siswa'] . '</td>';


            for ($d = 0; $d < count($rekap); $d++) {
                if (isset($rekap[$tgl_pbm][$siswa[$c]['nis']])) {
                    echo '<td>' . $rekap[$tgl_pbm][$siswa[$c]['nis']] . '</td>';
                }
            }
            echo '</tr>';
            $no++;
        }
    }
        ?>


        </tbody>
    </table>