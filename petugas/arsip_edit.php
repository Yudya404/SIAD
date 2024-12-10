<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Edit Arsip</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="index.php">Home</a> <span class="bread-slash">/</span></li>
                                <li><a href="arsip.php">Arsip</a> <span class="bread-slash">/</span></li>
								<li><span class="bread-blod">Edit Data Arsip</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">


    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <div class="panel panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Edit Data Arsip</h3>
                </div>
                <div class="panel-body">
                <?php 
                    include '../koneksi.php';
                    $no = 1;
                    $id = $_GET['id'];
                    $arsip = mysqli_query($koneksi,"SELECT * FROM arsip WHERE arsip_id='$id'");
                    while($p = mysqli_fetch_array($arsip)){
						$kode_awal = $p['arsip_kode']; // Kode awal dengan 9 digit angka
						// Memisahkan kode menjadi bagian-bagian
						$bagian_kode = explode('-', $kode_awal);
						// Mengambil bagian terakhir (yang memiliki 9 digit angka)
						$angka_panjang = $bagian_kode[count($bagian_kode) - 1];
						// Mengambil 7 digit pertama dari angka_panjang
						$angka_pendek = substr($angka_panjang, -7);
						// Menggabungkan kembali semua bagian kode
						$kode_baru = implode('-', $bagian_kode);
						$kode_baru = str_replace($angka_panjang, $angka_pendek, $kode_baru);
                        ?>
                <form method="post" action="arsip_update.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kode Arsip</label>
                        <input type="hidden" name="id" value="<?php echo $p['arsip_id']; ?>">
						<input type="hidden" class="form-control" name="arsip_kode" required="required" value="<?php echo $p['arsip_kode']; ?>">
						<input type="text" class="form-control" name="arsip_kode" required="required" value="<?php echo $p['arsip_kode']; ?>" disabled>
                    </div>
                    <div class="form-group">
						<label>Nama Pemohon</label>
						<input type="text" class="form-control" name="nama_pemohon" required="required" value="<?php echo $p['nama_pemohon']; ?>">
					</div>
					<div class="form-group">
						<label>Nomor Pemohon</label>
						<input type="number" class="form-control" name="pemohon_nomor" required="required" value="<?php echo $p['pemohon_nomor']; ?>">
					</div>
					<div class="form-group"> 
						<label for="selectKota">Kategori</label> 
						<select id="selectKota" class="form-control" name="arsip_kategori" style="width: 300px;"> 
						<?php
						// Ambil data kategori dari database
							$query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
							while ($kategori = mysqli_fetch_assoc($query_kategori)) {
							$selected = ($kategori['kategori_id'] == $p['arsip_kategori']) ? 'selected' : '';
							echo '<option value="' . $kategori['kategori_id'] . '" ' . $selected . '>' . $kategori['kategori_nama'] . '</option>';
						}
						?>
						</select> 
					</div>
                    <div class="form-group">
						<button type="submit" class="btn btn-danger"> Simpan</button>
						<div class="pull-right">
							<a href="arsip.php" class="btn btn-primary"> Kembali</a>
						</div>
					</div>
                </form>
                <?php 
                    }
                ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>