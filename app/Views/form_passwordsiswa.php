  <!-- <div class="container-xl mb-4">
    <p>Matching .container-xl...</p>
  </div> -->


    <div>
      <div class="bg-body-tertiaryp-5 rounded">
        <div class="col-sm-8 mx-auto">
          <h3>Penggantian password : <?= $nama_siswa ?></h3>
          <?php
            echo form_open('login/gantipasswordsiswa/'.$id_siswa);
            echo '<div class="row">';
            echo '<div class="col">';
            echo form_password(['name'=>'passwordbaru','id'=>'passwordbaru','placeholder'=>'Password baru','class'=>'form-control']);
            echo '</div>';
            echo '<div class="col">';
            //echo form_checkbox('','',false,'onClick="pass()"').' Tampilkan';
            echo form_checkbox(['onClick'=>'pass()']).' Tampilkan';
            echo '</div>';
            echo '</div>';
            echo '<br /><button class="w-100 btn btn-lg btn-primary" type="submit">Ganti Password</button>';
            echo form_close();

          ?>
         
        </div>
      </div>
    </div>
    <script>

function pass() {
  var x = document.getElementById("passwordbaru");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
</script>