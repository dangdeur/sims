<?php

namespace App\Controllers;
use Config\Services;
use App\Models\SiswaModel;




class Siswa extends Pbm
{
  //use ResponseTrait;
  protected $helpers = ['form','text','cookie','date','url','html'];
  protected $pbm;
  //protected $data;
  protected $session;

  public function sesi()
  {
    global $data;
    if (isset($_SESSION['kode_pengguna'])) {
      return $data = session()->get();
    } else {
      return redirect()->to('/logout');
    }
  }
  
  public function login()
  {
    $data = [];
        //baru
        if ( $this->request->is( 'post' ) ) {

            $rules = [
                'email' => 'required|min_length[6]|max_length[50]|valid_email',
                'password' => 'required|min_length[3]|max_length[255]|validateUser[email,password]',
            ];

            $errors = [
                'email' => [
                    'required' =>'Email belum diisi',
                    'min_length' => 'Email kurang dari 6 karakter',
                    'max_length' => 'Email lebih dari 50 karakter',
                    'valid_email' => 'format email tidak sesuai'
                ],
                'password' => [
                    'validateUser' => 'Email atau Password salah'
                ]
            ];

            if ( ! $this->validate( $rules, $errors ) ) {
                $data[ 'validation' ] = $this->validator;
                echo view( 'login' );

            } else {
                $model = new PenggunaModel();
                //$model->join('piket','piket.kode_petugas = pengguna.kode_pengguna','inner');
                $user = $model->where( 'email', $this->request->getVar( 'email' ) )->first();
                $user[ 'level' ] = $this->siapaLogin( $user, [ $user[ 'peran' ] ] );
                //$model->join('kodenya','pengguna.kode_pengguna = piket.kode_petugas');
                
                //apakah walas ?
                $walasmodel = new WalasModel();
                $walikelas = $walasmodel->where( 'kode_walas', $user[ 'kode_pengguna' ] ) ->first();
                if (!empty($walikelas['rombel']))
                {
                    $user['walas']=$walikelas['rombel'];
                }
                
                $piketmodel = new PiketModel();
                $piket = $piketmodel->where( 'kode_petugas', $user[ 'kode_pengguna' ] ) ->first();
                if (!empty($piket['hari']))
                {
                    $user['piket']=$piket;
                }

                $tutamodel = new TutaModel();
                $tuta = $tutamodel->where( 'kode_guru', $user[ 'kode_pengguna' ] ) ->first();
                if (!empty($tuta['bidang']))
                {
                    $user['tuta']=$tuta;
                }
                //d($user);
                $this->setUserSession( $user );

                //ingat
                if ( $this->request->getVar( 'ingat' ) === '1' ) {
                    $token = random_string( 'alnum', 16 );
                    set_cookie( 'skendava', $token, time() + ( 365 * 24 * 60 * 60 ) );
                    $user[ 'token' ] = $token;
                    //d( $user );
                    $data_update[ 'update' ][ 'token' ] = $token;
                    $data[ 'id' ] = $user[ 'id_pengguna' ];
                    $data[ 'update' ][ 'token' ] = $token;
                    $this->update( $data );

                }
                //d($user);
                if ($user['level']==='Superadmin')
                {
                    return redirect()->to( site_url('admin') )->withCookies();
                }
                else {
                    return redirect()->to( site_url('info'))->withCookies();
                }
                

            }
        }
        //end post login normal
        else {

            if ( get_cookie( 'skendava' ) ) {

                $token = get_cookie( 'skendava' );
                $model = new PenggunaModel();

                $user = $model->where( 'token', $token )->first();
                $walas=new WalasModel();
                $walikelas = $walas->where( 'kode_walas', $user[ 'kode_pengguna' ] ) ->first();
                if (!empty($walikelas['rombel']))
                {
                    $user['walas']=$walikelas['rombel'];
                }
                $user['loginnya']='dengan cookie';
                //   d( $user );
                //echo $model->getLastQuery();
                //d( $user );
                $user[ 'level' ] = $this->siapaLogin( $user, [ $user[ 'peran' ] ] );
                $this->setUserSession( $user );
                return redirect()->to( site_url('info') )->withCookies();

            } else {

                echo view( 'loginsiswa' );
            }
        }
        //end login cookies
  }

  

  // public function tampil_siswa($rombel=false)
  // {
         
  //   if ($rombel != '')
  //   {
  //     $siswa = new SiswaModel();
  //     $data['nama_siswa']=$siswa->where(['rombel'=>$rombel])->findAll();
      
  //   echo json_encode($data['nama_siswa']);
  //   }
  //   else {
  //     echo 'rombel ='.$rombel;
  //   }
  
  // }

  // public function simpan_tl($nis)
  // {
  //   $tl = new KeterlambatanModel();
  //   $data['keterlambatan'] = $tl->where(['nis'=>$nis])->first();
  //   $data['nis']=$nis;
  //   $data['catatan']=[];
    
    
  
  //   $tl->save($data);
  // }

  public function simpanpresensi()
  {
    $data = session()->get();
    $agenda= new AgendaGuruModel();
    $data['datapresensi']=$this->request->getPost();
    //dd($data);
    $absen=array();
    $no_urut=1;
    for ($a=1;$a<=$data['datapresensi']['jumlah_siswa'];$a++)
    {
      if (!empty($data['datapresensi']['absensi'.$a]))
      {
        if ($data['datapresensi']['absensi'.$a]=="TL")
        {
        $absen['TL'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="BL")
        {
        $absen['BL'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="D")
        {
        $absen['D'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="S")
        {
        $absen['S'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="I")
        {
        $absen['I'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }
        if ($data['datapresensi']['absensi'.$a]=="A")
        {
        $absen['A'][]=['nis'=>$this->request->getPost('nis'.$a),'nama'=>$this->request->getPost('nama_siswa'.$a),'catatan'=>$this->request->getPost('catatan'.$a)];
        }

      }
    }
    //$data['tess']=$presensi->getLastQuery();
    //dd($absen);
    $dataabsen=json_encode($absen);
    $data[ 'update' ][ 'absensi' ] = $dataabsen;
    //dd($data);
    $agenda->update( $data['datapresensi']['id_agendaguru'], $data[ 'update' ]);
    //$data['waktu']=$this->waktu();
    return redirect()->to('/agendaguru');
  }

  public function hapuspresensi($absensi,$nis,$id_agendaguru)
  {
    $data = session()->get();
    
    $agenda= new AgendaGuruModel();
    $data['agenda'] = $agenda->where(['id_agendaguru'=>$id_agendaguru])->first();

    $data_absensi=json_decode($data['agenda']['absensi'],true);
    $key=array_column($data_absensi[$absensi], $nis);
    //dd($data_absensi);
    for($h=0;$h<count($data_absensi[$absensi]);$h++)
    {
      if ($data_absensi[$absensi][$h]['nis']==$nis)
      {
        unset($data_absensi[$absensi][$h]);
      }
    }
    
    $this->update_absen($data_absensi,$id_agendaguru);
     return redirect()->to('/agendaguru');
  }

  //   function cari_nis($nis, $array) {
//     foreach ($array as $key => $val) {
//         if ($val['nis'] === $nis) {
//             return $key;
//         }
//     }
//     return null;
//  }

public function tambahpresensi($id_agendaguru)
  {
    $data = session()->get();
    $presensi = new SiswaModel();
    $agenda= new AgendaGuruModel();
    $data['agenda'] = $agenda->where(['id_agendaguru'=>$id_agendaguru])->first();
    $data['absen_lama']=json_decode($data['agenda']['absensi'],true);
    //d($data);
    $data['siswa'] = $presensi->where('rombel', $data['agenda']['rombel'])->findAll();
    
    //$data['tess']=$presensi->getLastQuery();
    //d($data);

    
    return view('header')
         .view('menu',$data)
         .view('updatepresensi')
         .view('footer');
  }

  public function update_absen($absen,$id)
  {
    $agenda= new AgendaGuruModel();
    if (!empty($absen))
    {
    $dataabsen=json_encode($absen);
    }
    else {
      $dataabsen='NULL';
    }
    $data[ 'update' ][ 'absensi' ] = $dataabsen;
    $agenda->update( $id, $data[ 'update' ]);
  }
  public function rombel_jadwal($jadwal)
  {
    $rombel=[];
    //d($jadwal);
    foreach($jadwal as $j)
    {
     foreach ($j as $hari => $rom)
     {
      if (!in_array($rom['kelas'],$rombel))
      {
        $rombel[$rom['kelas']]=$rom['kelas'];
      }
      }
    }
    return $rombel;
  }

  public function mapel_jadwal($jadwal)
  {
    $mapel=[];
    foreach($jadwal as $j)
    {
     foreach ($j as $hari => $rom)
     {
      if (!in_array($rom['mapel'],$mapel))
      {
        $mapel[$rom['mapel']]=$rom['mapel'];
      }
     }
    }
    return $mapel;
  }

  public function waktu()
  {
  return $waktu=date('l, j F Y, H:i');
  }

  public function absensi()
  {
    $data = session()->get();
    $data['agenda']=1;

    if ($this->request->is('post')) 
    {
      $rules = [
        'rombel_agenda' => 'required',
        'jp0' => 'required',
        'jp1' => 'required',
        'mapel_agenda' => 'required',
        'materi' => 'required'
      ];

      $errors = [
        'rombel_agenda' => ['required' =>'Rombel belum dipilih'],
        'jp0' => ['required' => 'Jam pelajaran awal belum dipilih'],
        'jp1' => ['required' => 'Jam pelajaran akhir belum dipilih'],
        'mapel_agenda' => ['required' => 'Mapel belum dipilih'],
        'materi' => ['required' => 'Materi belum dipilih']
      ];

      $data_ = $this->request->getPost(array_keys($rules));

        if (! $this->validateData($data_, $rules)) {
            return view('agendaguru',$data);
        }

        // If you want to get the validated data.
        $validData = $this->validator->getValidated();
        $data['valid']=$validData;
    } 

    return $data;

  }

      public function simpan()
    {
        $model = new AgendaGuruModel();
        $guru = $this->request->getPost('kode_guru');
        $rombel = $this->request->getPost('rombel_agenda');
        $tanggal=date("dmY");
        $kode_agenda=$guru."-".$tanggal."-".$rombel;
        $data = array(
            'rombel' => $rombel,
            'jp0' => $this->request->getPost('jp0'),
            'jp1' => $this->request->getPost('jp1'),
            'mapel' => $this->request->getPost('mapel_agenda'),
            'materi' => $this->request->getPost('materi'),
            'kode_agendaguru' => $kode_agenda,
            'kode_guru' => $guru,
        );
        //dd($data);
        $model->insert($data,false);
        return redirect()->to('/agendaguru');
    }

    

    public function hapus($id)
    {
      $data = session()->get();
      $model = new AgendaGuruModel();
      if ($this->request->is('post')) 
      {
      $id=$this->request->getPost('id');
      $model->delete($id);
      }
      else {
        $data['agenda'] = $model->where('id_agendaguru', $id)->first();
        $data['konfirmasi']=1;
        return view('header')
         .view('menu',$data)
         .view('daftaragenda')
        
         .view('footer');
      }
      return redirect()->to('/agendaguru');
    
       
        
    }

}
