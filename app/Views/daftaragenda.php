   
<?= $this->extend('layout') ?>
<?= $this->section('content') ?>
<div class="container">
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
        echo $waktu;
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
        //d($siswa);
        ?>
        <!-- <table class="table">
          <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama Siswa</th>
            <th>Presensi</th>
            <th>Catatan</th>
          </tr> -->
          <?php
        //   $no=1;
        //   foreach($siswa as $data_siswa)
        //   {
        //     echo '<tr>
        //     <td>'.$no.'</td>
        //     <td>'.$data_siswa['nis'].'</td>
        //     <td>'.$data_siswa['nama_siswa'].'</td>
        //     <td>';

        //     echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'TL','checked'=>set_radio('absensi'.$no,'TL')]).'TL ';
        //     echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'BL','checked'=>set_radio('absensi'.$no,'BL')]).'BL ';
        //     echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'D','checked'=>set_radio('absensi'.$no,'D')]).'D ';
        //     echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'S','checked'=>set_radio('absensi'.$no,'S')]).'S ';
        //     echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'I','checked'=>set_radio('absensi'.$no,'I')]).'I ';
        //     echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'A','checked'=>set_radio('absensi'.$no,'A')]).'A ';
        //     echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'H','checked'=>set_radio('absensi'.$no,'H')]).'H ';
            
        //     echo '</td>
        //     <td>'.
        //     form_input('catatan'.$no,'',['placeholder'=>'Catatan'.$no,'class'=>'form-control'],'text')
        //     .'</td>
        //   </tr>';
        //   $no++;
        //   }
        //   echo '<tr><td colspan=5>'.form_submit('simpanabsensi', 'Simpan',['class'=>'form-control']).'</td></tr>';
        //   ?>
         <!-- </table> -->
        <?php
      } 

      if (isset($form) && $form==1)
      {
      ?> 
      <hr class="my-4">
      <div class="small danger">
      <?= validation_list_errors() ?>
    </div>
      <?= form_open('agendaguru/baru') ?> 
      <div class="row g-5">
        <div class="col-md-5 col-lg-4 order-md-last">
        <h4 class="d-flex justify-content-between align-items-center mb-3">
          <span class="text-primary">Data Presensi</span>
          <span class="badge bg-primary rounded-pill">-</span>
        </h4>

        <?php 
        if(isset($presensi)) {
        ?>
        <ul class="list-group mb-3">
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Sakit</h6>
              <small class="text-body-secondary">Brief description</small>
            </div>
            <span class="text-body-secondary">$12</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Ijin</h6>
              <small class="text-body-secondary">Brief description</small>
            </div>
            <span class="text-body-secondary">$8</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Alpa</h6>
              <small class="text-body-secondary">Brief description</small>
            </div>
            <span class="text-body-secondary">$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Dispensasi</h6>
              <small class="text-body-secondary">Brief description</small>
            </div>
            <span class="text-body-secondary">$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Terlambat</h6>
              <small class="text-body-secondary">Brief description</small>
            </div>
            <span class="text-body-secondary">$5</span>
          </li>
          <li class="list-group-item d-flex justify-content-between lh-sm">
            <div>
              <h6 class="my-0">Bolos</h6>
              <small class="text-body-secondary">Brief description</small>
            </div>
            <span class="text-body-secondary">$5</span>
          </li>

          
          <li class="list-group-item d-flex justify-content-between">
            <span>Jumlah</span>
            <strong>$20</strong>
          </li>
        </ul>

        <form class="card p-2">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Catatan Guru">
            <button type="submit" class="btn btn-secondary">Simpan</button>
          </div>
        </form>
        <?php }
      else{
        echo "belum ada data presensi";
      }
      ?>    
      </div>
      
      <div class="col-md-7 col-lg-8">
        <!-- <h4 class="mb-3">Billing address</h4> -->
        <!-- <form class="needs-validation" novalidate> -->
       
          <div class="row g-3">
            <div class="col-sm-6">
              <!-- <label for="firstName" class="form-label">Isian</label>
              <input type="text" class="form-control" id="kelas" value="kelas" name="kelas">
              <div class="invalid-feedback">
                Valid first name is required.
              </div> -->
              <?php
              //array_unshift($rombel,['Pilih Rombel'=>null]);
              if(isset($rombel_agenda))
              {
                $rombel_selected=$rombel_agenda;
              }
              else {
                $rombel_selected='';
              }
              $rombel[null]='Pilih Rombel';
              echo form_dropdown('rombel_agenda', $rombel,$rombel_selected, $att=['class'=>'form-select','id'=>'rombel_agenda','required'=>'required']);
              ?>
            </div>

           
              <div class="col-sm-3">
                
                <?php 
                $jp=JP[date('N')];
                $jp[null]='Pilih JP';
                echo form_dropdown('jp0', $jp,'', $att=['class'=>'form-select','id'=>'jp0','required'=>'required']); ?>
              </div>
              
              <div class="col-sm-3">
                <?php echo form_dropdown('jp1', $jp,'', $att=['class'=>'form-select','id'=>'jp1','required'=>'required']); ?>
              </div>
            

            <div class="col-12">
              <!-- <label for="mapel" class="form-label">Username</label> -->
              <div class="input-group has-validation">
                <span class="input-group-text">Mapel</span>
                <?php
                // array_unshift($mapel,'');
                $mapel[null]="Pilih Mapel";
                echo form_dropdown('mapel_agenda', $mapel,'', $att=['class'=>'form-control','id'=>'mapel_agenda','required'=>'required']);
              ?>
                <!-- <input type="text" class="form-control" id="mapel" value="mapel">
              <div class="invalid-feedback">
                  Your username is required.
                </div> -->
              </div>
            </div>

            <div class="col-12">
              <!-- <label for="address" class="form-label">materi</label> -->
              <input name="materi" type="text" class="form-control" id="materi" placeholder="Materi Pelajaran" required>
              
            </div>

           

          <hr class="my-4">

          <?php
            if (isset($presensi))
            {
              echo '<a class="w-100 btn btn-primary btn-lg" type="submit">Simpan Agenda</a>';
            }
            else {
              echo '<button class="w-100 btn btn-primary btn-lg" type="submit">Lanjut -> Isi Absensi</button>';
            }
          } //end $form=1
          ?>
          
        <!-- </form> -->
        
      </div>
    </div>
    <?php 
     
      
    
     
      ?> 
  </main>
  <?= form_close() ?>
 
</div>

<script src="<?= base_url('js/checkout.js') ?>"></script>