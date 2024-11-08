<?php namespace App\Models;

use CodeIgniter\Model;

class PresensiStafModel extends Model{
  protected $table = 'presensi_staf';
  protected $primaryKey = 'id_presensi_staf';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['kode_presensu_staf','kode_absen','datang','pulang'];
  
  

}
