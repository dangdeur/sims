<div class="container">
  <?php
  if ($ramadhan = 0) {
    switch (date("N")) {
      case 1:
        $jam_masuk = '8.00';
        $jam_pulang = '15.50';
        break;
      case 5:
        $jam_masuk = '8.00';
        $jam_pulang = '15.40';
        break;
      case 6:
        $jam_masuk = '-';
        $jam_pulang = '-';
        break;
      case 7:
        $jam_masuk = '-';
        $jam_pulang = '-';
        break;
      default:
        $jam_masuk = '7.15';
        $jam_pulang = '15.40';
    }
  } else {
    switch (date("N")) {

      case 5:
        $jam_masuk = '8.00';
        $jam_pulang = '11.35';
        break;
      case 6:
        $jam_masuk = '-';
        $jam_pulang = '-';
        break;
      case 7:
        $jam_masuk = '-';
        $jam_pulang = '-';
        break;
      default:
        $jam_masuk = '8.00';
        $jam_pulang = '12.25';
    }
  }

  if (date('H.i') >= $jam_masuk && date('H.i') <= $jam_pulang) {
    if (isset($jam_sekarang) && $jam_sekarang != NULL) {

      //  foreach ($info as $kelas):

      //     $info[$kelas] = $ite;

      //   endforeach

  ?>
      <div class="alert alert-danger">
        Lapor PBM dilaksanakan saat akan memulai proses pembelajaran. Apabila tidak Lapor, maka tidak bisa mengisi Agenda
      </div>

      <h3>Lapor Pelaksanaan PBM</h3>
      Dengan ini saya melapor kepada pihak terkait,
      <ul>
        <li>Saya telah berada di ruang pelaksanaan pembelajaran</li>
        <li>Saya siap memulai proses pembelajaran</li>
      </ul>


      <!-- Waktu saat ini : <?php //echo date("h:m:s"); 
                            ?> -->

      <?php
      echo form_open("agendaguru/lapor");



      ?>
      <table class="table">
        <tr>
          <td>Waktu pelaporan</td>

          <td>
            <strong>
              <div id="time" class="col-form-label"></div>
            </strong>
            <?= $jam_ke ?>
          </td>
        </tr>
        <tr>
          <td>Rombel</td>

          <td>
            <?php

            if (isset($info[$jam_sekarang])) {
              $rombel_saat_ini = $info[$jam_sekarang]['rombel'];
            } else {
              $rombel_saat_ini = NULL;
              $rombel[NULL] = 'Jadwal Tidak Terdeteksi';
            }
            echo form_dropdown('rombel', $rombel, $rombel_saat_ini, $att = ['class' => 'form-select', 'id' => 'rombel']);
            ?>
          </td>
        </tr>
        <tr>
          <td>Matapelajaran</td>

          <td>
            <?php
            if (isset($info[$jam_sekarang]['mapel'])) {
              $mapel_saat_ini = $info[$jam_sekarang]['mapel'];
            } else {
              $mapel_saat_ini = NULL;
              $mapel[NULL] = 'Mapel Tidak Terdeteksi';
            }
            echo form_dropdown('mapel', $mapel, $mapel_saat_ini, $att = ['class' => 'form-select', 'id' => 'rombel']); ?></td>
        </tr>
        <?php foreach (LOKASI as $item):

          $lokasi[$item] = $item;

        endforeach ?>

        <tr>
          <td>Lokasi PBM</td>

          <td><?php echo form_dropdown('lokasi', $lokasi, '', $att = ['class' => 'form-select', 'id' => 'rombel']); ?></td>
        </tr>

        <tr>
          <td>Jam Pelajaran</td>

          <td>
            <div class="row">
              <div class="col-2">
                <?php
                // echo form_input(['name' => 'jp0', 'id' => 'jp0', 'required' => 'required', 'class' => 'form-control', 'readonly' => TRUE, 'value' => set_value('jp0', JP[date("N")][$jp0])]);
                echo '</div>';
                //echo '<div class="col-2">';
                //  echo 's.d';
                //echo '<label>-</label>';
                //echo '</div>';

                echo '<div class="col-2">';
                // echo form_input(['name' => 'jp1', 'id' => 'jp1', 'required' => 'required', 'class' => 'form-control', 'readonly' => TRUE, 'value' => set_value('jp1', JP[date("N")][$jp1])]);
                ?>
              </div>
          </td>
        </tr>
        <tr>
          <td colspan="3"><button class="btn btn-primary">Lapor</button></td>

        </tr>
      </table>
      <?php
      echo form_close();
    } else {
      if ($ramadhan = 0) {

      ?>
        <div class="alert alert-success">
          Tidak ada jadwal PBM saat ini <strong><?= JAM_PBM[$jam_sekarang]; ?></strong>. Waktu saat ini <strong><span id="time"></div></span></strong>
</div>
<?php
      } else {
?>
  <div class="alert alert-success">
    Tidak ada jadwal PBM saat ini <strong><?= JAM_PBM_RAMADHAN[$jam_sekarang]; ?></strong>. Waktu saat ini <strong><span id="time"></div></span></strong>
  </div>
<?php
      }
    }
  } else {
?>
<div class="alert alert-danger">
  Diluar waktu pembelajaran <strong><?= $jam_masuk . ' - ' . $jam_pulang; ?></strong>. Waktu saat ini <strong><span id="time"></div></span></strong>
</div>
<?php
  }
?>
</div>

<script>
  function startTime() {
    const today = new Date();
    let h = today.getHours();
    let m = today.getMinutes();
    let s = today.getSeconds();

    m = checkTime(m);
    s = checkTime(s);
    //var jam = getElementById('time');
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    setTimeout(startTime, 1000);
  }

  function checkTime(i) {
    if (i < 10) {
      i = "0" + i
    }; // add zero in front of numbers < 10
    return i;
  }
  document.getElementsByTagName('body')[0].onload = startTime();
</script>