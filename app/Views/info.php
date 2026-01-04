  <!-- <div class="container-xl mb-4">
    <p>Matching .container-xl...</p>
  </div> -->


  <div>
    <div class="bg-body-tertiaryp-5 rounded">
      <div class="col-sm-8 mx-auto">
        <button onclick="enableNotif()">Aktifkan Notifikasi</button>
        <?php


        if (isset($gantipassword)) {
          echo 'Anda menggunakan password bawaan, beresiko terjadi penyalahgunaan. <a class="btn btn-primary" href="login/gantipassword/' . $id_pengguna . '">Ganti Password</a>';
        }

        

        if ($voting)  {
          echo '<p>Terima kasih <strong>'. $nama_lengkap.'</strong>, telah berpartisipasi dalam Pemilihan Tenaga Kependidikan Favorit 2025. Penilaian yang anda lakukan adalah,</p>';
          echo '<table class="table table-striped">
                <tr><th>No</th><th>Tenaga Kependidikan</th><th>Nilai</th></tr>';
          $no = 1;
          for ($i = 0; $i < count($voting); $i++) {
            echo '<tr>
            <td>' . $no . '</td>
            <td>' . $staf[$voting[$i]['kode_staf']]['nama_gelar'] . '</td>
           
            <td>' . $voting[$i]['nilai'] . '</td>
            </tr>';
            $no++;
          }
          echo '</table>';
          echo '<p>Untuk merubah penilaian anda, hapus dulu penilaian sebelumnya
           <a class="btn btn-danger" href="tenpreshapus">Hapus</a></p>';
        }
        else {
          if($level=='Guru') {
         if (isset($kegiatan)) {
          echo 'Ada kegiatan <strong>'.$kegiatan['nama_kegiatan'].'</strong> '.$kegiatan['deskripsi'].' <a class="btn btn-primary" href="'.$kegiatan['link'].'">Partisipasi</a>';
        }
        }
        }

        // if (isset($info)) {
        //   echo $pager->links('default', 'paginasi');
        //   $table = new \CodeIgniter\View\Table();
        //   $template = ['table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table ">'];
        //   $table->setHeading('No', 'Tanggal', 'Informasi');



        //   $no = 1;
        //   for ($a = 0; $a < count($info); $a++) {
        //     $kode = explode(" ", $info[$a]['tanggal']);
        //     $hari = explode("-", $kode[0]);

        //     $tanggal = $hari[2] . " " . BULAN[$hari[1]] . " " . $hari[0];

        //     $table->addRow($no, $tanggal, $info[$a]['info']);
        //     $no++;
        //   }
        //   $table->setTemplate($template);
        //   echo $table->generate();
        // }



        ?>


      </div>
    </div>
  </div>
   <script>
        navigator.serviceWorker.register("sw.js");

        function enableNotif() {
            Notification.requestPermission().then((permission)=> {
                if (permission === 'granted') {
                    // get service worker
                    navigator.serviceWorker.ready.then((sw)=> {
                        // subscribe
                        sw.pushManager.subscribe({
                            userVisibleOnly: true,
                            applicationServerKey: "BB5JPlQO1Hjgw6wkcyGM3mXI72qLTSE75onjiaYskVxLuyM_NQQiQrhsBtcFzARSNqn36tHW5zFEm2nGe3yP9PQ"
                        }).then((subscription)=> {
                            // console.log(JSON.stringify(subscription));
                            JSON.stringify(subscription);
                        });
                    });
                }
            });
        }
    </script>

    <!-- 
    {"endpoint":"https://fcm.googleapis.com/fcm/send/fyRHP1sXJBU:APA91bG4Zv7aSU3HeW7ztr0TKbM7tw7_T6q8WZRR7AsYk9fSBRHu3n6K1Yl3LyGSoAw-_WnDjntO6KxFlHTaEnnWLMyPCt3eUNNcoM3KCNibA2I3H2LI6EW8iWCxLi55ihssKotvfSkF","expirationTime":null,"keys":{"p256dh":"BCBNk-hLu0unHlqDH_eclUo0XpAuaIYViOZI9D89VRoLzX_4U60OoF_nr1MtlKH7gK4lKhn5nJoVz5X7HDwqW7A","auth":"v4Dpcu6JPG5JB8geKBrrQQ"}}
    -->
    