<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px"><i class="fa fa-user"></i> Data Petugas</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Petugas</span></li>
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
            <h3 class="panel-title">Data Petugas Gudang</h3>
        </div>
        <div class="panel-body">
            <div class="pull-right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah_<?php echo $p['petugas_id']; ?>"><i class="fa fa-plus"></i> Tambah Data Petugas</button>
				<!-- Kode Modal Cetak-->
				<div class="modal fade" id="modalTambah_<?php echo $p['petugas_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header text-center">
								<h4 class="modal-title" id="exampleModalLabel">Tambah Data Petugas</h4>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body" id="modalBody_<?php echo $p['petugas_id']; ?>">
								<!-- Konten yang ingin dicetak -->
								<div class="panel-body">
									<form method="post" action="petugas_aksi.php" enctype="multipart/form-data">
										<div class="form-group">
											<label>NIP</label>
											<input type="number" class="form-control" name="nip" required="required">
										</div>
										<div class="form-group">
											<label>Nama</label>
											<input type="text" class="form-control" name="nama" required="required">
										</div>
										<div class="form-group">
											<label>Email</label>
											<input type="text" class="form-control" name="email" required="required">
										</div>
										<div class="form-group">
											<label>No, Telp</label>
											<input type="number" class="form-control" name="notelp" required="required">
										</div>
										<div class="form-group">
											<label>Alamat</label>
											<textarea class="form-control" name="alamat" required="required"></textarea>
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" class="form-control" name="password" required="required" minlength="8" maxlength="12">
										</div>
										<div class="form-group">
											<label>Konfirmasi Password</label>
											<input type="password" class="form-control" name="confirmpassword" required="required" minlength="8" maxlength="12">
										</div>
										<div class="form-group">
											<label>Foto</label>
											<input type="file" name="foto">
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
                        <th width="5%">Foto</th>
                        <th>NIP</th>						
                        <th>Nama</th>
						<th>Email</th>						
                        <th>No, Telp</th>
						<th>Alamat</th>
                        <th class="text-center" width="15%">OPSI</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    include '../koneksi.php';
                    $no = 1;
                    $petugas = mysqli_query($koneksi,"SELECT * FROM petugas ORDER BY petugas_id DESC");
                    while($p = mysqli_fetch_array($petugas)){
                        ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td>
                                <?php 
									if($p['petugas_foto'] == ""){
                                ?>
                                    <img class="img-user" src="../gambar/sistem/user.png">
                                    <?php
                                }else{
                                    ?>
                                    <img class="img-user" src="../gambar/petugas/<?php echo $p['petugas_foto']; ?>">
                                <?php
                                }
                                ?>
                            </td>
                            <td><?php echo $p['petugas_nip'] ?></td>
							<td><?php echo $p['petugas_nama'] ?></td>
							<td><?php echo $p['petugas_email'] ?></td>
							<td><?php echo $p['petugas_notelp'] ?></td>
							<td><?php echo $p['petugas_alamat'] ?></td>
                            <td class="text-center">
                                <div class="btn-group">
									<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalAkun_<?php echo $p['petugas_id']; ?>"><i class="fa fa-user"></i></button>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit_<?php echo $p['petugas_id']; ?>"><i class="fa fa-edit"></i></button>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalDelete_<?php echo $p['petugas_id']; ?>"><i class="fa fa-trash"></i></button>
                                </div>
								<!-- Kode Modal Delete-->
								<div class="modal fade" id="modalDelete_<?php echo $p['petugas_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
												<a href="petugas_hapus.php?id=<?php echo $p['petugas_id']; ?>" class="btn btn-primary"><i class="fa fa-check"></i> &nbsp; Ya, hapus</a>
											</div>
										</div>
									</div>
								</div>
								<!-- Kode Modal Delete-->
                            </td>
							<!-- Kode Modal Cetak-->
							<div class="modal fade" id="modalAkun_<?php echo $p['petugas_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header text-center">
											<h4 class="modal-title" id="exampleModalLabel">Update Akun</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body" id="modalBody_<?php echo $p['petugas_id']; ?>">
											<!-- Konten yang ingin dicetak -->
											<div class="panel-body">
												<form action="petugas_akun.php" method="POST" enctype="multipart/form-data">
													<div class="form-group">
														<label>NIP</label>
														<input type="hidden" name="id" value="<?php echo $p['petugas_id']; ?>">
														<input type="number" class="form-control" name="nip" required="required" value="<?php echo $p['petugas_nip'] ?>">
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
														<input type="password" class="form-control" placeholder="Masukkan Password Lama .." name="password" required="required">
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
							<!-- Kode Modal Cetak-->
							<!-- Kode Modal Cetak-->
							<div class="modal fade" id="modalEdit_<?php echo $p['petugas_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog modal-dialog-centered" role="document">
									<div class="modal-content">
										<div class="modal-header text-center">
											<h4 class="modal-title" id="exampleModalLabel">Edit Data Petugas</h4>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body" id="modalBody_<?php echo $p['petugas_id']; ?>">
											<!-- Konten yang ingin dicetak -->
											<div class="panel-body">
												<form method="POST" action="petugas_update.php" enctype="multipart/form-data">
													<div class="form-group">
														<label>NIP</label>														
														<input type="hidden" name="id" value="<?php echo $p['petugas_id']; ?>">
														<input type="hidden" class="form-control" name="nip" value="<?php echo $p['petugas_nip']; ?>">
														<input type="number" class="form-control" name="nip" value="<?php echo $p['petugas_nip']; ?>" disabled>
													</div>
													<div class="form-group">
														<label>Nama</label>
														<input type="text" class="form-control" name="nama" value="<?php echo $p['petugas_nama']; ?>">
													</div>
													<div class="form-group">
														<label>Email</label>
														<input type="text" class="form-control" name="email" value="<?php echo $p['petugas_email']; ?>">
													</div>
													<div class="form-group">
														<label>No, Telp</label>
														<input type="number" class="form-control" name="notelp" value="<?php echo $p['petugas_notelp']; ?>">
													</div>
													<div class="form-group">
														<label>Alamat</label>
														<textarea class="form-control" name="alamat"><?php echo $p['petugas_alamat']; ?>"</textarea>
													</div>
													<div class="form-group">
														<label>Foto</label>
														<br>
														<img class="img-user" alt="Foto KU" src="../gambar/petugas/<?php echo $p['petugas_foto']; ?>">
														<br>
														<input type="file" name="foto">
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