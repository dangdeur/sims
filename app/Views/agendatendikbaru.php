
<div class="container">
<main>
    <div class="py-5 text-center">
    <?php echo form_open('tendiksimpan'); ?>
      <!-- <img class="d-block mx-auto mb-4" src="<?= base_url('gambar/logo.png') ?>" alt="" width="72" height="72"> -->
      <h2>Lapor aktifitas <?= $nama_lengkap ?></h2>
      <div class="small text-danger">
      <?= validation_list_errors() ?>
      <?= csrf_field(); ?>
    </div>  
      <h4>
       
        </h4>
      <?php
      //echo $hari.", ".$tanggal." ".$bulan." ".$tahun." ".$jam;
      
      if (empty($agenda) && !isset($form)) {
        echo $waktu;
        echo '<p class="lead">Belum ada riwayat PBM anda</p>';
        echo '<a type="submit" class="btn btn-primary btn-lg" href="' . site_url('tendik/baru') . '">Isi Aktivitas</a>';
      }


      
      ?>
    </div>

    <div class="col-md-12 col-lg-12">
    <div class="row g-3">
     
      <div class="col">
        <?php

        $tgl_sekarang = [date("d")];
        echo form_dropdown('tanggal', TANGGAL, $tgl_sekarang, $att = ['class' => 'form-select', 'id' => 'tanggal', 'required' => 'required']); ?>
      </div>

      <div class="col">
        <?php
        $bln_sekarang = [date("m")];
        echo form_dropdown('bulan', BULAN, $bln_sekarang, $att = ['class' => 'form-select', 'id' => 'bulan', 'required' => 'required']); ?>
      </div>
      <div class="col">
        <?php

        echo form_dropdown('tahun', [date("Y") => date("Y")], '', $att = ['class' => 'form-select', 'id' => 'tahun', 'required' => 'required']);
        ?>
      </div>
   

   
    
      <?php
      $text_area = ['name' => 'aktifitas', 'placeholder' => 'Uraian aktifitas', 'class' => 'form-control', 'value' => old('aktifitas')];
      echo form_textarea($text_area);
      // $jabatan[NULL]='Pilih jabatan';
      // echo form_dropdown('jabatan', $jabatan, '', $att = ['class' => 'form-select', 'id' => 'jabatan','value' => old('jabatan')]); 
      ?>
     
    






    <hr class="my-4">
  
      <button class="w-100 btn btn-primary btn-lg" type="submit">Simpan</button>
    
    
    </div></div></main></div>

    <?php
    echo form_hidden($hid = [
      'kode_guru' => $kode_pengguna
    ]);
    echo form_close();
    ?>
  
<!-- </div> -->
<!-- </main> -->
<script src="<?= base_url('js/checkout.js') ?>"></script>