   
<div class="container">
  <main>
    <div class="py-5 text-center">
      <!-- <img class="d-block mx-auto mb-4" src="<?= base_url('gambar/logo.png') ?>" alt="" width="72" height="72"> -->
      <h2>Edit Agenda Guru</h2>
      <div class="small text-danger">
      <?= validation_list_errors() ?>
    </div>
      <?php
      $kode=explode("-",$agenda['kode_agendaguru']);
      // $tanggal=explode("-",$waktu[0]);
      $tgl=substr($kode[1],0,2);
      $bln=BULAN[substr($kode[1],2,2)];
      $thn=substr($kode[1],4,4);
      $tanggal= $tgl." ".$bln." ".$thn;
      $waktu=strtotime($thn.'-'.substr($kode[1],2,2).'-'.$tgl);
      $hari=date('N',$waktu);


      echo form_open('agendaguru/edit/'.$agenda['id_agendaguru']);
      ?>
    </div>

    <div class="col-md-12 col-lg-12">
    <div class="row g-3">
           <div class="col-sm-4">
            <?php 
           
                    $tgl_sekarang=[date("d")];
            echo form_dropdown('tanggal', TANGGAL,$tgl, $att=['class'=>'form-select','id'=>'tanggal']); ?>
          </div>
              
          <div class="col-sm-4">
            <?php
            $bln_sekarang=[date("m")];
              echo form_dropdown('bulan', BULAN,substr($kode[1],2,2), $att=['class'=>'form-select','id'=>'bulan']); ?>
          </div>
          <div class="col-sm-4">
            <?php
            
              echo form_dropdown('tahun', [date("Y")=>date("Y")],'', $att=['class'=>'form-select','id'=>'tahun']); 
              ?>
          </div>
          <!-- </div>
         
          <div class="row g-3"> -->
          <div class="col-sm-6">
            <?php
            // if(isset($rombel_agenda))
            //   {
            //     $rombel_selected=$rombel_agenda;
            //   }
            //   else {
            //     $rombel_selected='';
            //   }
            $rombel_jadwal[null]='Pilih Rombel';
            echo form_dropdown('rombel', $rombel_jadwal,$agenda['rombel'], $att=['class'=>'form-select','id'=>'rombel']);
            ?>
          </div>

          <div class="col-sm-3">
            <?php 
            //tutup, ganti 1-10
            // if ($hari == 6 || $hari ==7)
            // {
            //   $jp[null]='Pilih JP';
            // $jp['Senin']=['1'=>'08:00-08:45', '2'=>'08:45-09:30', '3'=>'09:45-10:30', '4'=>'10:30-11:15', '5'=>'11:15-12:00', '6'=>'12:30-13:10', '7'=>'13:10-13:50', '8'=>'13:50-14:30', '9'=>'14:30-15:10', '10'=>'15:10-15:50'] ;
            // $jp['Selasa-Kamis']=[ '1'=>'07:15-08:00', '2'=>'08:00-08:45', '3'=>'08:45-09:30', '4'=>'09:45-10:30', '5'=>'10:30-11:15', '6'=>'11:15-12:00', '7'=>'12:30-13:15', '8'=>'13:15-14:00', '9'=>'14:00-14:45', '10'=>'14:45-15:30' ];
            // $jp['Jumat']=[ '1'=>'08:00-08:45', '2'=>'08:45-09:30', '3'=>'09:45-10:30', '4'=>'10:30-11:15', '5'=>'13:00-13:40', '6'=>'13:40-14:20', '7'=>'14:20-15:00', '8'=>'15:00-15:40' ];
            
              
            // }
            // else {
            //   $jp=JP[$hari];
            // }
            //$jp=JP[$hari];
            
            //$jp[null]='Pilih JP';
            $jp=['Pilih JP',1,2,3,4,5,6,7,8,9,10];
            if (isset($jp[$agenda['jp0']]))
            {
              echo form_dropdown('jp0', $jp,$agenda['jp0'], $att=['class'=>'form-select','id'=>'jp0']);
            }
            else {
              echo form_dropdown('jp0', $jp,NULL, $att=['class'=>'form-select text-bg-danger','id'=>'jp0']);
            }
            ?>
            
          </div>
              
          <div class="col-sm-3">
            <?php
            if (isset($jp[$agenda['jp1']]))
            {
              echo form_dropdown('jp1', $jp,$agenda['jp1'], $att=['class'=>'form-select','id'=>'jp1']); 
            }
            else {
              echo form_dropdown('jp1', $jp,NULL, $att=['class'=>'form-select text-bg-danger','id'=>'jp1']); 
            }
              ?>
          </div>
        
          <div class="col-12">
            <div class="input-group has-validation">
              <span class="input-group-text">Mapel</span>
                <?php
                $mapel[null]="Pilih Mapel";
                echo form_dropdown('mapel', $mapel_jadwal,$mapel, $att=['class'=>'form-control','id'=>'mapel']);
                ?>
            </div>
          </div>

          <div class="col-12">
            <input name="materi" type="text" class="form-control" id="materi" placeholder="Materi Pelajaran" value="<?= $agenda['materi'] ?>">
          </div>

                  
            
         

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Simpan</button>

        </div>
        </div>
       
    <?php 
      echo form_hidden($hid=[
        'kode_guru'=>$kode_pengguna,
        'link'=>previous_url(),
      ]);
      echo form_close(); 
    ?>
  </main>
</div>

<script src="<?= base_url('js/checkout.js') ?>"></script>