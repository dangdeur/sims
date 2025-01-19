<div class="container">
  <?php
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
  echo '</div>';
  echo '<div id="tampil"></div>';
  echo '</div>';
  ?>

</div>

<?php
//echo form_close();
?>

<script type="text/javascript">
  $(document).ready(function() {
    $('#rombel').change(function() {

      var rombel = $('#rombel').val();
      console.log(rombel);

      $.ajax({

        url: "<?php echo base_url(); ?>" + "tampil_siswa/" + rombel,
        type: "POST",

        contentType: "application/json",
        dataType: "JSON",
        success: function(data) {
          var kalender = new Date();
          // kalender.setDate(kalender.getDate() + 1);
          // $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());
          var i;
          var html = '<h4>Input data keterlambatan kelas : ' + rombel + ', Tanggal '+'<?php echo date("d"); ?>'+' '+'<?php echo BULAN[date("m")];?>'+' '+'<?php echo date("Y"); ?>'+'</h4>';
          html += '<table class="table table-striped"><tr><th>No</th><th>NIS</th><th>Nama Siswa</th><th></th></tr>';
          for (i = 0; i < data.length; i++) {
            var no = i + 1;
            html += '<tr><td>' + no + '</td><td>' + data[i].nis + '</td><td>' + data[i].nama_siswa + '</td>';
            html += '<td><button class="form-control btn-warning" name="tl" id="tl" onClick="tl(' + data[i].nis + ');">Terlambatt</button></td></tr>';
          }
          html += '</table>';
          $('#tampil').html(html);
        }
      });
    });




  });


  function tl(nis) {

    $.ajax({

      url: "<?php echo base_url(); ?>" + "simpan_tl/" + nis,
      type: "POST",

      contentType: "application/json",
      dataType: "JSON",
      success: function(data) {
        var i;
        var html = '<h4>Input data keterlambatan kelas : ' + rombel + '</h4>';
        html += '<table class="table table-striped"><tr><th>No</th><th>NIS</th><th>Nama Siswa</th><th></th></tr>';
        for (i = 0; i < data.length; i++) {
          var no = i + 1;
          html += '<tr><td>' + no + '</td><td>' + data[i].nis + '</td><td>' + data[i].nama_siswa + '</td>';
          html += '<td><button class="form-control btn-warning" name="tl" id="tl" onClick="tl(' + data[i].nis + ');">Terlambat</button></td></tr>';
        }
        html += '</table>';
        $('#tampil').html(html);
      }
    });
  }
</script>