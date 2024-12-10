<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px"><i class="fa fa-user"></i> ProfilKu</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">ProfilKu</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2">
                <?php 
                $id = $_SESSION['id'];
                $saya = mysqli_query($koneksi,"select * from admin where admin_id='$id'");
                $s = mysqli_fetch_assoc($saya);
                ?>
                <div class="single-cards-item">
                    <div class="single-product-image">
                        <a href="#">
                            <img src="../assets/img/product/profile-bg.jpg" alt="">
                        </a>
                    </div>
                    <div class="single-product-text">
                        <?php 
							if($s['admin_foto'] == ""){
                        ?>
                            <img class="img-user" src="../gambar/sistem/user.png">
                        <?php
                        }else{
                        ?>
                            <img class="img-user" src="../gambar/admin/<?php echo $s['admin_foto']; ?>">
                        <?php
                        }
                        ?>
                        <h4><a class="cards-hd-dn" href="#"><?php echo $s['admin_nama']; ?></a></h4>
                        <h5>Admin</h5>
                        <p class="ctn-cards">Pengelolaan arsip jadi lebih mudah dengan sistem informasi arsip digital.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="panel">
                    <div class="panel-heading">
                    <h3 class="panel-title">ProfilKu</h3>
                </div>
                    <div class="panel-body">                        
                        <form action="profil_act.php" method="post" enctype="multipart/form-data">                           
                           <div class="form-group">
                                <label>NIP</label>
								<input type="hidden" name="id" value="<?php echo $s['admin_id']; ?>">
								<input type="hidden" class="form-control" name="nip" required="required" value="<?php echo $s['admin_nip'] ?>">
                                <input type="number" class="form-control" name="nip" required="required" value="<?php echo $s['admin_nip'] ?>" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" name="nama" required="required" value="<?php echo $s['admin_nama'] ?>">
                            </div>
							<div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" required="required" value="<?php echo $s['admin_email'] ?>">
                            </div>
							<div class="form-group">
                                <label>No, Telp</label>
                                <input type="number" class="form-control" name="notelp" required="required" value="<?php echo $s['admin_notelp'] ?>">
                            </div>
							<div class="form-group">
								<label>Alamat</label>
								<textarea class="form-control" name="alamat" required="required"><?php echo $s['admin_alamat']; ?></textarea>
							</div>
                            <div class="form-group">
                                <label>Foto</label>
                                <input type="file" name="foto">
                                <small>Maksimal ukuran file 5 Mb, Kosongkan jika tidak ingin mengubah foto.</small>
                            </div>
                            <div class="form-group pull-right">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
								<button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
			<div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Ganti Password</h3>
                </div>
                <div class="panel-body">
                    <form action="gantipassword_act.php" method="post">
						<div class="form-group">
							<label>NIP</label>
							<input type="hidden" name="id" value="<?php echo $s['admin_id']; ?>">
                            <input type="number" class="form-control" name="nip" required="required" value="<?php echo $s['admin_nip'] ?>">
                        </div>
                        <div class="form-group">
                            <label>Masukkan Password Baru</label>
                            <input type="password" class="form-control" placeholder="Masukkan Password Baru .." name="new_password" required="required" minlength="8" maxlength="12">
                        </div>
						<div class="form-group">
                            <label>Konfirmasi Password Baru</label>
                            <input type="password" class="form-control" placeholder="Konfirmasi Password Baru .." name="confirm_password" required="required" minlength="8" maxlength="12">
                        </div>
						<div class="form-group">
                            <label>Masukkan Password Lama</label>
                            <input type="password" class="form-control" placeholder="Masukkan Password Lama .." name="password" required="required" minlength="8" maxlength="12">
                        </div>
                        <div class="form-group pull-right">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
							<button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>