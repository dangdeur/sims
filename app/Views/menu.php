

  <!-- ============= COMPONENT ============== -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
   <div class="container-fluid">
   	 <a class="navbar-brand" href="#"><?= $nama_lengkap ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main_nav"  aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
    <div class="collapse navbar-collapse" id="main_nav">


  	<ul class="navbar-nav">
  		<li class="nav-item active"> <a class="nav-link" href="<?= site_url('info') ?>">Info </a> </li>
  		<li class="nav-item dropdown">
  			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  PBM  </a>
  		    <ul class="dropdown-menu">
  			  <li><a class="dropdown-item" href="<?= site_url('jadwal') ?>"> Jadwal </a></li>
          <li><a class="dropdown-item" href="<?= site_url('agendaguru') ?>"> Agenda Guru </a></li>
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

		<!-- walikelas -->
		<?php
		//dd($walas);
		if (isset($walas))
		{
		?>
		<li class="nav-item dropdown">
  			<a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">  Walikelas  </a>
  		    <ul class="dropdown-menu">
  			  <li><a class="dropdown-item" href="<?= site_url('siswawalas') ?>"> Data Siswa </a></li>
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

        <!-- <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Presensi</a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="<?= site_url('pbm/jadwal') ?>"> Jadwal </a></li>
              <li><a class="dropdown-item" href="<?= site_url('pbm/jadwal') ?>"> Agenda Kelas </a></li>
            </ul>
        </li> -->


  	</ul>
	  
  	<ul class="navbar-nav ms-auto">
	  <li class="nav-item"><a class="navbar-brand" href="#"><?= $level ?></a></li>
  		<li class="nav-item"><a class="nav-link" href="<?= site_url('logout') ?>">Keluar</a></li>
  		<!-- <li class="nav-item"><a class="nav-link" href="#"> Menu item </a></li>
  		<li class="nav-item dropdown">
  			<a class="nav-link  dropdown-toggle" href="#" data-bs-toggle="dropdown"> Dropdown right </a>
  		    <ul class="dropdown-menu dropdown-menu-right">
  			  <li><a class="dropdown-item" href="#"> Dropdown item 1</a></li>
  			  <li><a class="dropdown-item" href="#"> Dropdown item 2 </a></li>
  			  <li><a class="dropdown-item" href="#"> Dropdown item 3 &raquo; </a>
  			  	 <ul class="submenu submenu-left dropdown-menu">
  				    <li><a class="dropdown-item" href="">Submenu item 1</a></li>
  				    <li><a class="dropdown-item" href="">Submenu item 2</a></li>
  				    <li><a class="dropdown-item" href="">Submenu item 3</a></li>
  				    <li><a class="dropdown-item" href="">Submenu item 4</a></li>
  				 </ul>
  			  </li>
  			  <li><a class="dropdown-item" href="#"> Dropdown item 4 </a></li>
  		    </ul>
  		</li> -->


  	</ul>
     
    </div> <!-- navbar-collapse.// -->
   </div> <!-- container-fluid.// -->
  </nav>


  <!-- <div class="container-xl mb-4">
    <p>Matching .container-xl...</p>
  </div> -->
