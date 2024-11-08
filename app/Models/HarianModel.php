<?php namespace App\Models;

use CodeIgniter\Model;

class HarianModel extends Model{
  protected $table = 'fp_harian';
  protected $primaryKey = 'id_fp_harian';
  protected $useAutoIncrement = true;
  protected $allowedFields = ['kode_absen','waktu','verifikasi','status'];
  
  

}
