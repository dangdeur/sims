<?php namespace App\Models;

use CodeIgniter\Model;

class VotingTendikModel extends Model {
    protected $table = 'votingtendik';
    protected $primaryKey = 'id_voting';
    protected $useAutoIncrement = true;
    protected $allowedFields = [ 'kode_voting','data_voting', 'waktu_voting','status' ];



}
