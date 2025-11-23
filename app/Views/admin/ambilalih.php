<?php
$table = new \CodeIgniter\View\Table();
// getFlashdata(error);
$error = session()->getFlashdata('error');
$sukses = session()->getFlashdata('succsess');
if (isset($error))
{
    echo '<div class="alert alert-danger">'.$error.'</div>';
}
if (isset($sukses))
{
    echo '<div class="alert alert-success">'.$sukses.'</div>';
}
$table->setHeading('No', 'Nama', 'email','password','Ambil Alih','Reset');

$no=1;
for ($a=0;$a<count($pengguna);$a++)
{
    if ($pengguna[$a]['password']=='$2y$10$gmuUGgcI/m1w1vuEqrDRTeeurrN2D0PhGklbuwAwA0Bo9HeFs8EB2')
    {
        $pass='';
    }
    else
    {
        $pass='Diubah';
    }

$table->addRow(
                $no, 
                $pengguna[$a]['nama_lengkap'], 
                $pengguna[$a]['email'],
                $pass,
                '<a href="'.site_url('admin/ambil_alih/'.$pengguna[$a]['id_pengguna']).'")>AA</a>',
                '<a href="'.site_url('admin/reset/'.$pengguna[$a]['id_pengguna']).'")>R</a>'
);
$no++;
}

echo $table->generate();