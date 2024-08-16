  <!-- <div class="container-xl mb-4">
    <p>Matching .container-xl...</p>
  </div> -->


    <div>
      <div class="bg-body-tertiaryp-5 rounded">
        <div class="col-sm-8 mx-auto">
          <h3>Cetak Laporan Tugas Tambahan : <strong><?= $nama_lengkap ?></strong></h3>
          <?php
          $option=[
            '01'=>'Januari',
            '02'=>'Februari',
            '03'=>'Maret',
            '04'=>'April',
            '05'=>'Mei',
            '06'=>'Juni',
            '07'=>'Juli',
            '08'=>'Agustus',
            '09'=>'September',
            '10'=>'Oktober',
            '11'=>'November',
            '12'=>'Desember'
          ];
            echo form_open('cetaktuta');
           
            //echo 'Agenda harian mengajar :';
            
            echo form_dropdown('bulan', $option,'' ,['class'=>'form-control']);
           
            echo '<br /><button class="w-100 btn btn-lg btn-primary" type="submit">Cetak</button>';
            echo form_close();

          ?>
         
        </div>
      </div>
    </div>
    <script>

// function pass() {
//   var x = document.getElementById("passwordbaru");
//   if (x.type === "password") {
//     x.type = "text";
//   } else {
//     x.type = "password";
//   }
// }
</script>