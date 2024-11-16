<?php namespace App\Models;

use CodeIgniter\Model;

class PresensiStafModel extends Model{
  protected $table = 'presensi_staf';
  protected $primaryKey = 'id_presensi_staf';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['kode_presensi_staf','kode_absen','tanggal','datang','pulang','rekap'];


public function data_presensi($kode)
{
    $data_db = $this->where('kode_presensi_staf',$kode)->countAllResults();
    return ($data_db > 0);
} 
  

}
