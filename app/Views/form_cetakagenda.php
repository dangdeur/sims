  <!-- <div class="container-xl mb-4">
    <p>Matching .container-xl...</p>
  </div> -->


    <div>
      <div class="bg-body-tertiaryp-5 rounded">
        <div class="col-sm-8 mx-auto">
          <h3>Cetak Riwayat Mengajar : <strong><?= $nama_lengkap ?></strong></h3>
          <?php
          $bln=[
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
          $thn=['2024'=>'2024','2025'=>'2025'];
            echo form_open('cetakagenda');
           
            //echo 'Agenda harian mengajar :';
            $bln_sekarang=[date("m")];
            $thn_sekarang=[date("Y")];
            
           
            echo form_dropdown('bulan', $bln,$bln_sekarang ,['class'=>'form-control']);
            echo form_dropdown('tahun', $thn,$thn_sekarang ,['class'=>'form-control']);
           
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