<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>MASUK | SIAD</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" href="assets/css/owl.theme.css">
    <link rel="stylesheet" href="assets/css/owl.transitions.css">
    <link rel="stylesheet" href="assets/css/animate.css">
    <link rel="stylesheet" href="assets/css/normalize.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/morrisjs/morris.css">
    <link rel="stylesheet" href="assets/css/scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" href="assets/css/metisMenu/metisMenu.min.css">
    <link rel="stylesheet" href="assets/css/metisMenu/metisMenu-vertical.css">
    <link rel="stylesheet" href="assets/css/calendar/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/css/calendar/fullcalendar.print.min.css">
    <link rel="stylesheet" href="assets/css/form/all-type-forms.css">
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
	
<style>
	.error-pagewrap {
		background-image: url('gambar/sistem/2.jpg');
		background-size: 100% 100%; /* 50% dari lebar dan 70% dari tinggi elemen */
		background-repeat: no-repeat; /* Untuk menghindari pengulangan gambar */
	}
</style>
	
</head>
<body>
    <div class="error-pagewrap">
        <div class="error-page-int">
            <div class="text-center m-b-md custom-login">
                <h3>SIAD</h4>
				<h4><p><b>KANTOR IMIGRASI KELAS I KHUSUS TPI JUANDA</b></p><h4>
            </div>
            <div class="content-error">
                <?php 
				// pesan notifikasi
				if(isset($_GET['alert'])){
					if($_GET['alert'] == "gagal"){
						echo "<div class='alert alert-danger'>LOGIN GAGAL! NIP DAN PASSWORD SALAH! Silahkan coba lagi.</div>";
					} elseif($_GET['alert'] == "logout"){
						echo "<div class='alert alert-success'>ANDA TELAH BERHASIL LOGOUT</div>";
					} elseif($_GET['alert'] == "belum_login"){
						echo "<div class='alert alert-warning'>ANDA HARUS LOGIN UNTUK MENGAKSES SIAD</div>";
					} elseif($_GET['alert'] == "nip_salah"){
						echo "<div class='alert alert-danger'>NIP SALAH! Silakan coba lagi.</div>";
					} elseif($_GET['alert'] == "password_salah"){
						echo "<div class='alert alert-danger'>PASSWORD SALAH! Silakan coba lagi.</div>";
					}
				}
				?>
                <div class="hpanel">
                    <div class="panel-body" style="background: linear-gradient(rgba(255, 255, 255, 0.5), rgba(255, 255, 255, 0.5)); background-size: cover; background-repeat: no-repeat; background-position: center;">
                        <center>
							<img src="gambar/depan/imigrasi2.png" alt="Logo" style="width: 95px; height: 100px;"> <!-- Ganti path dan ukuran logo sesuai kebutuhan -->
                            <h4><i class="fa fa-user"></i> LOGIN PETUGAS</h4>
							<p><b>Silahkan login untuk mengakses arsip.</b></p>
                        </center>
                        <form action="periksa_login.php" method="POST" id="loginForm">
                            <div class="form-group">
                                <label class="control-label" for="nip">NIP</label>
                                <input type="text" placeholder="Masukkan NIP Anda" required="required" autocomplete="off" name="nip" id="nip" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password">Sandi</label>
                                <input type="password" placeholder="Masukkan Password Anda" required="required" autocomplete="off" name="password" id="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="password"><i class="fa fa-user"></i> Hak Akses</label>
                                <select class="form-control" name="akses">
                                    <option value="petugas"><i class="fa fa-user"></i>Petugas Gudang</option>
									<option value="admin"><i class="fa fa-user"></i>Administrator</option>
                                </select>                             
                            </div> 
							<div class="form-group text-center">
								<button type="submit" class="btn btn-primary btn-block">Masuk</button>
							</div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center login-footer">
                <p><b>Copyright © <?php echo date('Y') ?>. SIAD. All rights reserved.</b></p>
            </div>
        </div>   
    </div>
    <script src="assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/jquery-price-slider.js"></script>
    <script src="assets/js/jquery.meanmenu.js"></script>
    <script src="assets/js/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.sticky.js"></script>
    <script src="assets/js/jquery.scrollUp.min.js"></script>
    <script src="assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="assets/js/scrollbar/mCustomScrollbar-active.js"></script>
    <script src="assets/js/metisMenu/metisMenu.min.js"></script>
    <script src="assets/js/metisMenu/metisMenu-active.js"></script>
    <script src="assets/js/tab.js"></script>
    <script src="assets/js/icheck/icheck.min.js"></script>
    <script src="assets/js/icheck/icheck-active.js"></script>
    <script src="assets/js/plugins.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>