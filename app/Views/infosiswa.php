  <!-- <div class="container-xl mb-4">
    <p>Matching .container-xl...</p>
  </div> -->


  <div>
    <div class="bg-body-tertiaryp-5 rounded">
      <div class="col-sm-8 mx-auto">
        <?php


        if (isset($gantipassword)) {
          echo '<p>Anda menggunakan password bawaan, beresiko terjadi penyalahgunaan. <a class="btn btn-primary" href="login/gantipasswordsiswa/' . $id_siswa . '">Ganti Password</a></p>';
        }

         if (!$voting) {
          echo '<p>Ada kegiatan <strong>Pemilihan Guru Favorit</strong> <a class="btn btn-primary" href="gupres">Partisipasi</a></p>';
        }
        else {
          echo '<p>Terima kasih telah berpartisipasi dalam Pemilihan Guru Favorit. Untuk merubah penilaian anda, hapus dulu penilaian sebelumnya
           <a class="btn btn-primary" href="gupreshapus">Hapus</a></p>';

           
        }

        if (isset($info)) {
          echo $pager->links('default', 'paginasi');
          $table = new \CodeIgniter\View\Table();
          $template = ['table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table ">'];
          $table->setHeading('No', 'Tanggal', 'Informasi');



          $no = 1;
          for ($a = 0; $a < count($info); $a++) {
            $kode = explode(" ", $info[$a]['tanggal']);
            $hari = explode("-", $kode[0]);

            $tanggal = $hari[2] . " " . BULAN[$hari[1]] . " " . $hari[0];

            $table->addRow($no, $tanggal, $info[$a]['info']);
            $no++;
          }
          $table->setTemplate($template);
          echo $table->generate();
        }



        ?>


      </div>
    </div>
  </div>
  <!-- <script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>
    <script>
  const beamsClient = new PusherPushNotifications.Client({
    instanceId: '858941f5-5fbe-49b7-8202-2031c0e0fb06',
  });

  beamsClient.start()
    .then(() => beamsClient.addDeviceInterest('hello'))
    .then(() => console.log('Successfully registered and subscribed!'))
    .catch(console.error);
</script> -->