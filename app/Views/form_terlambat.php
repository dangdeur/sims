<div class="container">
  <?php
  $session = session();
  //$nama_rombel=array();
  $nama_rombel[NULL] = 'Pilih Rombel';
  for ($a = 0; $a < count($rombel); $a++) {
    $nama_rombel[$rombel[$a]['rombel']] = $rombel[$a]['rombel'];
  }
  //d($nama_rombel);
  //echo form_open("form_terlambat",['class'=>'row g-3']);
  echo '<div class="row g-3">';
  echo '<div class="col-auto">';
  echo form_dropdown('rombel', $nama_rombel, '', $att = ['class' => 'form-select', 'id' => 'rombel']);
  echo '</div>';
  echo '<div class="col-auto">';
  //echo form_submit('tampilkan', 'Tampilkan',['class'=>'form-control']);
echo '<div id="pesan"></div>';
  echo '</div>';

  echo '<div id="tampil">';
  //   if($session->getFlashdata('nis') !=NULL)
  //   {
  //     echo '<span>Here goes you bootstrap alert code</span';
  //  } 
  echo '</div>';
  echo '</div>';
  ?>

</div>

<?php
//echo form_close();
?>

<script type="text/javascript">
  $(document).ready(function() {
    $('#pesan').hide();
    <?php if ($session->nis) { ?>
      $('#pesan').html('<?php echo 'tes' ?>').show();
    <?php } ?>
    $('#rombel').change(function() {

      var rombel = $('#rombel').val();
      console.log(rombel);

      $.ajax({

        url: "<?php echo base_url(); ?>/tampil_siswa/" + rombel,
        type: "POST",
        contentType: "application/json",
        dataType: "JSON",
        success: function(data) {
          console.log(data);
          var kalender = new Date();
          var i;
          var html = '<h4>Input data keterlambatan kelas : ' + rombel + ', Tanggal ' + '<?php echo date("d"); ?>' + ' ' + '<?php echo BULAN[date("m")]; ?>' + ' ' + '<?php echo date("Y"); ?>' + '</h4>';
          html += '<table class="table table-striped"><tr><th>No</th><th>NIS</th><th>Nama Siswa</th><th></th></tr>';
          for (i = 0; i < data.length; i++) {
            console.log(data[i]);
            var no = i + 1;
            html += '<tr><td>' + no + '</td><td>' + data[i].nis + '</td><td>' + data[i].nama_siswa + '</td>';

            if (data[i].kode_keterlambatan == null)
          {
            html += '<td><button class="form-control btn-warning" name="tl" id="tl" onClick=tl(' + JSON.stringify(data[i].nis) + ');>Terlambat</button></td></tr>';
          }
          else {
            html += '<td><button class="form-control btn-warning" name="tl" id="tl" onClick=tl(' + JSON.stringify(data[i].nis) + ');>Terlamb</button></td></tr>';
          }
          }
          html += '</table>';

          $('#tampil').html(html);

        }
      });
    });




  });


  function tl(nis) {
    //console.log(nis);
    $.ajax({
      url: "<?php echo base_url(); ?>/simpan_tl/" + nis,
      type: "POST",

      contentType: "application/json",
      dataType: "JSON",
      success: function(data) {
        <?php //$this->session->set_flashdata('ok',"berhasil"); 
        ?>
        // var i;
        // var html = '<h4>Input data keterlambatan kelas : ' + rombel + '</h4>';
        // html += '<table class="table table-striped"><tr><th>No</th><th>NIS</th><th>Nama Siswa</th><th></th></tr>';
        // for (i = 0; i < data.length; i++) {
        //   var no = i + 1;
        //   html += '<tr><td>' + no + '</td><td>' + data[i].nis + '</td><td>' + data[i].nama_siswa + '</td>';
        //   html += '<td><button class="form-control btn-warning" name="tl" id="tl" onClick="tl(' + nis + ');">Terlambatl</button></td></tr>';
        // }
        // html += '</table>';
        // $('#tampil').html(html);
      }
    });
  }
</script>