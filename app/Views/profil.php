<!-- <div class="container text-center">
  <div class="row">
    <div class="col">
      1 of 2
    </div>
    <div class="col">
      2 of 2
    </div>
  </div>
  <div class="row">
    <div class="col">
      1 of 3
    </div>
    <div class="col">
      2 of 3
    </div>
    <div class="col">
      3 of 3
    </div>
  </div>
</div> -->

<div class="container"> 

<table class="table">

<tr>
  <td>Nama</td>
  <td>:</td>
  <td><?= $detail['nama_gelar'] ?></td>
</tr>
<tr>
  <td>NIP</td>
  <td>:</td>
  <td><?= $detail['nip'] ?></td>
</tr>
<tr>
  <td>NUPTK</td>
  <td>:</td>
  <td><?= $detail['nuptk'] ?></td>
</tr>
<tr>
  <td>Tempat Tanggal Lahir</td>
  <td>:</td>
  <td><?= $detail['tempat_lahir'].', '.$detail['tanggal_lahir'] ?></td>
</tr>
<tr>
  <td>NIK</td>
  <td>:</td>
  <td><?= $detail['nik'] ?></td>
</tr>
<tr>
  <td>Status Pegawai</td>
  <td>:</td>
  <td><?= $detail['status_kepegawaian'] ?></td>
</tr>
<tr>
  <td>Email</td>
  <td>:</td>
  <td><?= $detail['email'] ?></td>
</tr>
<tr>
  <td>No HP</td>
  <td>:</td>
  <td><?= $detail['hp'] ?></td>
</tr>
<?php
if (isset($walas))
{
  echo '<tr>
  <td>Walikelas</td>
  <td>:</td>
  <td>'.$walas.'</td>
</tr>';
}

if (isset($tuta['jabatan']))
{
  echo '<tr>
  <td>Tugas tambahan</td>
  <td>:</td>
  <td>'.$tuta['jabatan'].'</td>
</tr>';
}
?>
</table>
</div>