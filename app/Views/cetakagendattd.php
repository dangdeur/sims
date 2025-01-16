<table border="0" cellspacing="3" cellpadding="2">
  <tr>
  <td colspan="2" style="text-align: center;"><h3>Agenda Harian Mengajar</h3></td>
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
  $kode=explode("-",$agenda[$a]['kode_agendaguru']);
  $tgl=substr($kode[1],0,2);
  $bln=BULAN[substr($kode[1],2,2)];
  $thn=substr($kode[1],4,4);
  $tanggal= $tgl.' '.$bln.' '.$thn;
  
  $tgl_barat=$thn.'-'.substr($kode[1],2,2).'-'.$tgl;
  $waktu=strtotime($tgl_barat);
  $hari=date('N',$waktu);
  $jam_awal=explode(' ',JP[$hari][$agenda[$a]['jp0']]);
  $jam_awal_fix=explode('-',$jam_awal[2]);
  
  //d($jam_awal);
  
  $jam_akhir=explode('-',JP[$hari][$agenda[$a]['jp1']]);
  //d($jam_akhir);
  echo '<tr>
          <td style="width: 5%;text-align: center;">'.$no;
  echo '</td><td style="width: 20%;text-align: center;">'.$tanggal.'</td>
          <td style="width: 75%;text-align: left;">Mengajar '.$agenda[$a]['mapel'].' di '.$agenda[$a]['rombel'].' jam '.$jam_awal_fix[0].'-'.$jam_akhir[1].'</td>
  </tr>';
  $bulan_aktif =substr($kode[1],2,2);
 
  $no++;
}

?>
  </tbody>
  </table>


<br /><br />
<table cellspacing="2" cellpadding="2" nobr="true">
<?php

  $tanggal_akhir = cal_days_in_month(CAL_GREGORIAN, $bulan_aktif, date("Y")); // 31
  ?>
  <tr>
  <td style="width: 33%;text-align: center;"></td>
  <td style="width: 33%;text-align: center;"></td>
  <td style="width: 33%;text-align: center;">Pandeglang, <?php echo $tanggal_akhir.' '. BULAN[$bulan_aktif].' '.$thn; ?></td>
 
  <!-- <td style="width: 33%;text-align: center;">Pandeglang, <?php echo date("t m Y", strtotime($tanggal)); ?></td> -->
  
  </tr>

  <tr>
  <td style="width: 33%;text-align: center;">Kepala Sekolah</td>
  <td style="width: 33%;text-align: center;">Wakabid. Kurikulum</td>
  <td style="width: 33%;text-align: center;">Guru Matapelajaran<br /><br /><br /><br /></td>
  </tr>

  <tr>
  <td style="width: 33%;text-align: center;"><?=PEJABAT['kepsek']['nama']?></td>
  <td style="width: 33%;text-align: center;"><?=PEJABAT['wakakur']['nama']?></td>
  <td style="width: 33%;text-align: center;"><?= $staf['nama_gelar'] ?></td>
  </tr>

  <tr>
  <td style="width: 33%;text-align: center;">NIP. <?=PEJABAT['kepsek']['nip']?></td>
  <td style="width: 33%;text-align: center;">NIP. <?=PEJABAT['wakakur']['nip']?></td>
  <?php
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

