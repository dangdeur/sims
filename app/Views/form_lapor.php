<div class="container">
<div class="alert alert-danger">
Lapor PBM dilaksanakan saat akan memulai proses pembelajaran. Apabila tidak Lapor, maka tidak bisa mengisi Agenda
</div>

<h3>Lapor Pelaksanaan PBM</h3>
Dengan ini saya melapor kepada pihak terkait,
<ul>
  <li>Saya telah berada di ruang pelaksanaan pembelajaran</li>
  <li>Saya siap memulai proses pembelajaran</li>
</ul>


<!-- Waktu saat ini : <?php //echo date("h:m:s"); ?> -->

<?php
echo form_open("agendaguru/lapor");



?>
<table class="table">
  <tr>
    <td>Waktu pelaporan</td>
   
    <td>
      <strong><div id="time" class="col-form-label"></div></strong>
    <?php
   
    ?>
    </td>
</tr>
<tr>
    <td>Rombel</td>
    
    <td>
      <?php 
      
      if (isset($info[$jam_sekarang]['rombel']))
      {
        $rombel_saat_ini=$info[$jam_sekarang]['rombel'];
      }
      else {
        $rombel_saat_ini=NULL;
        $rombel[NULL]='Jadwal Tidak Terdeteksi';
      }
      echo form_dropdown('rombel', $rombel,$rombel_saat_ini, $att=['class'=>'form-select','id'=>'rombel']);
      ?>
      </td>
</tr>
<tr>
    <td>Matapelajaran</td>
   
    <td>
      <?php
        if (isset($info[$jam_sekarang]['mapel']))
        {
          $mapel_saat_ini=$info[$jam_sekarang]['mapel'];
        }
        else {
          $mapel_saat_ini=NULL;
          $mapel[NULL]='Mapel Tidak Terdeteksi';
        }
    echo form_dropdown('mapel', $mapel,$mapel_saat_ini, $att=['class'=>'form-select','id'=>'rombel']); ?></td>
</tr>
<?php foreach (LOKASI as $item): 

$lokasi[$item]=$item;

endforeach ?>

<tr>
    <td>Lokasi PBM</td>
    
    <td><?php echo form_dropdown('lokasi',$lokasi ,'', $att=['class'=>'form-select','id'=>'rombel']); ?></td>
</tr>


<tr>
    <td colspan="3"><button class="btn btn-primary">Lapor</button></td>
    
</tr>
</table>
<?php
echo form_close();
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
  document.getElementById('time').innerHTML =  h + ":" + m + ":" + s;
  setTimeout(startTime, 1000);
}

function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
document.getElementsByTagName('body')[0].onload = startTime();
</script>