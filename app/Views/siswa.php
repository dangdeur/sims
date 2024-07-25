<?php
$table = new \CodeIgniter\View\Table();
$template = ['table_open' => '<table border="1" cellpadding="4" cellspacing="0" class="table table-striped">'];
$table->setHeading('No','NIS','Nama', 'JK','Catatan');
//d($siswa);
$no=1;
foreach ($siswa as $siswanya)
{
    $table->addRow($no,$siswanya['nis'],$siswanya['nama_siswa'],$siswanya['jk'],'');
    $no++;
}

$table->setTemplate($template);
echo $table->generate();