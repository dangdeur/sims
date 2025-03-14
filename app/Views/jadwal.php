<?php
$table = new \CodeIgniter\View\Table();
$template = ['table_open' => '<table border="1" cellpadding="4" cellspacing="0" class="table">'];
?>

<div class="container-xl mb-4">
  <h1>Jadwal PBM</h1>
  <?php
  
 $table->setHeading('Hari','Jam', 'Kelas','Mapel');
//  dd($jadwal);
  foreach ($jadwal as $h => $d) { //$h hari, $d kelas=>...,mapel=>...
    
   foreach ($d as $key=>$value) {
      
      //$kelas=$value['kelas'];
      //$mapel=$value['mapel'];
      
      //if(isset($kelas_seb) && $kelas_seb === $kelas)
      if(isset($hari_seb) && $hari_seb == $h)
      {
        $hari='';
        $harinya=1;
      }
      else {
        $hari=$h;
        $harinya=0;
      }
      if(isset($kelas_seb) && $kelas_seb == $value['kelas'] && $harinya==1)
      {
        $kelas='';
        $mapel='';
      }
      else {
        if($value['kelas'] != 'Piket')
        {
        $kelas = $value['kelas'];
        $mapel=$value['mapel'];
        }
        else {
          $kelas='';
          $mapel='Piket';
        }
        
      }
      // if(isset($mapel_seb) && $mapel_seb == $value['mapel'])
      // {
      //   $mapel='';
      // }
      // else {
      //   $mapel=$value['mapel'];
      // }
      $hari_seb=$h;
      $kelas_seb=$value['kelas'];
      $mapel_seb=$value['mapel'];
      if ($ramadhan)
      {
        $jam_pbm=JAM_PBM_RAMADHAN;
      }
      else {
        $jam_pbm=JAM_PBM;
      }
      $table->addRow($hari,$jam_pbm[$key],$kelas,$mapel);
      //$table->addRow($hari,$kelas,$kelas,$mapel);
      //$hariyangsama=false;
    }
    
  }

  $table->setTemplate($template);
  echo $table->generate();
  ?>
</div>
