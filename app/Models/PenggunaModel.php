<?php namespace App\Models;

use CodeIgniter\Model;

class PenggunaModel extends Model{
  protected $table = 'pengguna';
  protected $primaryKey = 'id_pengguna';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['nama_pengguna','kode_pengguna', 'password','nama_depan','nama_belakang','nama_lengkap','email','peran', 'updated_at','no_hp','kunci','updated_at','token'];
  protected $beforeInsert = ['beforeInsert'];
  protected $beforeUpdate = ['beforeUpdate'];




  protected function beforeInsert(array $data){
    $data = $this->passwordHash($data);
    $data['data']['updated_at'] = date('Y-m-d H:i:s');

    return $data;
  }

  protected function beforeUpdate(array $data){
    $data = $this->passwordHash($data);
    $data['data']['updated_at'] = date('Y-m-d H:i:s');
    return $data;
  }

  protected function passwordHash(array $data){
    if(isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

    return $data;
  }

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
