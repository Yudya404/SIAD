<?php
header('Cache-Control: max-age=3600'); // Cache untuk 1 jam
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT');

function formatTanggalIndonesia($tanggal) {
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    // Ubah format tanggal ke format timestamp
    $timestamp = strtotime($tanggal);

    $tahun = date('Y', $timestamp);
    $bulanIndex = (int)date('m', $timestamp);
    $hari = date('d', $timestamp);
    $waktu = date('H:i:s', $timestamp); // Format waktu

    return $hari . ' ' . $bulan[$bulanIndex] . ' ' . $tahun . ' ' . $waktu;
}

function formatTanggal($tanggal) {
    $bulan = array(
        1 => 'Januari',
        2 => 'Februari',
        3 => 'Maret',
        4 => 'April',
        5 => 'Mei',
        6 => 'Juni',
        7 => 'Juli',
        8 => 'Agustus',
        9 => 'September',
        10 => 'Oktober',
        11 => 'November',
        12 => 'Desember'
    );

    // Ubah format tanggal ke format timestamp
    $timestamp = strtotime($tanggal);

    $tahun = date('Y', $timestamp);
    $bulanIndex = (int)date('m', $timestamp);
    $hari = date('d', $timestamp);

    return $hari . ' ' . $bulan[$bulanIndex] . ' ' . $tahun;
}

?>
<!doctype html>
<html>
<head>
	<meta http-equiv="Cache-Control" content="max-age=3600">
	<meta http-equiv="Expires" content="<?php echo gmdate('D, d M Y H:i:s', time() + 3600) . ' GMT'; ?>">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Petugas Gudang - SIAD</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/logo/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700,900" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" href="../assets/css/owl.theme.css">
    <link rel="stylesheet" href="../assets/css/owl.transitions.css">
    <link rel="stylesheet" href="../assets/css/animate.css">
    <link rel="stylesheet" href="../assets/css/normalize.css">
    <link rel="stylesheet" href="../assets/css/meanmenu.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">
    <link rel="stylesheet" href="../assets/css/educate-custon-icon.css">
    <link rel="stylesheet" href="../assets/css/morrisjs/morris.css">
    <link rel="stylesheet" href="../assets/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="../assets/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="../assets/css/metisMenu/metisMenu-vertical.css">
    <link rel="stylesheet" href="../assets/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="../assets/css/calendar/fullcalendar.print.min.css">
    <link rel="stylesheet" href="../assets/style.css">
    <link rel="stylesheet" href="../assets/css/responsive.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../assets/js/DataTables/datatables.css">

	<script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
	<!-- Dalam bagian head atau sebelum akhir body -->
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <?php 
    include '../koneksi.php';
    session_start();
	// Tentukan waktu timeout (dalam detik)
	$sessionTimeout = 180000; // 30 menit
	// Set waktu timeout pada sesi
	if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $sessionTimeout)) {
		// Sesuatu yang ingin Anda lakukan saat sesi kedaluwarsa
		session_unset();
		session_destroy();
		header("Location:../index.php"); // Redirect ke halaman login
	}
	$_SESSION['last_activity'] = time();
    if($_SESSION['status'] != "petugas_login"){
        header("location:../index.php?alert=belum_login");
    }
    ?>
	
	<style>
		.swal-button-container {
			text-align: center;
		}

		.swal-yes-button {
			background-color: #FF0000; /* Warna merah */
			color: white;
			border: none;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 5px;
		}

		.swal-no-button {
			background-color: #0000FF; /* Warna biru */
			color: white;
			border: none;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 5px;
		}
	</style>

</head>
<body>
    <div class="left-sidebar-pro">
        <nav id="sidebar" class="">
            <div class="sidebar-header">
				<a href="index.php">
					<img class="main-logo" src="../assets/img/logo/imigrasi.png" alt="" width="95" height="100" />
				</a>
				<strong>
					<a href="index.php">
						<img src="../assets/img/logo/imigrasi.png" alt="" width="150" height="150" />
					</a>
				</strong>
			</div>
            <div class="left-custom-menu-adp-wrap comment-scrollbar">
                <nav class="sidebar-nav left-sidebar-menu-pro" style="margin-top: 30px">
                    <ul class="metismenu" id="menu1">
                        <li class="active">
                            <a href="index.php">
                                <span class="educate-icon educate-home icon-wrap"></span>
                                <span class="mini-click-non">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="" aria-expanded="false">
								<span class="educate-icon educate-data-table icon-wrap sub-icon-mg" aria-hidden="true"></span><span class="mini-click-non">Arsip</span>
							</a>
							<ul class="submenu">
								<li>
									<a href="arsip.php" aria-expanded="false">
										<span class="educate-icon educate-data-table icon-wrap sub-icon-mg" aria-hidden="true"></span><span class="mini-click-non">Data Arsip</span>
									</a>
								</li>
								<li>
									<a href="pencarian.php" aria-expanded="false">
										<span class="educate-icon educate-search icon-wrap sub-icon-mg" aria-hidden="true"></span><span class="mini-click-non">Pencarian</span>
									</a>
								</li>
							</ul>
                        </li>
                        <li>
                            <a href="kategori.php" aria-expanded="false">
								<span class="educate-icon educate-course icon-wrap sub-icon-mg" aria-hidden="true"></span><span class="mini-click-non">Data Kategori</span>
							</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </nav>
    </div>
    
    <div class="all-content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                        <a href="index.html"><img class="main-logo" src="../assets/img/logo/logo.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-advance-area">
            <div class="header-top-area">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="header-top-wraper">
                                <div class="row">
                                    <div class="col-lg-1 col-md-0 col-sm-12 col-xs-12">
                                        <div class="menu-switcher-pro">
                                            <button type="button" id="sidebarCollapse" class="btn bar-button-pro header-drl-controller-btn btn-info navbar-btn">
                                                <i class="educate-icon educate-nav"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-6 col-sm-12 col-xs-12">
                                        <div class="header-top-menu tabl-d-n">
                                            <ul class="nav navbar-nav mai-top-nav">
                                                <li class="nav-item"><a>Lemari Arsip Kantor Imigrasi Kelas I Khusus TPI Juanda</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="header-right-info">
                                            <ul class="nav navbar-nav mai-top-nav header-right-menu">
												<li class="nav-item">
												<a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
													<?php 
														$id_petugas = $_SESSION['id'];
														$profil = mysqli_query($koneksi,"select * from petugas where petugas_id='$id_petugas'");
														$profil = mysqli_fetch_assoc($profil);
														if($profil['petugas_foto'] == ""){ 
													?>
													<img src="../gambar/sistem/user.png" style="width: 20px;height: 20px">
													<?php }else{ ?>
													<img src="../gambar/petugas/<?php echo $profil['petugas_foto'] ?>" style="width: 20px;height: 20px">
													<?php } ?>
													<span class="admin-name"><?php echo $_SESSION['nama']; ?> [ <b>Petugas</b> ]</span>
													<i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
												</a>
											<ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                                                <li><a href="profil.php"><span class="edu-icon edu-home-admin author-log-ic"></span><i class="fa fa-user"></i> ProfilKu</a></li>
                                                <li><a href="logout.php"><span class="edu-icon edu-locked author-log-ic"></span><i class="fa fa-sign-out"></i> Log Out</a></li>
											</ul>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Mobile Menu start -->
    <div class="mobile-menu-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                            <ul class="mobile-menu-nav">
                                <li class="active">
                                    <a href="index.php">
                                        <span class="educate-icon educate-home icon-wrap"></span>
                                        <span class="mini-click-non">Dashboard</span>
                                    </a>
                                </li>
                                <li>
									<a href="" aria-expanded="false">
										<span class="educate-icon educate-data-table icon-wrap sub-icon-mg" aria-hidden="true"></span><span class="mini-click-non">Arsip</span>
									</a>
									<ul class="submenu">
										<li>
											<a href="arsip.php" aria-expanded="false">
												<span class="educate-icon educate-data-table icon-wrap sub-icon-mg" aria-hidden="true"></span><span class="mini-click-non">Data Arsip</span>
											</a>
										</li>
										<li>
											<a href="pencarian.php" aria-expanded="false">
												<span class="educate-icon educate-search icon-wrap sub-icon-mg" aria-hidden="true"></span><span class="mini-click-non">Pencarian</span>
											</a>
										</li>
									</ul>
								</li>
                                <li>
                                    <a href="kategori.php" aria-expanded="false">
										<span class="educate-icon educate-event icon-wrap sub-icon-mg" aria-hidden="true"></span><span class="mini-click-non">Data Kategori</span>
									</a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>