   
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


      echo form_open('agendaguru/baru/'.$agenda['id_agendaguru']);
      ?>
    </div>

      <div class="col-md-12 col-lg-12">
        <div class="row g-3">
       <!-- <div class="row"> -->
              <div class="col-sm-4">
            <?php 
           $tanggal=explode("-",$agenda['tanggal']);
           $tgl=$tanggal[2];
           //echo $tgl;
            // $tgl_sekarang=[date("d")];
            // echo form_dropdown('tanggal', TANGGAL,$tgl_sekarang, $att=['class'=>'form-select','id'=>'tanggal','required'=>'required']);
            echo form_input(['name'=>'tanggal','id'=>'tanggal','required'=>'required','class'=>'form-control','disabled'=>TRUE,'value'=>set_value('tanggal', $tgl)]);
            
            ?>
           
          </div>
              
          <div class="col-sm-4">
            <?php
            $bln=BULAN[$tanggal[1]];
            //   echo form_dropdown('bulan', BULAN,$bln_sekarang, $att=['class'=>'form-select','id'=>'bulan','required'=>'required']); 
              echo form_input(['name'=>'bulan','id'=>'bulan','required'=>'required','class'=>'form-control','disabled'=>TRUE,'value'=>set_value('bulan', $bln)]);
              ?>
          </div>
          <div class="col-sm-4">
            <?php
            $thn=$tanggal[0];
              //echo form_dropdown('tahun', [date("Y")],'', $att=['class'=>'form-select','id'=>'jp1','required'=>'required']); 
              echo form_input(['name'=>'tahun','id'=>'tahun','required'=>'required','class'=>'form-control','disabled'=>TRUE,'value'=>set_value('tahun', $thn)]);
              ?>
          </div>
          <!-- </div> -->
          <div class="col-sm-6">
            <?php
            // if(isset($rombel_agenda))
            //   {
            //     $rombel_selected=$rombel_agenda;
            //   }
            //   else {
            //     $rombel_selected='';
            //   }
            // $rombel[null]='Pilih Rombel';
            // echo form_dropdown('rombel_agenda', $rombel,old('rombel_agenda'), $att=['class'=>'form-select','id'=>'rombel_agenda','required'=>'required']);
            echo form_input(['name'=>'rombel_agenda','id'=>'rombel_agenda','required'=>'required','class'=>'form-control','readonly'=>TRUE,'value'=>set_value('rombel_agenda', $agenda['rombel'])]);
            ?>
          </div>

          <div class="col-sm-3">
            <?php 
            
            $jp=JP[date('N')];
            $jp[null]='Pilih JP';
            
            echo form_dropdown('jp0', $jp,$agenda['jp0'], $att=['class'=>'form-select','id'=>'jp0','required'=>'required']); ?>
          </div>
              
          <div class="col-sm-3">
            <?php
              echo form_dropdown('jp1', $jp,$agenda['jp1'], $att=['class'=>'form-select','id'=>'jp1','required'=>'required']); ?>
          </div>
            

          <div class="col-12">
            <div class="input-group has-validation">
              <!-- <span class="input-group-text">Mapel</span> -->
                <?php
                // $mapel[null]="Pilih Mapel";
                // echo form_dropdown('mapel_agenda', $mapel,old('mapel_agenda'), $att=['class'=>'form-control','id'=>'mapel_agenda','required'=>'required']);
                echo form_input(['name'=>'mapel_agenda','id'=>'mapel_agenda','required'=>'required','class'=>'form-control','readonly'=>TRUE,'value'=>set_value('mapel_agenda', $agenda['mapel'])]);
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