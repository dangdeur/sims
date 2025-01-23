<div class="container">
<h2>Pengisian Absensi <?=$agenda['rombel'].' Jam Ke '.$agenda['jp0']."-".$agenda['jp1'] ?></h2>
<table class="table table-striped">
<tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama Siswa</th>
    <th>Presensi</th>
    <th>Catatan</th>
</tr>

<?php
//echo $kode_guru."-".$rombel."-".$mapel_agenda;
$no=1;
echo form_open('agendaguru/simpanpresensi');
foreach($siswa as $x)

{
echo '<tr>
<td>'.$no.'</td>
<td>'.$x['nis'].'</td>
<td>'.$x['nama_siswa'].'</td>
<td>';

// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'TL','checked'=>set_radio('absensi'.$no,'TL')]).'TL ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'BL','checked'=>set_radio('absensi'.$no,'BL')]).'BL ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'D','checked'=>set_radio('absensi'.$no,'D')]).'D ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'S','checked'=>set_radio('absensi'.$no,'S')]).'S ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'I','checked'=>set_radio('absensi'.$no,'I')]).'I ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'A','checked'=>set_radio('absensi'.$no,'A')]).'A ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'H','checked'=>set_radio('absensi'.$no,'H')]).'H ';
//tanpa H
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'TL','checked'=>FALSE]).'TL ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'BL','checked'=>FALSE]).'BL ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'D','checked'=>FALSE]).'D ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'S','checked'=>FALSE]).'S ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'I','checked'=>FALSE]).'I ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'A','checked'=>FALSE]).'A ';
echo form_hidden('nis'.$no, $x['nis']);
echo form_hidden('nama_siswa'.$no, $x['nama_siswa']);

            
echo '</td>
<td>'.
form_input('catatan'.$no,'',['placeholder'=>'Catatan','class'=>'form-control'],'text')
     .'</td>
</tr>';
$no++;
}
// $siswa=json_encode($siswa);
// echo form_hidden('siswa',$siswa );
echo form_hidden('id_agendaguru', $agenda['id_agendaguru']);
echo form_hidden('jumlah_siswa', $no);
echo '<tr><td colspan=5>'.form_submit('simpanpresensi', 'Simpan',['class'=>'form-control btn btn-warning']).'</td></tr>';
echo form_close();
?>
</table>
</div>