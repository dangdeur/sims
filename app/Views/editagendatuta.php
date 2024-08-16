   
<div class="container">
  <main>
    <div class="py-5 text-center">
      <!-- <img class="d-block mx-auto mb-4" src="<?= base_url('gambar/logo.png') ?>" alt="" width="72" height="72"> -->
      <h2>Edit Agenda Tugas Tambahan <?= $nama_lengkap ?></h2>
      <?php
      $waktu=explode(" ",$agenda['tanggal']);
      $tanggal=explode("-",$waktu[0]);
      $tgl=$tanggal[2];
      $bln=$tanggal[1];
      $thn=$tanggal[0];


      echo form_open('tutaedit/'.$agenda['id_agendatuta']);
      ?>
    </div>

    <div class="col-md-12 col-lg-12">
    <div class="row g-3">
           <div class="col">
            <?php 
           
                    $tgl_sekarang=[date("d")];
            echo form_dropdown('tanggal', TANGGAL,$tgl, $att=['class'=>'form-select','id'=>'tanggal','required'=>'required']); ?>
          </div>
              
          <div class="col">
            <?php
            $bln_sekarang=[date("m")];
              echo form_dropdown('bulan', BULAN,$bln, $att=['class'=>'form-select','id'=>'bulan','required'=>'required']); ?>
          </div>
          <div class="col">
            <?php
            
              echo form_dropdown('tahun', [date("Y")=>date("Y")],'', $att=['class'=>'form-select','id'=>'jp1','required'=>'required']); 
              ?>
          </div>
         
           <?php
           $aktifitas=$agenda['aktifitas'];
           $text_area=['name'=>'aktifitas','placeholder'=>'Uraian aktifitas', 'class'=>'form-control','value'=>$aktifitas];
          echo form_textarea($text_area);
           ?>

         

          
            
         

          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Simpan</button>

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