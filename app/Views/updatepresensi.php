<?php
//echo $kode_guru."-".$rombel."-".$mapel_agenda;
//$absen_lama=json_decode($agenda['absensi'],true);
//d($absen_lama);
// function cek($nis,$absen_lama)
// {
foreach ($absen_lama as $absensinya=>$orangnya) 
{
    if (count($orangnya)>0)
    {
        for ($tl=0;$tl<count($orangnya);$tl++)
        {
            $data_lama[$absensinya][]=$absen_lama[$absensinya][$tl]['nis'];
            //$datanya=array_column($absen_lama[$absensinya],'nis');
            $data_lama_catatan[$absen_lama[$absensinya][$tl]['nis']]=$absen_lama[$absensinya][$tl]['catatan'];
        }
    }
    
    //$datanya=array_column($absen_lama[$absensinya],'nis',$absensinya);
    
}
//$niss=array_column($absen_lama,null,'nis');
//d($data_lama_catatan);
//}
?>
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


function cari($nis, $arr) {
    // foreach ($arr as $ab => $ni) {
    //     if ($ni === $nis) {
    //         return $ab;
    //     }
    // }
    // return null;

    return $key = array_search($nis, array_column($arr, 'nis'));
 }

 function adakah($nis,$arr) {
    if(isset($arr))
    {
    if (in_array($nis,$arr))
    {
        return TRUE;
    }
    else {
        return FALSE;
    }
    }
 }

 //echo adakah('1024.12904',$datanya);
//echo adakah('1024.12904',$absen_lama['TL']) ? 'TRUE' : 'FALSE';
//echo adakah('1024.12904',$datanya['TL']) ? 'TRUE' : 'FALSE';
//exit();
$no=1;
echo form_open('agendaguru/simpanpresensi');
foreach($siswa as $x)

{
echo '<tr>
<td>'.$no.'</td>
<td>'.$x['nis'].'</td>
<td>'.$x['nama_siswa'].'</td>
<td>';
if (isset($data_lama['TL']))
{
    $tll=adakah($x['nis'],$data_lama['TL']) ? TRUE : FALSE; 
}
else {
    $tll=false;
}
if (isset($data_lama['BL']))
{
    $bll=adakah($x['nis'],$data_lama['BL']) ? TRUE : FALSE; 
}
else {
    $bll=false;
}
if (isset($data_lama['D']))
{
    $dd=adakah($x['nis'],$data_lama['D']) ? TRUE : FALSE; 
}
else {
    $dd=false;
}
if (isset($data_lama['S']))
{
    $ss=adakah($x['nis'],$data_lama['S']) ? TRUE : FALSE; 
}
else {
    $ss=false;
}
if (isset($data_lama['I']))
{
    $ii=adakah($x['nis'],$data_lama['I']) ? TRUE : FALSE; 
}
else {
    $ii=false;
}
if (isset($data_lama['A']))
{
    $aa=adakah($x['nis'],$data_lama['A']) ? TRUE : FALSE; 
}
else {
    $aa=false;
}
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'TL','checked'=>$tll]).'TL ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'BL','checked'=>$bll]).'BL ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'D','checked'=>$dd]).'D ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'S','checked'=>$ss]).'S ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'I','checked'=>$ii]).'I ';
echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'A','checked'=>$aa]).'A ';
echo form_hidden('nis'.$no, $x['nis']);
echo form_hidden('nama_siswa'.$no, $x['nama_siswa']);

            
echo '</td>
<td>';
if (isset($data_lama_catatan[$x['nis']]))
{
//adakah($x['nis'],$data_lama_catatan) ? $data_lama_catatan[$x['nis']]:"".
echo form_input('catatan'.$no,$data_lama_catatan[$x['nis']] ,['placeholder'=>'Catatan','class'=>'form-control'],'text');
}
else {
    echo form_input('catatan'.$no,'' ,['placeholder'=>'Catatan','class'=>'form-control'],'text');
}
echo      '</td>
</tr>';
$no++;
}
// $siswa=json_encode($siswa);
// echo form_hidden('siswa',$siswa );
echo form_hidden('id_agendaguru', $agenda['id_agendaguru']);
echo form_hidden('jumlah_siswa', $no);
echo '<tr><td colspan=5>'.form_submit('simpanpresensi', 'Simpan',['class'=>'form-control']).'</td></tr>';
echo form_close();
?>
</table>