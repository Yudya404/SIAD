<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px"><i class="fa fa-book"></i> Data Arsip</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="index.php">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Arsip</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="panel panel">
        <div class="panel-heading">
            <h3 class="panel-title">Data Lemari Arsip</h3>
        </div>
        <div class="panel-body">
            <div class="pull-right">
				<a href="arsip_upload.php" class="btn btn-primary"><i class="fa fa-upload"></i> Upload Data Arsip</a>			
            </div>
            <br>
            <br>
			<br>
            <table id="tableDasboard" class="table table-bordered table-striped table-hover table-datatable_dasboard">
                <thead>
                    <tr>
                        <th width="1%">No</th>
						<th width="30%">Arsip</th>
                        <th>Nomor Pemohon</th>
						<th>Waktu Pengarsipan</th>
                        <th class="text-center" width="20%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no = 1;
                    $saya = $_SESSION['id'];
                    $arsip = mysqli_query($koneksi,"SELECT arsip.* FROM arsip ORDER BY arsip_id DESC");
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
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <b>Kode lokasi</b> : <?php echo $kode_baru ?><br>
                                <b>Nama Pemohon</b> : <?php echo $p['nama_pemohon'] ?><br>
                            </td>							
                            <td><?php echo $p['pemohon_nomor'] ?></td>						
                            <td><?php echo formatTanggalIndonesia($p['arsip_waktu_upload']) ?></td>
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="arsip_edit.php?id=<?php echo $p['arsip_id']; ?>" class="btn btn-primary"><i class="fa fa-edit"></i></a>
									<button type="button" class="btn btn-danger delete-button" data-id="<?php echo $p['arsip_id']; ?>"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                    <?php 
                    }
                    ?>
                </tbody>  
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>