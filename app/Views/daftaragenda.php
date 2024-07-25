   
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container">
 <?php 
     
if(isset($konfirmasi))
{
  
  echo 'Apakah anda yakin akan menghapus data agenda pembelajaran mapel <strong>'.$agenda['mapel'].'</strong> untuk rombel <strong>'.$agenda['rombel'].'</strong> ?';
  echo form_open('agendaguru/hapus/'.$agenda['id_agendaguru']);
  echo '<div class="row">
  <div class="col">';
  echo form_submit('hapus', 'Hapus!',['class'=>"btn btn-danger"]);
  echo '</div>';

  echo form_hidden($hid=['id'=>$agenda['id_agendaguru']]);
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
      <h2>Agenda Guru <?= $nama_lengkap ?></h2>
      <?php
      //echo $hari.", ".$tanggal." ".$bulan." ".$tahun." ".$jam;
     
      
      // if (empty($agenda) && !isset($form))
      // {
        //d($agenda);
        echo date('l, j F Y, H:i');
        echo '<p class="lead">';
        if (empty($agenda) && !isset($form))
        {
          echo 'Belum ada riwayat PBM anda</p>';
        }
        echo '</p>';
        echo '<a type="submit" class="btn btn-primary btn-lg" href="'.site_url('agendaguru/baru').'">Isi Agenda</a></div>';
     // }

     if(isset($agenda) && !empty($agenda) && !isset($form)){
      
      echo $pager->links('default', 'paginasi');
      echo '<table class="table">';
      echo '<tr>';
      echo '<th>No</th><th>Tanggal</th><th>Rombel</th><th>Mapel</th><th>Materi</th><th>JP</th><th>Absensi</th><th></th>';
      echo '</tr>';
      $no_agenda=1;
        for ($a=0;$a<count($agenda);$a++)
        {
          echo '<tr><td><a type="button" class="text-danger" href="'.site_url('agendaguru/hapus/'.$agenda[$a]['id_agendaguru']).'"><i class="fa-regular fa-calendar-xmark"></i></a>
          '.$no_agenda.'</td><td>'.$agenda[$a]['dibuat'].'</td><td>'.$agenda[$a]['rombel'].'</td><td>'.$agenda[$a]['mapel'].'</td><td>'.$agenda[$a]['materi'].'</td><td>'.$agenda[$a]['jp0'].'-'.$agenda[$a]['jp1'].'</td>
          <td>';
          
          if (is_null($agenda[$a]['absensi']))
          {
            echo '<a type="button" class="btn btn-primary" href="'.site_url('agendaguru/presensi/'.$agenda[$a]['rombel']).'/'.$agenda[$a]['id_agendaguru'].'">Isi Presensi</a>';
          }
          else {
            $dataabsensi=json_decode($agenda[$a]['absensi'],true);
            
            echo '<a class="text-success" href="'.site_url('agendaguru/tambahpresensi/'.$agenda[$a]['id_agendaguru']).'">
                  <i class="fa-solid fa-user-plus"></i>
                  </a><br />';
            if (isset($dataabsensi['TL']) && count($dataabsensi['TL'])>0)
            {
            
            echo 'Terlambat : <br />';
            foreach ($dataabsensi['TL'] as $tl)
              {
                echo $tl['nama'] . ' <a class="text-danger" href="'.site_url('agendaguru/hapuspresensi/TL/'.$tl['nis']).'/'.$agenda[$a]['id_agendaguru'].'">
                                          <i class="fa-solid fa-user-xmark"></i>
                                    </a>';
                if(!empty($tl['catatan']))
                  {
                    echo '<div class="small">('.$tl['catatan'].')</div>';
                  }
                  echo '<br />';
              }
            }
            

            if (isset($dataabsensi['BL']) && count($dataabsensi['BL'])>0)
            {
            echo 'Bolos : <br />';
            foreach ($dataabsensi['BL'] as $bl)
              {
                echo $bl['nama'].' <a class="text-danger" href="'.site_url('agendaguru/hapuspresensi/BL/'.$bl['nis']).'/'.$agenda[$a]['id_agendaguru'].'">
                                  <i class="fa-solid fa-user-xmark"></i></a>';
                if(!empty($bl['catatan']))
                  {
                    echo '<div class="small">('.$bl['catatan'].')</div>';
                  }
                  echo '<br />';
              }
            }
           
            if (isset($dataabsensi['D']) && count($dataabsensi['D'])>0)
            {
            echo 'Dispensasi : <br />';
            foreach ($dataabsensi['D'] as $d)
              {
                echo $d['nama'].' <a class="text-danger" href="'.site_url('agendaguru/hapuspresensi/D/'.$d['nis']).'/'.$agenda[$a]['id_agendaguru'].'">
                      <i class="fa-solid fa-user-xmark"></i></a>';
                if(!empty($d['catatan']))
                  {
                    echo '<div class="small">('.$d['catatan'].')</div>';
                  }
                  echo '<br />';
              }
            }

           
            if (isset($dataabsensi['S']) && count($dataabsensi['S'])>0)
            {
            echo 'Sakit : <br />';
            foreach ($dataabsensi['S'] as $s)
              {
                echo $s['nama'].' <a class="text-danger" href="'.site_url('agendaguru/hapuspresensi/S/'.$s['nis']).'/'.$agenda[$a]['id_agendaguru'].'">
                                  <i class="fa-solid fa-user-xmark"></i></a>';
                if(!empty($s['catatan']))
                  {
                    echo '<div class="small">('.$s['catatan'].')</div>';
                  }
                  echo '<br />';
              }
            }

           
            if (isset($dataabsensi['I']) && count($dataabsensi['I'])>0)
            {
            echo 'Ijin : <br />';
            foreach ($dataabsensi['I'] as $i)
              {
                echo $i['nama'].' <a class="text-danger" href="'.site_url('agendaguru/hapuspresensi/I/'.$i['nis']).'/'.$agenda[$a]['id_agendaguru'].'">
                                <i class="fa-solid fa-user-xmark"></i></a>';
                if(!empty($i['catatan']))
                  {
                    echo '<div class="small">('.$i['catatan'].')</div>';
                  }
                  echo '<br />';
              }
            }

            
            if (isset($dataabsensi['A']) && count($dataabsensi['A'])>0)
            {
            echo 'Alpa : <br />';
            foreach ($dataabsensi['A'] as $alpa)
              {
                echo $alpa['nama'].' <a class="text-danger" href="'.site_url('agendaguru/hapuspresensi/A/'.$alpa['nis']).'/'.$agenda[$a]['id_agendaguru'].'">
                                <i class="fa-solid fa-user-xmark"></i></a>';
                if(!empty($alpa['catatan']))
                  {
                    echo '<div class="small">('.$alpa['catatan'].')</div>';
                  }
                  echo '<br />';
              }
            }
          }
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
     
  </main>
  
</div>

<script src="<?= base_url('js/checkout.js') ?>"></script>