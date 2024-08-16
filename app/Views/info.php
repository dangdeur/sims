  <!-- <div class="container-xl mb-4">
    <p>Matching .container-xl...</p>
  </div> -->


    <div>
      <div class="bg-body-tertiaryp-5 rounded">
        <div class="col-sm-8 mx-auto">
          <?php
           
          
            if (isset($gantipassword))
            {
              echo 'Anda menggunakan password bawaan, beresiko terjadi penyalahgunaan. <a class="btn btn-primary" href="login/gantipassword/'.$id_pengguna.'">Ganti Password</a>';
            }
          
          if (isset($info))
          {
            echo $pager->links('default', 'paginasi');
            $table = new \CodeIgniter\View\Table();
$template = ['table_open' => '<table border="0" cellpadding="4" cellspacing="0" class="table ">'];
$table->setHeading('No','Tanggal', 'Informasi');
            


$no=1;
            for ($a=0;$a<count($info);$a++)
            {
              $kode=explode(" ",$info[$a]['tanggal']);
              $hari=explode("-",$kode[0]);

$tanggal= $hari[2]." ".BULAN[$hari[1]]." ".$hari[0];

              $table->addRow($no,$tanggal,$info[$a]['info']);
              $no++;
            }
            $table->setTemplate($template);
            echo $table->generate();
          }
          
          
          
          ?>
         
         
        </div>
      </div>
    </div>
