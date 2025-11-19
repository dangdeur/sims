<?php namespace App\Models;

use CodeIgniter\Model;

class SiswaModel extends Model {
    protected $table = 'siswa';
    protected $primaryKey = 'id_siswa';
    protected $useAutoIncrement = true;
    protected $allowedFields = [ 'nis', 'nama_siswa', 'jk', 'rombel', 'kode_walikelas','password','catatan' ];

    //   public function __construct()
    // {
    //      $this->pbm = new Pbm();
    //      //$data = session()->get();

    //   }

    public function getSiswa() {
        $builder = $this->db->table( $table );
        return $builder->get();
    }

    public function getSiswaRombel( $rombel ) {
        $table = 'siswa';
        $builder = $this->db->table( $table );
        //$kelas = $builder->escape( $rombel );
        //return $builder->where( 'rombel', $rombel )->get()->fetchAssoc();
        return $builder->where( [ 'rombel', $rombel ] );
    }

    // public function getPresensi()
    // {
    //     $builder = $this->db->table( $tabel );
    //     $builder->select( '*' );
    //     $builder->join( 'category', 'category_id = product_category_id', 'left' );
    //     return $builder->get();
    // }

    // public function simpanAgenda( $data ) {
    //     $query = $this->db->table( $table )->insert( $data );
    //     return $query;
    // }

    // public function updateAgenda( $data, $id )
    // {
    //     $query = $this->db->table( $table )->update( $data, array( 'id_agendaguru' => $id ) );
    //     return $query;
    // }

    // public function hapusAgenda( $id )
    // {
    //     $query = $this->db->table( $table )->delete( array( 'id_agendaguru' => $id ) );
    //     return $query;
    // }

//      protected function beforeInsert(array $data){
//     $data = $this->passwordHash($data);
//     $data['data']['updated_at'] = date('Y-m-d H:i:s');

//     return $data;
//   }

//   protected function beforeUpdate(array $data){
//     $data = $this->passwordHash($data);
//     $data['data']['updated_at'] = date('Y-m-d H:i:s');
//     return $data;
//   }

  protected function passwordHash(array $data){
    if(isset($data['data']['password']))
      $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

    return $data;
  }

}
