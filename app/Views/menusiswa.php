<?php
// if (!isset($kode_pengguna)) {
// 	return redirect()->to('/login');
// } else {
?>


<!-- ============= COMPONENT ============== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
	<div class="container-fluid">

		<a class="navbar-brand" href="<?= site_url('profil') ?>">


			<img src="<?= base_url('gambar/siswa/' . $nis . '.JPG') ?>" alt="Logo" width="30" height="26"
				class="rounded-circle d-inline-block align-text-top">
			<?= $nama_siswa ?> </a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"
			aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

		<!-- end neo -->
		<div class="collapse navbar-collapse" id="main_nav">


			<ul class="navbar-nav">
				<li class="nav-item"><a class="nav-link" href="#"><?=$rombel?></a></li>
				<li class="nav-item dropdown">

					<!-- <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown" ?>

						Info
					</a>
					<ul class="dropdown-menu">
						
						<li><a class="dropdown-item" href="<?= site_url('profilsiswa') ?>"> Profil </a></li>
						
					</ul> -->

				</li>



				


			</ul>


			<ul class="navbar-nav ms-auto">
				<span class="navbar-text">Tahun Pelajaran <?= TAPEL ?>
					Semester <?= SEMESTER ?></span>


				
				<li class="nav-item"><a class="nav-link" href="<?= site_url('logoutsiswa') ?>">Keluar</a></li>



			</ul>

		</div> <!-- navbar-collapse.// -->
	</div> <!-- container-fluid.// -->
</nav>


<!-- <div class="container-xl mb-4">
	<p>Matching .container-xl...</p>
  </div> -->

<?php
// }
?>