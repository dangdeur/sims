<table class="table">
<tr>
    <th>No</th>
    <th>NIS</th>
    <th>Nama Siswa</th>
    <th>Presensi</th>
    <th>Catatan</th>
</tr>

<?php
// echo $tess;
//  dd($siswa);
$no=1;
echo form_open('presensisiswa/simpan');
foreach($siswa as $x)

{
echo '<tr>
<td>'.$no.'</td>
<td>'.$x['nis'].'</td>
<td>'.$x['nama_siswa'].'</td>
<td>';

echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'TL','checked'=>set_radio('absensi'.$no,'TL')]).'TL ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'BL','checked'=>set_radio('absensi'.$no,'BL')]).'BL ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'D','checked'=>set_radio('absensi'.$no,'D')]).'D ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'S','checked'=>set_radio('absensi'.$no,'S')]).'S ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'I','checked'=>set_radio('absensi'.$no,'I')]).'I ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'A','checked'=>set_radio('absensi'.$no,'A')]).'A ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'H','checked'=>set_radio('absensi'.$no,'H')]).'H ';
            
echo '</td>
<td>'.
form_input('catatan'.$no,'',['placeholder'=>'Catatan','class'=>'form-control'],'text')
     .'</td>
</tr>';
$no++;
}
echo '<tr><td colspan=5>'.form_submit('simpanabsensi', 'Simpan',['class'=>'form-control']).'</td></tr>';
echo form_close();
?>
</table>