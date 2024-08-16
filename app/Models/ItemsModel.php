<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemsModel extends Model
{
  protected $table = 'items';
  protected $useSoftDeletes = true;
  protected $allowedFields = ['name', 'price', 'category', 'detail', 'created_at', 'updated_at', 'deleted_at'];
  protected $useTimestamps = true;
}


?>