   
<div class="container">
  <main>
    <div class="py-5 text-center">
    
    <img class="d-block mx-auto mb-4" src="<?= base_url('gambar/logo.png') ?>" alt="" width="72" height="72">
      <h2>Agenda Guru <?= $nama_lengkap ?></h2> 
      <div class="small text-danger">
      <?= validation_list_errors() ?>
      <?= csrf_field(); ?>
    </div>  
      <?php
      //echo $hari.", ".$tanggal." ".$bulan." ".$tahun." ".$jam;
     
      
      if (empty($agenda) && !isset($form))
      {
        echo $waktu;
      echo '<p class="lead">Belum ada riwayat PBM anda</p>';
        echo '<a type="submit" class="btn btn-primary btn-lg" href="'.site_url('agendaguru/baru').'">Isi Agenda</a></div>';
      }


      echo form_open('agendaguru/baru');
      ?>
    </div>

      <div class="col-md-12 col-lg-12">
        <div class="row g-3">
       <!-- <div class="row"> -->
              <div class="col-sm-4">
            <?php 
           
                    $tgl_sekarang=[date("d")];
            echo form_dropdown('tanggal', TANGGAL,$tgl_sekarang, $att=['class'=>'form-select','id'=>'tanggal','required'=>'required']); ?>
          </div>
              
          <div class="col-sm-4">
            <?php
            $bln_sekarang=[date("m")];
              echo form_dropdown('bulan', BULAN,$bln_sekarang, $att=['class'=>'form-select','id'=>'bulan','required'=>'required']); ?>
          </div>
          <div class="col-sm-4">
            <?php
            
              echo form_dropdown('tahun', [date("Y")],'', $att=['class'=>'form-select','id'=>'jp1','required'=>'required']); 
              ?>
          </div>
          <!-- </div> -->
          <div class="col-sm-6">
            <?php
            if(isset($rombel_agenda))
              {
                $rombel_selected=$rombel_agenda;
              }
              else {
                $rombel_selected='';
              }
            $rombel[null]='Pilih Rombel';
            echo form_dropdown('rombel_agenda', $rombel,old('rombel_agenda'), $att=['class'=>'form-select','id'=>'rombel_agenda','required'=>'required']);
            ?>
          </div>

          <div class="col-sm-3">
            <?php 
            //$jp=JP[date('N')];
            $arr_jp[null]='Pilih JP';
            $arr_jp['Senin']=['1'=>'08:00-08:45', '2'=>'08:45-09:30', '3'=>'09:45-10:30', '4'=>'10:30-11:15', '5'=>'11:15-12:00', '6'=>'12:30-13:10', '7'=>'13:10-13:50', '8'=>'13:50-14:30', '9'=>'14:30-15:10', '10'=>'15:10-15:50'] ;
            $arr_jp['Selasa-Kamis']=[ '1'=>'07:15-08:00', '2'=>'08:00-08:45', '3'=>'08:45-09:30', '4'=>'09:45-10:30', '5'=>'10:30-11:15', '6'=>'11:15-12:00', '7'=>'12:30-13:15', '8'=>'13:15-14:00', '9'=>'14:00-14:45', '10'=>'14:45-15:30' ];
            $arr_jp['Jumat']=[ '1'=>'08:00-08:45', '2'=>'08:45-09:30', '3'=>'09:45-10:30', '4'=>'10:30-11:15', '5'=>'13:00-13:40', '6'=>'13:40-14:20', '7'=>'14:20-15:00', '8'=>'15:00-15:40' ];
            // 'Senin'=>[ ],
              // 'Selasa-Kamis'=>,
              // 'Jumat'=>[ '1'=>'08:00-08:45', '2'=>'08:45-09:30', '3'=>'09:45-10:30', '4'=>'10:30-11:15', '5'=>'13:00-13:40', '6'=>'13:40-14:20', '7'=>'14:20-15:00', '8'=>'15:00-15:40' ]
                       //]
            //d($jp);
            echo form_dropdown('jp0', $arr_jp,old('jp0'), $att=['class'=>'form-select','id'=>'jp0','required'=>'required']); ?>
          </div>
              
          <div class="col-sm-3">
            <?php
              echo form_dropdown('jp1', $arr_jp,old('jp1'), $att=['class'=>'form-select','id'=>'jp1','required'=>'required']); ?>
          </div>
            

          <div class="col-12">
            <div class="input-group has-validation">
              <span class="input-group-text">Mapel</span>
                <?php
                $mapel[null]="Pilih Mapel";
                echo form_dropdown('mapel_agenda', $mapel,old('mapel_agenda'), $att=['class'=>'form-control','id'=>'mapel_agenda','required'=>'required']);
                ?>
            </div>
          </div>

          <div class="col-12">
            <input name="materi" type="text" class="form-control" id="materi" placeholder="Materi Pelajaran" value="<?= old('materi') ?>">
          </div>

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Simpan Agenda</button>

        </div>
    </div>
    <?php 
      echo form_hidden($hid=[
        'kode_guru'=>$kode_pengguna,
      ]);
      echo form_close(); 
    ?>
  </main>
</div>

<script src="<?= base_url('js/checkout.js') ?>"></script>