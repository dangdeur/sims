<div class="container">
<h3>Pemilihan Guru Favorit</h3>
<p>Berilah umpan balik pada guru yang mengajar di kelas anda berpatokan pada kriteria berikut,</p>


<dl>
<dt>Penguasaan materi dan kemampuan mengajar</dt>
<dd>Pemahaman guru terhadap materi pelajaran, Kemampuan menyampaikan materi dengan jelas dan mudah dimengerti, metode atau cara mengajar yang bervariasi dan menyenangkan.
, memotivasi siswa untuk belajar, Kemahiran dalam menggunakan alat bantu mengajar, Kemampuan membimbing siswa saat mengalami kesulitan</dd>
<dt>Perilaku dan kepribadian</dt>
<dd>Sikap ramah, santun, sabar, empati, peduli,adil, dan memberi contoh baik kepada siswa.</dd>

<dt>Pengelolaan kelas dan interaksi</dt>
<dd>Disiplin guru dalam memulai dan mengakhiri pelajaran tepat waktu, tidak mendominasi, memberikan banyak kesempatan bagi siswa untuk bertanya, berinteraksi, 
  dan berpartisipasi, memberikan perhatian dan mendengarkan tanggapan siswa dengan baik, memberikan feedback yang tepat dan konstruktif terhadap pertanyaan dan 
  jawaban siswa, menyikapi kesalahan siswa sebagai bagian dari proses belajar.</dd>
</dl>

<p>Pilih skor 5 jika semua aspek diatas terlihat dengan kuat dan konsisten. Pengisian anda akan dirahasiakan</p>

<?php
// d($guru);
echo form_open('simpanvoting');
$no=1;
echo '<table class="table table-striped">
<thead>
<tr>
<th>No</th>
<th>Nama Guru</th>
<th>Mata Pelajaran</th>
<th>Nilai</th>
</tr>
</thead><tbody>';
foreach ($guru as $g) 
  {
echo '<tr>
<td>'.$no.'</td>
<td>'.$g['nama_guru'].'</td>
<td>'.$g['mapel_guru'].'</td>
<td>';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'TL','checked'=>set_radio('absensi'.$no,'TL')]).'TL ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'BL','checked'=>set_radio('absensi'.$no,'BL')]).'BL ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'D','checked'=>set_radio('absensi'.$no,'D')]).'D ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'S','checked'=>set_radio('absensi'.$no,'S')]).'S ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'I','checked'=>set_radio('absensi'.$no,'I')]).'I ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'A','checked'=>set_radio('absensi'.$no,'A')]).'A ';
// echo form_radio($datanya=['name'=>'absensi'.$no,'id'=>'absensi'.$no,'value'=>'H','checked'=>set_radio('absensi'.$no,'H')]).'H ';
//tanpa H
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>0,'checked'=>FALSE]).'0 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>1,'checked'=>FALSE]).'1 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>2,'checked'=>FALSE]).'2 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>3,'checked'=>FALSE]).'3 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>4,'checked'=>FALSE]).'4 ';
echo form_radio($datanya=['name'=>'nilai'.$no,'id'=>'nilai'.$no,'value'=>5,'checked'=>FALSE]).'5 ';

echo form_hidden('kode_guru'.$no, $g['kode_guru']);

echo '</td>

</tr>';
$no++;


  }
 
  echo form_hidden('jumlah_guru', (string)$no);
  echo '<tr><td colspan="4">'.form_submit('submit','Simpan',['class'=>'btn btn-primary']).'</td></tr>';
  echo '</tbody></table>';

echo form_close();
?>

</div>