<div class="container">

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
   
    <td><strong><div id="time" class="col-form-label"></div></strong></td>
</tr>
<tr>
    <td>Rombel</td>
    
    <td><?php echo form_dropdown('rombel', $rombel,'', $att=['class'=>'form-select','id'=>'rombel']); ?></td>
</tr>
<tr>
    <td>Matapelajaran</td>
   
    <td><?php echo form_dropdown('mapel', $mapel,'', $att=['class'=>'form-select','id'=>'rombel']); ?></td>
</tr>
<?php foreach (LOKASI as $item): 

$lokasi[$item]=$item;

endforeach ?>

<tr>
    <td>Lokasi PBM</td>
    
    <td><?php echo form_dropdown('lokasi',$lokasi ,'', $att=['class'=>'form-select','id'=>'rombel']); ?></td>
</tr>

<input type='hidden' name='waktu' value='strValues'
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