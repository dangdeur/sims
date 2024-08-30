<table border="0" cellspacing="3" cellpadding="2">
  <tr>
  <td colspan="2" style="text-align: center;"><h3>Agenda Tugas Tambahan</h3></td>
  </tr>
  <tr>
  <td colspan="2" style="text-align: center;"><h3><?= $bulan ?></h3></td>
  </tr>

  <tr>
  <td style="width: 20%;text-align: left;">Nama</td>
  <td style="width: 5%;text-align: left;">:</td>
  <td style="width: 75%;text-align: left;"><?= $staf['nama_gelar'] ?></td>
  </tr>

  <tr>
  <td style="width: 20%;text-align: left;">NIP</td>
  <td style="width: 5%;text-align: left;">:</td>
  <td style="width: 75%;text-align: left;"><?= $staf['nip'] ?></td>
  </tr>
</table>

<br /><br />
<table border="1" cellspacing="3" cellpadding="2">
<thead> 
<tr>
   
  <th style="width: 5%;text-align: center;">No</th>
  <th style="width: 20%;text-align: center;">Tanggal</th>
  <th style="width: 75%;text-align: center;">Uraian</th>
  </tr>
  </thead>
  <tbody>
<?php
$no=1;
for ($a=0;$a<count($agenda);$a++)
{
  $kode=explode("-",$agenda[$a]['kode_agendatuta']);
  $tgl=substr($kode[1],0,2);
  $bln=BULAN[substr($kode[1],2,2)];
  $thn=substr($kode[1],4,4);
  $tanggal= $tgl.' '.$bln.' '.$thn;
  echo '<tr>
          <td style="width: 5%;text-align: center;">'.$no;
  echo '</td><td style="width: 20%;text-align: center;">'.$tanggal.'</td>
          <td style="width: 75%;text-align: left;">'.$agenda[$a]['aktifitas'].'</td>
  </tr>';
 
  $no++;
}
?>
  </tbody>
  </table>


<!-- <br /><br />
<table border="0" cellspacing="2" cellpadding="2">
  <tr>
  <td style="width: 33%;text-align: center;"></td>
  <td style="width: 33%;text-align: center;"></td>
  <td style="width: 33%;text-align: center;">Pandeglang, <?php echo date("d-m-Y"); ?><br /><br />
  <img src="data:image/png;base64, <?php echo base64_encode($qr) ?>" />
</td>
  </tr>
  
</table> -->

<br /><br />
<table border="0" cellspacing="2" cellpadding="2" nobr="true">
  
  <tr>
  <td style="width: 33%;text-align: center;"></td>
  <td style="width: 33%;text-align: center;"></td>
  <td style="width: 33%;text-align: center;">Pandeglang, <?php echo date("d").' '. BULAN[date("m")].' '.date("Y"); ?></td>
  </tr>

  <tr>
  <td style="width: 33%;text-align: center;">Kepala Sekolah</td>
  <?php
  if (isset($walas))
  {
  echo '<td style="width: 33%;text-align: center;">Wakabid. Kurikulum</td>';
  }
  else {
    echo '<td style="width: 33%;text-align: center;"></td>';
  }
  ?>
  <td style="width: 33%;text-align: center;">Pengampu bidang/jabatan<br /><br /><br /><br /></td>
  </tr>

  <tr>
  <td style="width: 33%;text-align: center;"><?=PEJABAT['kepsek']['nama']?></td>
  <?php
  if (isset($walas))
  {
  echo '<td style="width: 33%;text-align: center;">'.PEJABAT['wakakur']['nama'].'</td>';
  }
  else {
    echo '<td style="width: 33%;text-align: center;"></td>';
  }
  ?>
  <td style="width: 33%;text-align: center;"><?= $staf['nama_gelar'] ?></td>
  </tr>

  <tr>
  <td style="width: 33%;text-align: center;">NIP. <?=PEJABAT['kepsek']['nip']?></td>
  <?php
  if (isset($walas))
  {
    echo '<td style="width: 33%;text-align: center;">'.PEJABAT['wakakur']['nip'].'</td>';
  }
  else 
  {
    echo '<td style="width: 33%;text-align: center;"></td>';
  }
  
  
    if (isset($staf['nip']))
    {
      echo '<td style="width: 33%;text-align: center;">NIP. '.$staf['nip'].'</td>';
    }
    else {
      echo '<td style="width: 33%;text-align: center;"></td>';
    }
  
 ?>
  </tr>

</table>
