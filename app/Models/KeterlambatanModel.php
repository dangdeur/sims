<?php namespace App\Models;

use CodeIgniter\Model;

class KeterlambatanModel extends Model {
    protected $table = 'keterlambatan';
    protected $primaryKey = 'id_keterlambatan';
    protected $useAutoIncrement = true;
    protected $allowedFields = [ 'nis', 'tl','penanganan' ];



}
