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
<h3>Profil Staf</h3>


<?php //echo img(['class'=>'rounded-circle','src'=>'gambar/staf/'.$kode_pengguna.'.JPG','width'  => '260','height' => '236',])?>
<!-- Gambar-->
<div class="py-4">
  <div class="row g-4 row-cols-1 row-cols-sm-2 row-cols-md-3">
    <div class="col">
      <!-- <div class="card"> -->
        <div class="ratio ratio-1x1 rounded-circle overflow-hidden">
          <!-- <img src="https://i.sstatic.net/fcbpv.jpg?s=256&g=1" class="card-img-top img-cover" alt="Raeesh"> -->
          <?php echo img(['src'=>'gambar/staf/'.$kode_pengguna.'.JPG'])?>
        </div>
        <!-- <div class="card-body">
          <h5 class="card-title">Raeesh Alam</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
          <a href="#" class="btn btn-primary">View More</a>
        </div> -->
      <!-- </div> -->
    </div>
  </div>
</div> 



<!-- end gambar-->


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