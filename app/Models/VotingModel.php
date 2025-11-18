<?php namespace App\Models;

use CodeIgniter\Model;

class VotingModel extends Model {
    protected $table = 'voting';
    protected $primaryKey = 'id_voting';
    protected $useAutoIncrement = true;
    protected $allowedFields = [ 'kode_voting','variabel', 'nilai','keterangan' ];



}
