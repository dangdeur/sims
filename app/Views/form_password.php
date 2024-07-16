  <!-- <div class="container-xl mb-4">
    <p>Matching .container-xl...</p>
  </div> -->


    <div>
      <div class="bg-body-tertiaryp-5 rounded">
        <div class="col-sm-8 mx-auto">
          <h3>Penggantian password : <?= $nama_lengkap ?></h3>
          <?php
            echo form_open('login/gantipassword/'.$id_pengguna);
            echo form_password(['name'=>'passwordbaru','id'=>'passwordbaru','placeholder'=>'Password baru','class'=>'form-control']);
            echo '<br /><button class="w-100 btn btn-lg btn-primary" type="submit">Ganti Password</button>';
            echo form_close();

          ?>
         
        </div>
      </div>
    </div>
