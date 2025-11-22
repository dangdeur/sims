<div class="container-fluid">
<h3>Pemilihan Tenaga Kependidikan Favorit</h3>
<p>Berilah umpan balik pada kinerja Tenaga Pendidikan di Sekolah.
   Skor tertinggi adalah 5 dan terendah adalah 1. Anda bisa mengisi lebih dari satu Tenaga Pendidik. 
   Pengisian anda akan dirahasiakan.</p>


<?php
// d($guru);
echo form_open('simpanvotingtendik');
$no=1;
echo '<table class="table table-striped">
<thead>
<tr>
<th>No</th>
<th>Nama Tendik</th>
<th>Nilai</th>
</tr>
</thead><tbody>';
foreach ($tendik as $g) 
  {
echo '<tr>
<td>'.$no.'</td>
<td>'.$g['nama_gelar'].'</td>
<td>';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>0,'checked'=>FALSE]).'0 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>1,'checked'=>FALSE]).'1 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>2,'checked'=>FALSE]).'2 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>3,'checked'=>FALSE]).'3 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>4,'checked'=>FALSE]).'4 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>5,'checked'=>FALSE]).'5 ';

$data_hidden=['kode_tendik'.$no=>$g['kode_staf']];
echo form_hidden($data_hidden);

echo '</td>

</tr>';
$no++;


  }
 
  echo form_hidden('jumlah_tendik', (string)$no);
  echo '<tr><td colspan="4">'.form_submit('submit','Simpan',['class'=>'btn btn-primary']).'</td></tr>';
  echo '</tbody></table>';

echo form_close();
?>

</div>