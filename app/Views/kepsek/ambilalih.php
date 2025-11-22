<?php
$table = new \CodeIgniter\View\Table();
$table->setHeading('No', 'Nama', 'Ambil Alih','Reset');

$no=1;
for ($a=0;$a<count($pengguna);$a++)
{
$table->addRow($no, $pengguna[$a]['nama_lengkap'], '<a href="'.site_url('admin/ambil_alih/'.$pengguna[$a]['id_pengguna']).'")>AA</a>',
            '<a href="'.site_url('admin/reset/'.$pengguna[$a]['id_pengguna']).'")>R</a>'
);
$no++;
}

echo $table->generate();