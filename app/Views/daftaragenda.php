   <?= $this->extend('layout') ?>
   <?= $this->section('content') ?>
   <!-- <script type='text/javascript'>
           $(document).ready(function()
           {
              $('#exampleModal').modal('show');
           });
        </script> -->
   <div class="container">
     <?php

      if (isset($konfirmasi)) {

        echo 'Apakah anda yakin akan menghapus data agenda pembelajaran mapel <strong>' . $agenda['mapel'] . '</strong> untuk rombel <strong>' . $agenda['rombel'] . '</strong> ?';
        echo form_open('agendaguru/hapus/' . $agenda['id_agendaguru']);
        echo '<div class="row justify-content-md-center">
  <div class="col">';
        echo form_submit('hapus', 'Hapus!', ['class' => "btn btn-danger"]);
        echo '</div>';

        echo form_hidden($hid = ['id' => $agenda['id_agendaguru']]);
        echo form_close();
        echo '<div class="col">';
        echo '<a type="submit" class="btn btn-success" href="' . site_url('agendaguru') . '">Batal</a>';
        echo '</div>';
        echo '</div>';
        //echo '</div>';

      } else {
      ?>
       <main>
         <div class="py-5 text-center">
           <!-- <h1 class="text-danger">DATA SISWA BELUM VALID, BELUM BISA ISI PRESENSI, HANYA AGENDA GURU SAJA</h1> -->
           <!-- <img class="d-block mx-auto mb-4" src="<?= base_url('gambar/logo.png') ?>" alt="" width="72" height="72"> -->
           <h2>Rekap PBM Guru</h2>
           <a class="btn btn-success" href="<?= site_url('/agendaguru/lapor'); ?>">Lapor</a>

         <?php

          // echo date('l, j F Y, H:i');
          echo '<p class="lead">';
          if (empty($agenda) && !isset($form)) {
            echo 'Belum ada riwayat PBM anda</p>';
          }
          echo '</p>';

          // echo '<div class="row justify-content-md-center">';
          // echo '<div class="col col-md-2">';
          // echo '<a type="submit" class="btn btn-warning" href="'.site_url('agendaguru/baru_telat').'">Isi Agenda Terlewat</a>';
          // echo '</div>';
          // echo '<div class="col col-md-2">';
          // echo '<a type="submit" class="btn btn-primary" href="'.site_url('agendaguru/baru').'">Isi Agenda Saat Ini</a>';
          // echo '</div>';

          // echo '</div><br />';


          if (isset($agenda) && !empty($agenda) && !isset($form)) {

            echo $pager->links('default', 'paginasibootstrap');
            //echo $pager->links('default', 'paginasi');
            //echo $pager->links('default', 'default_full');
            //echo $pager->links('default', 'default_simple');


            echo '<table class="table">';
            echo '<thead style="position: sticky;top: 0" class="thead-dark">';
            echo '<tr>';
            echo '<th class="judul" scope="col">No</th><th class="judul">Tanggal</th><th class="judul">Rombel</th><th class="judul">Mapel</th><th class="judul">JP</th><th class="judul">Materi</th><th class="judul">Absensi</th><th></th>';
            echo '</tr>';
           echo '</thead><tbody>';
            $no_agenda = 1;
            for ($a = 0; $a < count($agenda); $a++) {
              $kode = explode("-", $agenda[$a]['kode_agendaguru']);
              $tgl = substr($kode[1], 0, 2);
              $bln = BULAN[substr($kode[1], 2, 2)];
              $thn = substr($kode[1], 4, 4);
              $tanggal = $tgl . " " . $bln . " " . $thn;
              $waktu = strtotime($thn . '-' . substr($kode[1], 2, 2) . '-' . $tgl);
              $hari = date('N', $waktu);
              //$jam=date('H:i:s',$waktu);
              //echo $hari;

              if ($hari == 5 && ($agenda[$a]['jp0'] > 8 || $agenda[$a]['jp1'] > 8)) {
                $pesan = '<br /><div Class="small text-bg-danger">Hari jumat maksimal 8 JP</div>';
                $error_jp = 'class="text-bg-danger"';
              } elseif ($hari == 6 || $hari == 7) {
                $pesan = '<br /><div Class="small text-bg-danger">Hari Sabtu/Minggu Tidak ada PBM</div>';
                $error_jp = 'class="text-bg-warning"';
              } else {
                $pesan = '';
                $error_jp = '';
              }

              //$tgl=substr($tanggal[1],0,2).' '.BULAN[substr($tanggal[1],3,2)];
              echo '<tr><td><a type="button" class="text-danger" href="' . site_url('agendaguru/hapus/' . $agenda[$a]['id_agendaguru']) . '"><i class="fa-regular fa-calendar-xmark"></i></a>
          ' . $no_agenda . '</td><td>' . $tanggal . $pesan . '</td><td>' . $agenda[$a]['rombel'] . '</td><td>' . $agenda[$a]['mapel'] . '</td>';
              //'-<label id="jam">00</label>:<label id="menit">00</label>:<label id="detik">00</label>'.
              echo '<td ' . $error_jp . '>' . $agenda[$a]['jp0'] . '-' . $agenda[$a]['jp1'] . '</td>';
              if ($agenda[$a]['status'] != NULL) {
                echo '<td>' . $agenda[$a]['materi'] . '</td><td>';
              } //end status lapor atau agenda
              else {
                echo '<td><a type="button" class="btn btn-warning" href="' . site_url('agendaguru/baru/' . $agenda[$a]['id_agendaguru']) . '">Isi Materi</a></td><td>';
              }



              if (is_null($agenda[$a]['absensi'])) {
                echo '<a type="button" class="btn btn-primary" href="' . site_url('agendaguru/presensi/' . $agenda[$a]['rombel']) . '/' . $agenda[$a]['id_agendaguru'] . '">Isi Presensi</a>';
              } else {
                $dataabsensi = json_decode($agenda[$a]['absensi'], true);

                echo '<a class="text-success" href="' . site_url('agendaguru/tambahpresensi/' . $agenda[$a]['id_agendaguru']) . '">
                <i class="fa-solid fa-user-plus"></i>
                 </a><br />';
                if (isset($dataabsensi['TL']) && count($dataabsensi['TL']) > 0) {

                  echo 'Terlambat : <br />';
                  foreach ($dataabsensi['TL'] as $tl) {
                    echo $tl['nama'] . ' <a class="text-danger" href="' . site_url('agendaguru/hapuspresensi/TL/' . $tl['nis']) . '/' . $agenda[$a]['id_agendaguru'] . '">
                                          <i class="fa-solid fa-user-xmark"></i>
                                    </a>';
                    if (!empty($tl['catatan'])) {
                      echo '<div class="small">(' . $tl['catatan'] . ')</div>';
                    }
                    echo '<br />';
                  }
                }


                if (isset($dataabsensi['BL']) && count($dataabsensi['BL']) > 0) {
                  echo 'Bolos : <br />';
                  foreach ($dataabsensi['BL'] as $bl) {
                    echo $bl['nama'] . ' <a class="text-danger" href="' . site_url('agendaguru/hapuspresensi/BL/' . $bl['nis']) . '/' . $agenda[$a]['id_agendaguru'] . '">
                                  <i class="fa-solid fa-user-xmark"></i></a>';
                    if (!empty($bl['catatan'])) {
                      echo '<div class="small">(' . $bl['catatan'] . ')</div>';
                    }
                    echo '<br />';
                  }
                }

                if (isset($dataabsensi['D']) && count($dataabsensi['D']) > 0) {
                  echo 'Dispensasi : <br />';
                  foreach ($dataabsensi['D'] as $d) {
                    echo $d['nama'] . ' <a class="text-danger" href="' . site_url('agendaguru/hapuspresensi/D/' . $d['nis']) . '/' . $agenda[$a]['id_agendaguru'] . '">
                      <i class="fa-solid fa-user-xmark"></i></a>';
                    if (!empty($d['catatan'])) {
                      echo '<div class="small">(' . $d['catatan'] . ')</div>';
                    }
                    echo '<br />';
                  }
                }


                if (isset($dataabsensi['S']) && count($dataabsensi['S']) > 0) {
                  echo 'Sakit : <br />';
                  foreach ($dataabsensi['S'] as $s) {
                    echo $s['nama'] . ' <a class="text-danger" href="' . site_url('agendaguru/hapuspresensi/S/' . $s['nis']) . '/' . $agenda[$a]['id_agendaguru'] . '">
                                  <i class="fa-solid fa-user-xmark"></i></a>';
                    if (!empty($s['catatan'])) {
                      echo '<div class="small">(' . $s['catatan'] . ')</div>';
                    }
                    echo '<br />';
                  }
                }


                if (isset($dataabsensi['I']) && count($dataabsensi['I']) > 0) {
                  echo 'Ijin : <br />';
                  foreach ($dataabsensi['I'] as $i) {
                    echo $i['nama'] . ' <a class="text-danger" href="' . site_url('agendaguru/hapuspresensi/I/' . $i['nis']) . '/' . $agenda[$a]['id_agendaguru'] . '">
                                <i class="fa-solid fa-user-xmark"></i></a>';
                    if (!empty($i['catatan'])) {
                      echo '<div class="small">(' . $i['catatan'] . ')</div>';
                    }
                    echo '<br />';
                  }
                }


                if (isset($dataabsensi['A']) && count($dataabsensi['A']) > 0) {
                  echo 'Alpa : <br />';
                  foreach ($dataabsensi['A'] as $alpa) {
                    echo $alpa['nama'] . ' <a class="text-danger" href="' . site_url('agendaguru/hapuspresensi/A/' . $alpa['nis']) . '/' . $agenda[$a]['id_agendaguru'] . '">
                                <i class="fa-solid fa-user-xmark"></i></a>';
                    if (!empty($alpa['catatan'])) {
                      echo '<div class="small">(' . $alpa['catatan'] . ')</div>';
                    }
                    echo '<br />';
                  }
                }
              }
              echo '</td>';

              echo '<td>';
              //echo '<a type="button" class="text-danger" href="'.site_url('agendaguru/hapus/'.$agenda[$a]['id_agendaguru']).'"><i class="fa-regular fa-calendar-xmark"></i></a>';
              //echo '<a type="button" class="btn btn-danger" href="'.site_url('agendaguru/hapus/'.$agenda[$a]['id_agendaguru']).'">Hapus</a>';
              echo '<a type="button" class="text-primary" href="' . site_url('agendaguru/edit/' . $agenda[$a]['id_agendaguru']) . '"><i class="fa-solid fa-pen-to-square"></i></a>';
              echo '</td>';
              echo '</tr>';
              $no_agenda++;
            }
            echo '</tbody></table>';
          }
        }
          ?>

         <!-- </main> -->

         <!-- Modal -->
         <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Lapor PBM</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
               </div>
               <div class="modal-body">
                 Dengan ini saya melapor kepada pimpinan,
                 <ul>
                   <li>Saya telah berada di ruang pelaksanaan pembelajaran</li>
                   <li>Saya siap memulai proses pembelajaran</li>
                 </ul>
                 Matapelajaran : , Rombel : <br />
                 Ruang Pembelajaran

               </div>
               <div class="modal-footer">
                 <!-- Waktu saat ini : <?php //echo date("h:m:s"); 
                                        ?> -->
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                 <button type="button" class="btn btn-primary">Lapor</button>
               </div>
             </div>
           </div>
         </div>


         </div>


         <script src="<?= base_url('js/checkout.js') ?>"></script>
         <script>
           var jamLabel = document.getElementById("jam");
           var menitLabel = document.getElementById("menit");
           var detikLabel = document.getElementById("detik");
           var totalSeconds = 0;
           setInterval(setTime, 1000);

           function setTime() {
             ++totalSeconds;
             detikLabel.innerHTML = pad(totalSeconds % 60);
             menitLabel.innerHTML = pad(parseInt(totalSeconds / 60));
             jamLabel.innerHTML = pad(parseInt(totalSeconds / 3600));
           }

           function pad(val) {
             var valString = val + "";
             if (valString.length < 2) {
               return "0" + valString;
             } else {
               return valString;
             }
           }
         </script>