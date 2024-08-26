<?php
//d($agenda);
if (isset($agenda) && !empty($agenda))
{
$rekap=[];
for ($a=0;$a<count($agenda);$a++)
{
    $tanggal=explode("-",$agenda[$a]['kode_agendaguru']);
    $tgl=$tanggal[1];
    if (!isset($rekap[$agenda[$a]['rombel']]))
    {
        $rekap[$agenda[$a]['rombel']]=[$tgl=>$agenda[$a]['absensi']];
    }
    else {
        $rekap[$agenda[$a]['rombel']][$tgl]=$agenda[$a]['absensi'];
    }
}

}
foreach ($rekap as $datanya=>$kelas)
{
    echo $datanya.'<br />';
    foreach ($kelas as $tgl_pbm => $arr_siswa_absen)
    {
        
        echo $tgl_pbm.'|';
    }
    echo '--------------------------------<br />';
}
//d($rekap);
// $table = new \CodeIgniter\View\Table();
// $template = ['table_open' => '<table border="1" cellpadding="4" cellspacing="0" class="table table-striped">'];
// $table->setHeading('No','NIS','Nama', 'JK','Catatan');
// //d($siswa);
// $no=1;
// foreach ($siswa as $siswanya)
// {
//     $table->addRow($no,$siswanya['nis'],$siswanya['nama_siswa'],$siswanya['jk'],'');
//     $no++;
// }

// $table->setTemplate($template);
// echo $table->generate();