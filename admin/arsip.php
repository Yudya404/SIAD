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
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
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
            <h3 class="panel-title">Data Arsip</h3>
        </div>
        <div class="panel-body">
			<div class="pull-right">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUpload_<?php echo $p['arsip_id']; ?>"><i class="fa fa-upload"></i> Upload Data Arsip</button>
				<!-- Kode Modal Cetak-->
				<div class="modal fade" id="modalUpload_<?php echo $p['arsip_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header text-center">
								<h4 class="modal-title" id="exampleModalLabel">Upload Arsip Data</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="modalBody_<?php echo $p['arsip_id']; ?>">
								<!-- Konten yang ingin dicetak -->
								<div class="panel-body">
									<form method="post" action="arsip_aksi.php" enctype="multipart/form-data">
										<div class="form-group">
											<label>Nama Pemohon</label>
											<input type="text" class="form-control" name="nama" required="required">
										</div>
										<div class="form-group">
											<label>Nomor Pemohon</label>
											<input type="number" class="form-control" name="nomor" required="required">
										</div>
										<div class="form-group">
											<label>Kategori</label>
											<select class="form-control" name="kategori" required="required">
												<option value="">Pilih kategori</option>
												<?php 
												$kategori = mysqli_query($koneksi,"SELECT * FROM kategori");
												while($k = mysqli_fetch_array($kategori)){
													?>
													<option value="<?php echo $k['kategori_id']; ?>"><?php echo $k['kategori_nama']; ?></option>
													<?php 
												}
												?>
											</select>
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
            <table id="table" class="table table-bordered table-striped table-hover table-datatable">
                <thead>
                    <tr>
                        <th width="1%">No</th>
                        <th>Waktu Upload</th>
                        <th>Arsip</th>
                        <!-- th>Kategori</th -->
                        <th>Petugas</th>
                        <th class="text-center" width="20%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no = 1;
                    $arsip = mysqli_query($koneksi,"SELECT * FROM arsip,kategori,petugas WHERE arsip_petugas=petugas_id ORDER BY arsip_id DESC");
                    while($p = mysqli_fetch_array($arsip)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo formatTanggalIndonesia($p['arsip_waktu_upload']) ?></td>
                            <td>
                                <b>Kode Loker</b> : <?php echo $p['arsip_kode'] ?><br>
                                <b>Nama Pemohon</b> : <?php echo $p['nama_pemohon'] ?><br>
                                <b>Nomor Pemohon</b> : <?php echo $p['pemohon_nomor'] ?><br>
                            </td>
                            <!-- td><?php echo $p['kategori_nama'] ?></td -->
                            <td><?php echo $p['petugas_nama'] ?></td>
                            <td class="text-center">
                                <div class="btn-group">
									<button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#modalPreview_<?php echo $p['arsip_id']; ?>"><i class="fa fa-search"></i></button>
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit_<?php echo $p['arsip_id']; ?>"><i class="fa fa-edit"></i></button>
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal_<?php echo $p['arsip_id']; ?>"><i class="fa fa-trash"></i></button>
                                </div>
								<!-- Kode Modal -->
                                <div class="modal fade" id="exampleModal_<?php echo $p['arsip_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">PERINGATAN!</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                Apakah anda yakin ingin menghapus data ini? <br>file dan semua yang berhubungan akan dihapus secara permanen.
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batalkan</button>
                                                <a href="arsip_hapus.php?id=<?php echo $p['arsip_id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp; Ya, hapus</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<!-- Kode Modal -->
								<!-- Kode Modal Cetak-->
								<div class="modal fade" id="modalPreview_<?php echo $p['arsip_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header text-center">
												<h4 class="modal-title" id="exampleModalLabel">Cetak Data</h4>
												<button type="button" class="close" data-dismiss="modal" aria-label="Close">
													<span aria-hidden="true">&times;</span>
												</button>
											</div>
											<div class="modal-body" id="modalBody_<?php echo $p['arsip_id']; ?>">
												<div class="panel-body">
													<div class="row">
														<div class="col-lg-12">
															<!-- Tampilkan informasi arsip -->
															<table class="table">
																<tr>
																	<th>Kode Arsip</th>
																	<td><?php echo $p['arsip_kode']; ?></td>
																</tr>
																<tr>
																	<th>Tanggal Upload</th>
																	<td><?php echo formatTanggalIndonesia($p['arsip_waktu_upload']) ?></td>
																</tr>
																<tr>
																	<th>Nama Pemohon</th>
																	<td><?php echo $p['nama_pemohon']; ?></td>
																</tr>
																<tr>
																	<th>Nomor Pemohon</th>
																	<td><?php echo $p['pemohon_nomor']; ?></td>
																</tr>
																<!-- tr>
																	<th>Jenis Kategori</th>
																	<td><?php echo $p['kategori_nama']; ?></td>
																</tr -->
															</table>
														</div>
													</div>
												</div>
											</div>
											<div class="modal-footer">
												<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
												<button type="button" class="btn btn-primary" onclick="cetakAntrian('<?php echo $p['arsip_id']; ?>')"><i class="fa fa-print"></i> Cetak</button>
											</div>
										</div>
									</div>
								</div>
								<!-- Kode Modal Cetak-->
                            </td>
							<!-- Kode Modal Edit-->
							<div class="modal fade" id="modalEdit_<?php echo $p['arsip_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header text-center">
											<h4 class="modal-title" id="exampleModalLabel">Edit Data Arsip</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body" id="modalBody_<?php echo $p['arsip_id']; ?>">
											<!-- Konten yang ingin dicetak -->
											<div class="panel-body">
												<form method="POST" action="arsip_update.php" enctype="multipart/form-data" id="arsipForm">
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
														<!-- label for="selectKota">Kategori</label> 
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
													</div -->
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