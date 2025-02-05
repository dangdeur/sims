<!-- ============= COMPONENT ============== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container-fluid">
				
    		<a class="navbar-brand" href="<?= site_url('profil') ?>">
			
      		<img src="<?=base_url('gambar/staf/'.$kode_pengguna.'.JPG')?>" alt="Logo" width="30" height="26" class="rounded-circle d-inline-block align-text-top">
			  <?= $nama_lengkap ?> </a>
			  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
	  
		<!-- end neo -->
		<div class="collapse navbar-collapse" id="main_nav">


			<ul class="navbar-nav">
				<li class="nav-item dropdown"> 
				<!-- <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
    				99+
    				<span class="visually-hidden">unread messages</span>
  				</span> -->
				<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" ?>
				
				  Info 
				</a> 
					<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?= site_url('info') ?>"> Pengumuman </a></li>
					<li><a class="dropdown-item" href="<?= site_url('profil') ?>"> Profil </a></li>
					<li><a class="dropdown-item" href=""> Presensi &raquo;</a>
						<ul class="submenu dropdown-menu">
						  <li><a class="dropdown-item" href="<?= site_url('rekap_upacara') ?>">Upacara</a></li>
						  <li><a class="dropdown-item" href="<?= site_url('rekap_harian') ?>">Harian</a></li>
						</ul>
					</li>
</ul>
			
				</li>

				<?php
				if($level=='Guru')
				{
				?>
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> PBM </a>
					<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="<?= site_url('agendaguru/lapor') ?>"> Lapor </a></li>
						<li><a class="dropdown-item" href="<?= site_url('jadwal') ?>"> Jadwal </a></li>
						<li><a class="dropdown-item" href="<?= site_url('agendaguru') ?>"> Agenda Guru </a></li>
						<li><a class="dropdown-item" href=""> Rekap &raquo;</a>
				   <ul class="submenu dropdown-menu">
						  <li><a class="dropdown-item" href="<?= site_url('agendaguru/tatapmuka') ?>">Tatap Muka</a></li>
						  <!-- <li><a class="dropdown-item" href="<?= site_url('agendaguru/baru_telat') ?>">Agenda PBM Terlewat</a></li> -->
					</ul>
				</li>

					</ul>
				</li>
				<?php
				}
				?>
				<!-- walikelas -->
				<?php
				//dd($walas);
				if (isset($walas)) {
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Walikelas </a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="<?= site_url('siswa') ?>"> Data Siswa </a></li>
							<li><a class="dropdown-item" href="<?= site_url('tuta') ?>">Lapor Aktifitas </a></li>
							<!-- <li><a class="dropdown-item" href="<?= site_url('agendaguru') ?>"> Agenda Guru </a></li> -->
							<!-- <li><a class="dropdown-item" href="#"> Dropdown item 2 &raquo; </a>
					 <ul class="submenu dropdown-menu">
					  <li><a class="dropdown-item" href="#">Submenu item 1</a></li>
					  <li><a class="dropdown-item" href="#">Submenu item 2</a></li>
					  <li><a class="dropdown-item" href="#">Submenu item 3 &raquo; </a>
						  <ul class="submenu dropdown-menu">
							  <li><a class="dropdown-item" href="#">Multi level 1</a></li>
							  <li><a class="dropdown-item" href="#">Multi level 2</a></li>
						  </ul>
					  </li>
					  <li><a class="dropdown-item" href="#">Submenu item 4</a></li>
					  <li><a class="dropdown-item" href="#">Submenu item 5</a></li>
				   </ul>
				</li> -->
						</ul>
					</li>
					<?php
				}
				?>

<?php
				//dd($walas);
				if (isset($tuta)) {
					
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> <?= $tuta['bidang'] ?></a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="<?= site_url('tuta') ?>">Lapor Aktifitas </a></li>
							
						</ul>
					</li>
					<?php
				}
				?>

				<?php
				//dd($walas);
				if (isset($piket)) {
					?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Piket </a>
						<ul class="dropdown-menu">
							<li><a class="dropdown-item" href="<?= site_url('tuta') ?>">Agenda Piket </a></li>
							<li><a class="dropdown-item disabled" href="<?= site_url('piket') ?>">Lapor Aktifitas</a></li>
							
							<li><a class="dropdown-item" href=""> Keterlambatan Siswa &raquo;</a>
								<ul class="submenu dropdown-menu">
									<li><a class="dropdown-item disabled" href="<?= site_url('form_terlambat') ?>" >Input
											Keterlambatan</a></li>
									<!-- <li><a class="dropdown-item" href="#">Submenu item 2</a></li>
					  <li><a class="dropdown-item" href="#">Submenu item 3 &raquo; </a>
						  <ul class="submenu dropdown-menu">
							  <li><a class="dropdown-item" href="#">Multi level 1</a></li>
							  <li><a class="dropdown-item" href="#">Multi level 2</a></li>
						  </ul>
					  </li>
					  <li><a class="dropdown-item" href="#">Submenu item 4</a></li>
					  <li><a class="dropdown-item" href="#">Submenu item 5</a></li> -->
								</ul>
							</li>
						</ul>
					</li>
					<?php
				}
				?>

				<!-- ekinerja -->
				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> eKinerja </a>
					<ul class="dropdown-menu">
					<?php
					if($level=='Guru')
				{
				?>
						<li><a class="dropdown-item" href="<?= site_url('cetakagenda') ?>" target="_blank"> Cetak Agenda
								Harian PBM </a></li>
								<?php
				}
				?>
						<li><a class="dropdown-item" href="<?= site_url('cetakagendatuta') ?>" target="_blank"> Cetak Agenda Tugas Tambahan </a></li>
						<!-- <li><a class="dropdown-item" href="#"> Dropdown item 2 &raquo; </a>
					 <ul class="submenu dropdown-menu">
					  <li><a class="dropdown-item" href="#">Submenu item 1</a></li>
					  <li><a class="dropdown-item" href="#">Submenu item 2</a></li>
					  <li><a class="dropdown-item" href="#">Submenu item 3 &raquo; </a>
						  <ul class="submenu dropdown-menu">
							  <li><a class="dropdown-item" href="#">Multi level 1</a></li>
							  <li><a class="dropdown-item" href="#">Multi level 2</a></li>
						  </ul>
					  </li>
					  <li><a class="dropdown-item" href="#">Submenu item 4</a></li>
					  <li><a class="dropdown-item" href="#">Submenu item 5</a></li>
				   </ul>
				</li> -->
					</ul>
				</li>


				<!--  -->

				<!-- <li class="nav-item dropdown">
		  <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Presensi</a>
			<ul class="dropdown-menu">
			  <li><a class="dropdown-item" href="<?= site_url('pbm/jadwal') ?>"> Jadwal </a></li>
			  <li><a class="dropdown-item" href="<?= site_url('pbm/jadwal') ?>"> Agenda Kelas </a></li>
			</ul>
		</li> -->


			</ul>
			
			
			<ul class="navbar-nav ms-auto">
			<span class="navbar-text">Tahun Pelajaran <?= TAPEL ?>
			Semester <?= SEMESTER ?></span>
			
			
			<li class="nav-item"><a class="nav-link" href="#"><?= $level ?></a></li>
				<li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>">Keluar</a></li>
				


			</ul>

		</div> <!-- navbar-collapse.// -->
	</div> <!-- container-fluid.// -->
</nav>


<!-- <div class="container-xl mb-4">
	<p>Matching .container-xl...</p>
  </div> -->