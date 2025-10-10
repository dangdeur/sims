<?php namespace App\Models;

use CodeIgniter\Model;

class TupoksiModel extends Model{
  protected $table = 'tupoksi';
  protected $primaryKey = 'id_tupoksi';
  protected $useAutoIncrement = true;
  protected $allowedFields = [
    'kode_staf', 'bidang','tupoksi'];
   
 

  
}