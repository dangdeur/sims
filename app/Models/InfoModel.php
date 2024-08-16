<?php namespace App\Models;

use CodeIgniter\Model;

class InfoModel extends Model {
    protected $table = 'info';
    protected $primaryKey = 'id_info';
    protected $useAutoIncrement = true;
    protected $allowedFields = [ 'tanggal', 'info', 'ditujukan', 'urgensi'];

    



}
