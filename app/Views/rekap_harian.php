   
<div class="container">

  <main>
    <div class="py-5 text-center">
      <!-- <h1 class="text-danger">DATA SISWA BELUM VALID, BELUM BISA ISI PRESENSI, HANYA AGENDA GURU SAJA</h1> -->
      <!-- <img class="d-block mx-auto mb-4" src="<?= base_url('gambar/logo.png') ?>" alt="" width="72" height="72"> -->
      <h2>Kehadiran Harian</h2>
      
    <?php      

     if(isset($absen)){
      
      echo $pager->links('default', 'paginasibootstrap');
      //echo $pager->links('default', 'paginasi');
      //echo $pager->links('default', 'default_full');
      //echo $pager->links('default', 'default_simple');
      echo '<table class="table">';
      echo '<tr>';
      echo '<th>No</th><th>Tanggal</th><th>Waktu</th><th>Verifikasi</th><th>Status</th>';
      echo '</tr>';
      $no_absen=1;
      $tgl_sebelum='';
        for ($a=0;$a<count($absen);$a++)
        {
          $info_absen=explode(" ",$absen[$a]['waktu']);
          //d($absen[$a]);
          //tglindo
          $tgl=substr($info_absen[0],8,2);
          $bln=BULAN[substr($info_absen[0],5,2)];
          $thn=substr($info_absen[0],0,4);
          $tanggal= $tgl." ".$bln." ".$thn;
          if ($tgl_sebelum!=$tanggal)
          {
          //
          echo '<tr><td>'.$no_absen.'</td>';
          echo '<td>'.$tanggal.'</td>';
          echo '<td>'.$info_absen[1].'</td>';
          echo '<td>'.$absen[$a]['verifikasi'].'</td>';
          echo '<td>'.$absen[$a]['status'].'</td></tr>';
          $no_absen++;
          }
          // $tgl=substr($kode[1],0,2);
          // $bln=BULAN[substr($kode[1],2,2)];
          // $thn=substr($kode[1],4,4);
          // $tanggal= $tgl." ".$bln." ".$thn;
          // $waktu=strtotime($thn.'-'.substr($kode[1],2,2).'-'.$tgl);
          // $hari=date('N',$waktu);
          
          $tgl_sebelum=$tanggal;
         
        }

      echo '</table>';  
        
      } 
    
     ?>
     
  <!-- </main> -->


  
  
</div>



