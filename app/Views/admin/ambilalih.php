<?php
$table = new \CodeIgniter\View\Table();
$table->setHeading('No', 'Nama', 'Aksi');

$no=1;
for ($a=0;$a<count($pengguna);$a++)
{
$table->addRow($no, $pengguna[$a]['nama_lengkap'], '<a href="'.site_url('admin/ambilalih/'.$pengguna[$a]['id_pengguna']).'")>AA</a>');
$no++;
}

echo $table->generate();