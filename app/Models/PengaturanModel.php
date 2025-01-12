<?php namespace App\Models;

use CodeIgniter\Model;

class PengaturanModel extends Model{
  protected $table = 'pengaturan';
  protected $primaryKey = 'id_pengaturan';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['nama_pengguna','kode_pengguna', 'password','nama_depan','nama_belakang','nama_lengkap','email','peran', 'updated_at','no_hp','kunci','updated_at','token'];
 




 
  public function nama($peran)
  {
    //OK
    $data_nama = $this->select('nama_lengkap')->where($peran)->orderBy('nama_lengkap')->findAll();

    // $builder = $this->table('pengguna');
    // $builder->select('nama_lengkap');
    // $builder->where($peran);
    // $query=$builder->get();
    // $data_nama=array();
    // foreach ($query->getResultArray() as $nama)
    // {
    //   $data_nama[]=$nama;
    // }
    return $data_nama;
  }

  


}
