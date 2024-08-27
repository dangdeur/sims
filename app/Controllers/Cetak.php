<?php namespace App\Controllers;

// use App\Models\UserModel;
use App\Models\AgendaGuruModel;
use App\Models\AgendaTutaModel;
use App\Models\StafModel;
use CodeIgniter\I18n\Time;
use TCPDF;
use SimpleSoftwareIO\QrCode\Generator;


class Cetak extends BaseController
{
	protected $helpers = ['form'];

	public function agenda()
	{
		$data = session()->get();
		if ($this->request->is('post')) 
      {
		$stafmodel = new StafModel;
		$bulan=$this->request->getVar('bulan').date("o");
		$data['staf']=$stafmodel->where('kode_staf', $data['kode_pengguna'])->first();
		 $agendamodel=new AgendaGuruModel;
		 //OK
		 //$data['agenda'] = $agendamodel->where('kode_guru', $data['kode_pengguna'])->findAll();

		 //coba
		 $agendamodel->where('kode_guru', $data['kode_pengguna']);
		 $agendamodel->like('kode_agendaguru',$bulan);
		 $data['agenda'] =$agendamodel->findAll();
		 $data['qr']=$this->qr();
		 $data['bulan']=BULAN[$this->request->getVar('bulan')].' '.date("o");


		//d($data);
		$html=view('cetakagendattd',$data);
dd($data);
		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setCreator(PDF_CREATOR);
		$pdf->setAuthor('Endang Suhendar');
		$pdf->setTitle('Agenda Harian Mengajar');
		$pdf->setSubject('SMKN 2 Pandeglang');
		// $pdf->setKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		$pdf->setFont('dejavusans', '', 10);
		$pdf->AddPage();



		$pdf->writeHTML($html, true, false, true, false, '');
		$this->response->setContentType('application/pdf');
		$pdf->Output('Agenda Mengajar'.$data['nama_lengkap'].'.pdf', 'I');
	}
	else {
		return view('header')
         .view('menu',$data)
         .view('form_cetakagenda')
        //  .view('paginasi')
         .view('footer');
	}
	}

	public function agenda_tuta()
	{
		$data = session()->get();
		if ($this->request->is('post')) 
      {
		$stafmodel = new StafModel;
		$bulan=$this->request->getVar('bulan').date("o");
		$data['staf']=$stafmodel->where('kode_staf', $data['kode_pengguna'])->first();
		 $agendamodel=new AgendaTutaModel;
		
		 $agendamodel->where('kode_staf', $data['kode_pengguna']);
		 $agendamodel->like('kode_agendatuta',$bulan);
		 $data['agenda'] =$agendamodel->findAll();
		 $data['qr']=$this->qr();
		 $data['bulan']=BULAN[$this->request->getVar('bulan')].' '.date("o");


		//d($data);
		$html=view('cetakagendatuta',$data);

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setCreator(PDF_CREATOR);
		$pdf->setAuthor('Endang Suhendar');
		$pdf->setTitle('Agenda Tugas Tambahan');
		$pdf->setSubject('SMKN 2 Pandeglang');
		// $pdf->setKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		$pdf->setFont('dejavusans', '', 10);
		$pdf->AddPage();



		$pdf->writeHTML($html, true, false, true, false, '');
		$this->response->setContentType('application/pdf');
		$pdf->Output('Agenda Tugas Tambahan'.$data['nama_lengkap'].'.pdf', 'I');
	}
	else {
		return view('header')
         .view('menu',$data)
         .view('form_cetaktuta')
        //  .view('paginasi')
         .view('footer');
	}
	}

	public function kelulusan($no)
	{

		$db=new PersonalModel;
		$data=$this->session->get();

		$no="'".$no."'";

		$query = $db->query('SELECT * FROM pendaftar
											JOIN nilai ON nilai.no_pendaftaran = pendaftar.no_pendaftaran
											JOIN pendaftaran ON pendaftaran.no_pendaftaran = nilai.no_pendaftaran
											JOIN kelulusan ON pendaftaran.no_pendaftaran = kelulusan.no_pendaftaran
											WHERE pendaftar.no_pendaftaran='.$no);

		if (is_array($query->getRow()) || is_object($query->getRow()))
		{
			foreach ($query->getRow() as $key => $value) {
				$data[$key]=$value;
			}
		}
		else {
			 echo "Data Tidak Ada";
		}

		$data=array_merge($data,$this->progress($data['verifikasi']));

		$html=view('cetakkelulusan',$data);

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setCreator(PDF_CREATOR);
		$pdf->setAuthor('Endang Suhendar');
		$pdf->setTitle('Bukti Kelulusan PPDB');
		$pdf->setSubject('PPDB SMKN 2 Pandeglang');
		// $pdf->setKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		$pdf->setFont('dejavusans', '', 10);
		$pdf->AddPage();



		$pdf->writeHTML($html, true, false, true, false, '');
		$this->response->setContentType('application/pdf');
		$pdf->Output('Bukti Kelulusan PPDB'.$data['no_pendaftaran'].'.pdf', 'I');
	}


	public function kartu($no)
	{
		$db=new PersonalModel;
		$data=$this->session->get();

		$no="'".$no."'";

		$query = $db->query('SELECT * FROM pendaftar
											JOIN nilai ON nilai.no_pendaftaran = pendaftar.no_pendaftaran
											JOIN pendaftaran ON pendaftaran.no_pendaftaran = nilai.no_pendaftaran
											WHERE pendaftar.no_pendaftaran='.$no);

		if (is_array($query->getRow()) || is_object($query->getRow()))
		{
			foreach ($query->getRow() as $key => $value) {
				$data[$key]=$value;
			}
		}
		else {
			 echo "Data Tidak Ada";
		}

		$html=view('cetakkartu',$data);

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
		$pdf->setCreator(PDF_CREATOR);
		$pdf->setAuthor('Endang Suhendar');
		$pdf->setTitle('Agenda Harian Mengajar');
		$pdf->setSubject('SMKN 2 Pandeglang');
		// $pdf->setKeywords('TCPDF, PDF, example, test, guide');
		$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
		// set header and footer fonts
		$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
		$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
		// set default monospaced font
		$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
		// set margins
		$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
		$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
		$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
		// set auto page breaks
		$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
		// set image scale factor
		$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
		// set some language-dependent strings (optional)
		if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
			require_once(dirname(__FILE__).'/lang/eng.php');
			$pdf->setLanguageArray($l);
		}
		$pdf->setFont('dejavusans', '', 10);
		$pdf->AddPage();


		$pdf->writeHTML($html, true, false, true, false, '');
		$this->response->setContentType('application/pdf');
		$pdf->Output('Agenda Mengajar'.$data['no_pendaftaran'].'.pdf', 'I');
	}


	public function progress($verifikasi)
	{

		helper('date');
		$ver=json_decode($verifikasi);
		//print_r($ver);
		$data['petugas']=$ver->petugas;
		// $waktu_= new DateTime($jadwal_verifikasi);
		// $waktu_->add(new DateInterval('PT12H'));
		// $waktu=$waktu_->format("d-m-Y H:m:s");

		 $waktu=Time::parse($ver->waktu,'Asia/Jakarta');
		 $waktu_verifikasi=$waktu->addHours(12);
		 $tgl = explode(" ",$waktu_verifikasi);
		 $tanggal_=explode("-",$tgl[0]);
		 $tanggal=$tanggal_[2]."-".$tanggal_[1]."-".$tanggal_[0];

		$data['waktu']=$tgl[1];
		$data['tanggal']=$tanggal;
		//$data['waktu']=$waktu_->toLocalizedString('d-m-yyyy HH:mm:s');
		return $data;

	}

	public function qr()
    {
        $qrcode = new Generator;
        $qrCodes = [];
        // $qrCodes['simple'] = $qrcode->size(120)->generate('https://www.binaryboxtuts.com/');
        // $qrCodes['changeColor'] = $qrcode->size(120)->color(255, 0, 0)->generate('https://www.binaryboxtuts.com/');
        // $qrCodes['changeBgColor'] = $qrcode->size(120)->color(0, 0, 0)->backgroundColor(255, 0, 0)->generate('https://www.binaryboxtuts.com/');
          
        // $qrCodes['styleDot'] = $qrcode->size(120)->color(0, 0, 0)->backgroundColor(255, 255, 255)->style('dot')->generate('https://www.binaryboxtuts.com/');
        // $qrCodes['styleSquare'] = $qrcode->size(120)->color(0, 0, 0)->backgroundColor(255, 255, 255)->style('square')->generate('https://www.binaryboxtuts.com/');
        // $qrCodes['styleRound'] = $qrcode->size(120)->color(0, 0, 0)->backgroundColor(255, 255, 255)->style('round')->generate('https://www.binaryboxtuts.com/');
      
        return $qrCodes['qrnya'] = $qrcode->size(100)->format('png')->merge('gambar/logo.png', .4)->generate('http://sims.smkn2pandeglang.sch.id/');
            //return view('qr-codes', $qrCodes);
    }





}
