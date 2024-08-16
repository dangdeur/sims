   
<div class="container">
 <?php 
     
if(isset($konfirmasi))
{
  $kode=explode("-",$agenda['kode_agendatuta']);
          $tgl=substr($kode[1],0,2);
          $bln=BULAN[substr($kode[1],2,2)];
          $thn=substr($kode[1],4,4);
          $tanggal= $tgl." ".$bln." ".$thn;
  echo 'Apakah anda yakin akan menghapus laporan tanggal <strong>'.$agenda['tanggal'].'</strong> untuk aktifitas <strong>'.$agenda['aktifitas'].'</strong> ?';
  echo form_open('tuta/hapus/'.$agenda['id_agendatuta']);
  echo '<div class="row justify-content-md-center">
  <div class="col">';
  echo form_submit('hapus', 'Hapus!',['class'=>"btn btn-danger"]);
  echo '</div>';

  echo form_hidden($hid=['id'=>$agenda['id_agendatuta']]);
  echo form_close();
  echo '<div class="col">';
  echo '<a type="submit" class="btn btn-success" href="'.site_url('agendaguru').'">Batal</a>';
  echo '</div>';
  echo '</div>';
  //echo '</div>';
 
}
else {
?>
  <main>
    <div class="py-5 text-center">
      <!-- <h1 class="text-danger">DATA SISWA BELUM VALID, BELUM BISA ISI PRESENSI, HANYA AGENDA GURU SAJA</h1> -->
      <!-- <img class="d-block mx-auto mb-4" src="<?= base_url('gambar/logo.png') ?>" alt="" width="72" height="72"> -->
      <h2>Agenda Tugas Tambahan <?= $nama_lengkap ?></h2>
      <?php
     
        echo date('l, j F Y, H:i');
        echo '<p class="lead">';
        if (empty($agenda) && !isset($form))
        {
          echo 'Belum ada riwayat pelaksanaan tugas</p>';
        }
        echo '</p>';
        
        echo '<div class="row justify-content-md-center">';
        // echo '<div class="col col-md-2">';
        // echo '<button type="button" class="btn btn-success btn-lg" data-bs-toggle="modal" data-bs-target="#exampleModal">Lapor PBM</button>';
        // echo '</div>';
        echo '<div class="col col-md-2">';
        echo '<a type="submit" class="btn btn-primary btn-lg" href="'.site_url('tutabaru').'">Lapor Aktifitas</a></div>';
        echo '</div>';
        echo '</div>';
       

     if(isset($agenda) && !empty($agenda) && !isset($form)){
      
      echo $pager->links('default', 'paginasi');
      echo '<table class="table">';
      echo '<tr>';
      echo '<th style="width: 5%;"></th><th style="width: 5%;">No</th><th style="width: 20%;">Tanggal</th><th style="width: 70%;">Aktifitas</th><th></th>';
      echo '</tr>';
      $no_agenda=1;
        for ($a=0;$a<count($agenda);$a++)
        {
          $kode=explode("-",$agenda[$a]['kode_agendatuta']);
          $tgl=substr($kode[1],0,2);
          $bln=BULAN[substr($kode[1],2,2)];
          $thn=substr($kode[1],4,4);
          $tanggal= $tgl." ".$bln." ".$thn;

          //$tgl=substr($tanggal[1],0,2).' '.BULAN[substr($tanggal[1],3,2)];
          echo '<tr><td><a type="button" class="text-danger" href="'.site_url('tuta/hapus/'.$agenda[$a]['id_agendatuta']).'"><i class="fa-regular fa-calendar-xmark"></i></a>
          <a type="button" class="text-danger" href="'.site_url('tutaedit/'.$agenda[$a]['id_agendatuta']).'"><i class="fa-solid fa-pen-to-square"></i></a></td><td>
          '.$no_agenda.'</td><td>'.$tanggal.'</td><td>'.$agenda[$a]['aktifitas'].'</td>
          <td>';
          
         
          echo '</td>';
          
          echo '<td>';
          //echo '<a type="button" class="text-danger" href="'.site_url('agendaguru/hapus/'.$agenda[$a]['id_agendaguru']).'"><i class="fa-regular fa-calendar-xmark"></i></a>';
          //echo '<a type="button" class="btn btn-danger" href="'.site_url('agendaguru/hapus/'.$agenda[$a]['id_agendaguru']).'">Hapus</a>';
          echo '</td>';
          echo '</tr>';
          $no_agenda++;
        
        }
      echo '</table>';  
        
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
        <!-- Waktu saat ini : <?php //echo date("h:m:s"); ?> -->
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
        <button type="button" class="btn btn-primary">Lapor</button>
      </div>
    </div>
  </div>
</div>
  
  
</div>


<script src="<?= base_url('js/checkout.js') ?>"></script>
