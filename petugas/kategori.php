<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px"><i class="fa fa-folder-open"></i> Data Kategori Layanan</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="index.php">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Data Kategori Layanan</span></li>
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
            <h3 class="panel-title">Data kategori</h3>
        </div>
        <div class="panel-body">
			<div class="pull-right">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpload_<?php echo $p['kategori_id']; ?>"><i class="fa fa-plus"></i> Tambah Data Kategori</button>
				<!-- Kode Modal Cetak-->
				<div class="modal fade" id="modalUpload_<?php echo $p['kategori_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header text-center">
								<h4 class="modal-title" id="exampleModalLabel">Tambah Data Kategori</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="modalBody_<?php echo $p['kategori_id']; ?>">
								<!-- Konten yang ingin dicetak -->
								<div class="panel-body">
									<form method="post" action="kategori_aksi.php" enctype="multipart/form-data">
										<div class="form-group">
											<label>Nama Kategori</label>
											<input type="text" class="form-control" name="kategori_nama" required="required">
										</div>
										<div class="form-group">
											<label>Keterangan Kategori</label>
											<input type="text" class="form-control" name="kategori_keterangan" required="required">
										</div>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</form>
						</div>
					</div>
				</div>
				<!-- Kode Modal Cetak-->
            </div>
			<br>
			<br>
            <table id="tableDasboard" class="table table-bordered table-striped table-hover table-datatable_dasboard">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Nama</th>
                        <th>Katerangan</th>
						<th>OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
						$no = 1;
						$kategori = mysqli_query($koneksi,"SELECT * FROM kategori");
						while($p = mysqli_fetch_array($kategori)){
                    ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $p['kategori_nama'] ?></td>
                            <td><?php echo $p['kategori_keterangan'] ?></td>
							<td class="text-center">
								<div class="btn-group">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit_<?php echo $p['kategori_id']; ?>"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete_<?php echo $p['kategori_id']; ?>"><i class="fa fa-trash"></i></button>
                                </div>
								<!-- Kode Modal Delete-->
								<div class="modal fade" id="modalDelete_<?php echo $p['kategori_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header text-center">
												<h4 class="modal-title" id="exampleModalLabel">PERINGATAN!</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body">
												Apakah anda yakin ingin menghapus data ini? <br>file dan semua yang berhubungan akan dihapus secara permanen.
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
												<a href="kategori_hapus.php?id=<?php echo $p['kategori_id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp; Ya, hapus</a>
											</div>
										</div>
									</div>
								</div>
								<!-- Kode Modal Delete-->
							</td>
							<!-- Kode Modal Edit-->
							<div class="modal fade" id="modalEdit_<?php echo $p['kategori_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header text-center">
											<h4 class="modal-title" id="exampleModalLabel">Edit Data Kategori</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body" id="modalBody_<?php echo $p['kategori_id']; ?>">
											<!-- Konten yang ingin dicetak -->
											<div class="panel-body">
												<form method="POST" action="kategori_update.php" enctype="multipart/form-data" id="arsipForm">
													<div class="form-group">
														<label>Nama Kategori</label>
														<input type="hidden" name="id" value="<?php echo $p['kategori_id']; ?>">
														<input type="text" class="form-control" name="kategori_nama" required="required" value="<?php echo $p['kategori_nama']; ?>">
													</div>
													<div class="form-group">
														<label>Keterangan Kategori</label>
														<input type="text" class="form-control" name="kategori_keterangan" required="required" value="<?php echo $p['kategori_keterangan']; ?>">
													</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
											<button type="submit" class="btn btn-primary" id="simpanButton">Simpan</button>
										</div>
									</form>
									</div>
								</div>
							</div>
							<!-- Kode Modal Edit-->
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