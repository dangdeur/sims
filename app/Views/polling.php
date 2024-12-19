
<!DOCTYPE html>
<html lang="en">
<head>
<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<link href="<?= base_url('bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet" id="bootstrap-css">
<link href="<?= base_url('css/survey.css') ?>" rel="stylesheet" id="survey-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="<?= base_url('js/survey.js') ?>"></script>
</head>



    <div>
      <div class="bg-body-tertiaryp-5 rounded">
        <div class="col-sm-8 mx-auto">
          <?php
           
          
            if (isset($gantipassword))
            {
              echo 'Anda menggunakan password bawaan, beresiko terjadi penyalahgunaan. <a class="btn btn-primary" href="login/gantipassword/'.$id_pengguna.'">Ganti Password</a>';
            }
          
            
          
          ?>
    
    <!-- awal -->
    <body class="container-fluid">

 <?php
if(!isset($_COOKIE['135'])) {
  if (!isset($_POST['simpan']))
  {
    if (!isset($_POST['submit']))
    {
// d($nama_guru);

  ?>
    <div class="assessment-container container">
        <div class="row">
            <div class="form-box">
                <!-- <form role="form" class="registration-form" action="javascript:void(0);"> -->
              <form role="form" class="registration-form" action="index.php" method="post" id="usul">
                  
                  <fieldset>
                        <div class="form-top">
                            <div class="form-top-left">
                              <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Sumbang Saran Pengampu Bidang</h3>
                                <p>Usulan pengampu bidang Kurikulum</p>
                                <select name="wakakur" class="form-control" placeholder="Usulan Waka. Bid. Kurikulum" required>
                                 <option value="" selected="selected">Pengampu Waka. Bidang Kurikulum</option>
                               <?php
                               for ($b=0;$b<count($nama_guru);$b++)
                               {
                                 echo "<option value='".ucwords(strtolower($nama_guru[$b]['nama_lengkap']))."' >".ucwords(strtolower($nama_guru[$b]['nama_lengkap']))."</option>";
                               }
                               ?>
                             </select>
                            </div>
                        </div>
                        <div class="form-bottom">
                            <div class="form-group">

                            </div>

                            <button type="button" class="btn btn-previous">Sebelumnya</button>
                            <button type="button" class="btn btn-next">Selanjutnya</button>
                            <p>
                              Syarat pengampu :
                              <ul>
                                <li>PNS golongan minimal IIIc</li>
                                <li>Tidak berstatus Pendaftar Calon Kepala Sekolah </li>
                                <li>Tidak berstatus Calon Pengawas</li>
                              </ul>
                            </p>
                        </div>
                    </fieldset>

                    <fieldset>
                          <div class="form-top">
                              <div class="form-top-left">
                                <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Sumbang Saran Pengampu Bidang</h3>
                                  <p>Usulan pengampu bidang Sarana & Prasarana</p>
                                  <select name="wakasarpras" class="form-control" placeholder="Usulan Waka. Bid. Sarana & Prasarana" required>
                                   <option value="" selected="selected">Pengampu Waka. Bidang Sarana</option>
                                 <?php
                                 for ($c=0;$c<count($nama_guru);$c++)
                                 {
                                   echo "<option value='".ucwords(strtolower($nama_guru[$c]['nama_lengkap']))."' >".ucwords(strtolower($nama_guru[$c]['nama_lengkap']))."</option>";
                                 }
                                 ?>
                               </select>
                              </div>
                          </div>
                          <div class="form-bottom">
                              <div class="form-group">

                              </div>

                              <button type="button" class="btn btn-previous">Sebelumnya</button>
                              <button type="button" class="btn btn-next">Selanjutnya</button>
                              <p>
                                Syarat pengampu :
                                <ul>
                                  <li>PNS golongan minimal IIIc</li>
                                  <li>Tidak berstatus Pendaftar Calon Kepala Sekolah </li>
                                  <li>Tidak berstatus Calon Pengawas</li>
                                </ul>
                              </p>
                          </div>
                      </fieldset>

                      <fieldset>
                            <div class="form-top">
                                <div class="form-top-left">
                                  <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Sumbang Saran Pengampu Bidang</h3>
                                    <p>Usulan pengampu bidang Kesiswaan</p>
                                    <select name="wakasis" class="form-control" placeholder="Usulan Waka. Bid. Kesiswaan" required>
                                     <option value="" selected="selected">Pengampu Waka. Bidang Kesiswaan</option>
                                   <?php
                                   for ($d=0;$d<count($nama_guru);$d++)
                                   {
                                     echo "<option value='".ucwords(strtolower($nama_guru[$d]['nama_lengkap']))."' >".ucwords(strtolower($nama_guru[$d]['nama_lengkap']))."</option>";
                                   }
                                   ?>
                                 </select>
                                </div>
                            </div>
                            <div class="form-bottom">
                                <div class="form-group">

                                </div>

                                <button type="button" class="btn btn-previous">Sebelumnya</button>
                                <button type="button" class="btn btn-next">Selanjutnya</button>
                                <p>
                                  Syarat pengampu :
                                  <ul>
                                    <li>PNS golongan minimal IIIc</li>
                                    <li>Tidak berstatus Pendaftar Calon Kepala Sekolah </li>
                                    <li>Tidak berstatus Calon Pengawas</li>
                                  </ul>
                                </p>
                            </div>
                        </fieldset>

                        <fieldset>
                              <div class="form-top">
                                  <div class="form-top-left">
                                    <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Sumbang Saran Pengampu Bidang</h3>
                                      <p>Usulan pengampu bidang HKI</p>
                                      <select name="wakahumas" class="form-control" placeholder="Usulan Waka. Bid. HKI" required>
                                       <option value="" selected="selected">Pengampu Waka. Bidang Humas</option>
                                     <?php
                                     for ($e=0;$e<count($nama_guru);$e++)
                                     {
                                       echo "<option value='".ucwords(strtolower($nama_guru[$e]['nama_lengkap']))."' >".ucwords(strtolower($nama_guru[$e]['nama_lengkap']))."</option>";
                                     }
                                     ?>
                                   </select>
                                  </div>
                              </div>
                              <div class="form-bottom">
                                  <div class="form-group">

                                  </div>

                                  <button type="button" class="btn btn-previous">Sebelumnya</button>
                                    <button type="submit" name="submit" class="btn" id="setuju">Selanjutnya</button>
                                    <p>
                                      Syarat pengampu :
                                      <ul>
                                        <li>PNS golongan minimal IIIc</li>
                                        <li>Tidak berstatus Pendaftar Calon Kepala Sekolah </li>
                                        <li>Tidak berstatus Calon Pengawas</li>
                                      </ul>
                                    </p>
                              </div>
                          </fieldset>



                </form>
            </div>
        </div>
    </div>
<?php
}
else {  //jika ada submit
  if (!isset($update))
  {
?>
  <fieldset>
        <div class="form-top">
            <div class="form-top-left">
              <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Konfirmasi usulan</h3>


            </div>
        </div>
        <div class="form-bottom">
            <div class="form-group">

            </div>

          <h3>Nama-nama berikut anda usulkan sebagai pengampu bidang,</h3>
          <ul>
            <li>Waka. Bidang Kurikulum : <?php echo $_POST['wakakur']; ?></li>
            <li>Waka. Bidang Sarana : <?php echo $_POST['wakasarpras']; ?></li>
            <li>Waka. Bidang Kesiswaan : <?php echo $_POST['wakasis']; ?></li>
            <li>Waka. Bidang HKI : <?php echo $_POST['wakahumas']; ?></li>

          </ul>
          <?php
          //$data=serialize($_POST);
           ?>
          <form role="form" class="registration-form" action="index.php" method="post" id="simpan">
            <?php
          foreach ($_POST as $x => $y)
              {
                  echo '<input type="hidden" name="data['.$x.']" value="'. $y. '">';
              }
            ?>
              <button type="submit" name="simpan" class="btn" id="simpan">Simpan</button>
          </form>


        </div>
    </fieldset>
<?php
} // end UPDATE
else {
  ?>
  <fieldset>
      <div class="form-top">
          <div class="form-top-left">
              <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span><?php echo $update; ?></h3>
                        </div>
      </div>

    </fieldset>
  <?php
}
} //end submit konfirmasi
} //end $_POST['simpan']
else {
  ?>
  <fieldset>
      <div class="form-top">
          <div class="form-top-left">
              <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Terimakasih</h3>
                        </div>
      </div>

    </fieldset>
  <?php
}
} // end cookie
else {
  ?>
  <fieldset>
      <div class="form-top">
          <div class="form-top-left">
              <h3><span><i class="fa fa-calendar-check-o" aria-hidden="true"></i></span>Anda sudah menyampaikan usul sumbang saran</h3>
                        </div>
      </div>

    </fieldset>
  <?php
}


?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>


</html>