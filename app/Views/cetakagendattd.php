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
  <td style="width: 75%;text-align: left;"><?= $staf['nama'] ?></td>
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
  $jam_awal=explode('-',JP[$hari][$agenda[$a]['jp0']]);
  $jam_akhir=explode('-',JP[$hari][$agenda[$a]['jp1']]);
  echo '<tr>
          <td style="width: 5%;text-align: center;">'.$no;
  echo '</td><td style="width: 20%;text-align: center;">'.$tanggal.'</td>
          <td style="width: 75%;text-align: left;">Mengajar '.$agenda[$a]['mapel'].' di '.$agenda[$a]['rombel'].' dari jam '.$jam_awal[0].'-'.$jam_akhir[1].'</td>
  </tr>';
 
  $no++;
}
?>
  </tbody>
  </table>


<br /><br />
<table border="0" cellspacing="2" cellpadding="2">
  <tr>
  <td style="width: 33%;text-align: center;"></td>
  <td style="width: 33%;text-align: center;"></td>
  <td style="width: 33%;text-align: center;">Pandeglang, <?php echo date("d").' '. BULAN[date("m")].' '.date("Y"); ?></td>
  </tr>

  <tr>
  <td style="width: 33%;text-align: center;">Kepala Sekolah</td>
  <td style="width: 33%;text-align: center;">Wakabid. Kurikulum</td>
  <td style="width: 33%;text-align: center;">Guru<br /><br /><br /><br /></td>
  </tr>

  <tr>
  <td style="width: 33%;text-align: center;"><?=PEJABAT['kepsek']['nama']?></td>
  <td style="width: 33%;text-align: center;"><?=PEJABAT['wakakur']['nama']?></td>
  <td style="width: 33%;text-align: center;"></td>
  </tr>

  <tr>
  <td style="width: 33%;text-align: center;"><?=PEJABAT['kepsek']['nip']?></td>
  <td style="width: 33%;text-align: center;"><?=PEJABAT['wakakur']['nip']?></td>
  <td style="width: 33%;text-align: center;"></td>
  </tr>
  
</table>

