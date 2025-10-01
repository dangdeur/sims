<?php

namespace App\Controllers;

// use App\Models\UserModel;
use App\Models\AgendaGuruModel;
use App\Models\AgendaTutaModel;
use App\Models\StafModel;
use CodeIgniter\I18n\Time;
use TCPDF;
use SimpleSoftwareIO\QrCode\Generator;


class Cetak extends Pbm
{
	protected $helpers = ['form'];

	public function __construct()
	{
		$this->pbm = new Pbm();
	}


	public function agenda()
	{
		$data = session()->get();
		if ($this->request->is('post')) {
			$stafmodel = new StafModel;
			$bulan = $this->request->getVar('bulan');
			$tahun = $this->request->getVar('tahun');
			$data['staf'] = $stafmodel->where('kode_staf', $data['kode_pengguna'])->first();
			$data['bulan'] = BULAN[$this->request->getVar('bulan')] . ' ' . $tahun;
			$data['kodebulan'] = $this->request->getVar('bulan');
			$data['tahun'] = $this->request->getVar('tahun');
			$data['tanggal'] = $this->tglBulan($tahun, $bulan);

			//jika dispensasi ekin
			if (in_array($bulan . $tahun, DISPENSASI_EKIN)) {
				$data['dispensasi'] = true;

				/*
				*	Kode hari
				*	     	=> rombel
				*                     => jp0,mapel,jp1
				*/
				$jadwal = $this->pbm->jadwal_ekin();
				//$data['jadwal'] = $jadwal;

				if (isset($data['tanggal'][1])) {
					foreach ($data['tanggal'][1] as $tanggal) {
						if(isset($jadwal[1])) {
						foreach ($jadwal[1] as $rombel => $datanya) {
							$data_agenda[] = [
								'tanggal' => $tanggal . '-' . $bulan . '-' . $tahun,
								'uraian' => 'Mengajar mapel ' . $datanya['mapel'] . ' di ' . $rombel . ' jam ' . $datanya['jp0'] . '-' . $datanya['jp1'],
								'urutan' =>$tanggal
							];
						}
					}
					}
				}

				if (isset($data['tanggal'][2])) {
					foreach ($data['tanggal'][2] as $tanggal) {
						if(isset($jadwal[2])) {
						foreach ($jadwal[2] as $rombel => $datanya) {
							$data_agenda[] = [
								'tanggal' => $tanggal . '-' . $bulan . '-' . $tahun,
								'uraian' => 'Mengajar mapel ' . $datanya['mapel'] . ' di ' . $rombel . ' jam ' . $datanya['jp0'] . '-' . $datanya['jp1'],
								'urutan' =>$tanggal
							];
						}
					}
				}
				}

				if (isset($data['tanggal']['3'])) {
					foreach ($data['tanggal']['3'] as $tanggal) {
						if(isset($jadwal[3])) {
						foreach ($jadwal['3'] as $rombel => $datanya) {
							$data_agenda[] = [
								'tanggal' => $tanggal . '-' . $bulan . '-' . $tahun,
								'uraian' => 'Mengajar mapel ' . $datanya['mapel'] . ' di ' . $rombel . ' jam ' . $datanya['jp0'] . '-' . $datanya['jp1'],
								'urutan' =>$tanggal
							];
						}
					}
					}
				}

				if (isset($data['tanggal'][4])) {
					foreach ($data['tanggal'][4] as $tanggal) {
						if(isset($jadwal[4])) {
						foreach ($jadwal[4] as $rombel => $datanya) {
							$data_agenda[] = [
								'tanggal' => $tanggal . '-' . $bulan . '-' . $tahun,
								'uraian' => 'Mengajar mapel ' . $datanya['mapel'] . ' di ' . $rombel . ' jam ' . $datanya['jp0'] . '-' . $datanya['jp1'],
								'urutan' =>$tanggal
							];
						}
					}
					}
				}

				if (isset($data['tanggal'][5])) {
					foreach ($data['tanggal'][5] as $tanggal) {
						if(isset($jadwal[5])) {
						foreach ($jadwal[5] as $rombel => $datanya) {
							$data_agenda[] = [
								'tanggal' => $tanggal . '-' . $bulan . '-' . $tahun,
								'uraian' => 'Mengajar mapel ' . $datanya['mapel'] . ' di ' . $rombel . ' jam ' . $datanya['jp0'] . '-' . $datanya['jp1'],
								'urutan' =>$tanggal
							];
						}
					}
					}
				}


				//d($dataagenda);

				usort($data_agenda, function ($a, $b) {
					return $a['urutan'] <=> $b['urutan']; // Sort by age in ascending order
				});

				//$data_agenda=asort($data_agenda);

				$data['agenda'] = $data_agenda;
				//d($data);
			} else {



				$agendamodel = new AgendaGuruModel;

				$agendamodel->where('kode_guru', $data['kode_pengguna']);
				$agendamodel->like('kode_agendaguru', $bulan . $tahun);
				$data['agenda'] = $agendamodel->findAll();
				$data['qr'] = $this->qr();
			}
			//dd($data);
			$html = view('cetakagendattd', $data);
			//dd($data);
			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setCreator(PDF_CREATOR);
			$pdf->setAuthor('Endang Suhendar');
			//$pdf->setTitle('Agenda Harian Mengajar');
			$pdf->setSubject('SMKN 2 Pandeglang');
			// $pdf->setKeywords('TCPDF, PDF, example, test, guide');
			$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
			// set header and footer fonts
			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
			// set default monospaced font
			$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			// set margins
			$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
			$pdf->setFooterMargin(PDF_MARGIN_FOOTER);
			// set auto page breaks
			//get the current page break margin:
			//$bMargin = $pdf->getBreakMargin();   
			//$bMargin = 55;
			//get current auto-page-break mode:
			//$auto_page_break = $pdf->getAutoPageBreak();

			//enable auto page break:
			//$pdf->SetAutoPageBreak($auto_page_break, $bMargin);
			$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			// set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			// set some language-dependent strings (optional)
			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			$pdf->setFont('dejavusans', '', 10);
			$pdf->AddPage();



			// echo $html;
			// exit();
			$pdf->writeHTML($html, true, false, true, false, '');
			ob_end_clean();
			$this->response->setContentType('application/pdf');
			$pdf->Output('Agenda Mengajar ' . $data['nama_lengkap'] . ' ' . $bulan . '-' . $tahun . '.pdf', 'D');
		} else {
			return view('header')
				. view('menu', $data)
				. view('form_cetakagenda')
				//  .view('paginasi')
				. view('footer');
		}
	}

	public function agenda_tuta()
	{
		$data = session()->get();
		if ($this->request->is('post')) {
			$stafmodel = new StafModel;
			$bulan = $this->request->getVar('bulan');
			$tahun = $this->request->getVar('tahun');
			$data['staf'] = $stafmodel->where('kode_staf', $data['kode_pengguna'])->first();
			$agendamodel = new AgendaTutaModel;

			$agendamodel->where('kode_staf', $data['kode_pengguna']);
			$agendamodel->like('kode_agendatuta', $bulan . date("Y"));
			$data['agenda'] = $agendamodel->findAll();
			$data['qr'] = $this->qr();
			$data['bulan'] = BULAN[$this->request->getVar('bulan')] . ' ' . date("o");


			//d($data);
			$html = view('cetakagendatuta', $data);

			$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf->setCreator(PDF_CREATOR);
			$pdf->setAuthor('Endang Suhendar');
			$pdf->setTitle('Agenda Tugas Tambahan');
			$pdf->setSubject('SMKN 2 Pandeglang');
			// $pdf->setKeywords('TCPDF, PDF, example, test, guide');
			$pdf->setHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
			// set header and footer fonts
			$pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
			$pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
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
			if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
				require_once(dirname(__FILE__) . '/lang/eng.php');
				$pdf->setLanguageArray($l);
			}
			$pdf->setFont('dejavusans', '', 10);
			$pdf->AddPage();



			$pdf->writeHTML($html, true, false, true, false, '');
			$this->response->setContentType('application/pdf');
			$pdf->Output('Agenda Tugas Tambahan ' . $data['nama_lengkap'] . ' ' . $bulan . '-' . $tahun . '.pdf', 'D');
		} else {
			return view('header')
				. view('menu', $data)
				. view('form_cetaktuta')
				//  .view('paginasi')
				. view('footer');
		}
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
