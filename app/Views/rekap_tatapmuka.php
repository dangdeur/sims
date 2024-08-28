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
    $jum_tm=[];
    foreach ($kelas as $tgl_pbm => $arr_siswa_absen)
    {
        
        echo $tgl_pbm.'|';
        $jum_tm []=$tgl_pbm;
    }
    echo '--------------------------------<br />';
}
//d($rekap);

// $table = new \CodeIgniter\View\Table();
// $template = ['table_open' => '<table border="1" cellpadding="4" cellspacing="0" class="table table-striped">'];
// $table->setHeading('No','NIS','Nama', $tgl_tm,'Catatan');
// //d($siswa);
// $no=1;
// foreach ($siswa as $siswanya)
// {
//     $table->addRow($no,$siswanya['nis'],$siswanya['nama_siswa'],$siswanya['jk'],'');
//     $no++;
// }

// $table->setTemplate($template);
// echo $table->generate();
?>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>NIS</th>
            <th>Nama</th>
            <?php
                //$tgl_tm='';
                for ($b=0;$b<count($jum_tm);$b++)
                {
                    $tgl_tm=substr($jum_tm[$b],0,4);
                  echo '<th>'.$tgl_tm.'</th>';
                }
            ?>
        </tr>
    </thead>
    <tbody>
                
    <?php
    $no=1;
                
                for ($c=0;$c<count($siswa);$c++)
                {
                    
                  echo '<tr>
                    <td>'.$no.'</td>
                    <td>'.$siswa[$c]['nis'].'</td>
                    <td>'.$siswa[$c]['nama_siswa'].'</td>
                    <td>'.$tgl_tm.'</td>';
                    
                    for ($d=0;$d<count($jum_tm);$d++)
                {
                    $tgl_tm=substr($jum_tm[$d],0,4);
                  echo '<th>'.$tgl_tm.'</th>';
                }
                    echo '</tr>';
                    $no++;
                }
            ?>
               

</tbody>
            </table>