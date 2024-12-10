<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px"><i class="fa fa-home"></i> Dashboard</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                                <li><span class="bread-blod">Dashboard</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="traffice-source-area mg-b-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box analytics-info-cs">
                    <h3 class="box-title"><i class="fa fa-user"></i> Petugas Gudang</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash"></div>
                        </li>
                        <li class="text-right sp-cn-r">
                            <i class="fa fa-level-up" aria-hidden="true"></i> 
                            <span class="counter text-success">
                                <?php 
                                $jumlah_petugas = mysqli_query($koneksi,"select * from petugas");
                                ?>
                                <span class="counter"><?php echo mysqli_num_rows($jumlah_petugas); ?></span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box analytics-info-cs res-mg-t-30 table-mg-t-pro-n">
                    <h3 class="box-title"><i class="fa fa-user"></i> Petugas FO</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash2"></div>
                        </li>
                        <li class="text-right graph-two-ctn">
                            <i class="fa fa-level-up" aria-hidden="true"></i> 
                            <span class="counter text-purple">
                                <?php 
                                $jumlah_user = mysqli_query($koneksi,"select * from user");
                                ?>
                                <span class="counter"><?php echo mysqli_num_rows($jumlah_user); ?></span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box analytics-info-cs res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                    <h3 class="box-title"><i class="fa fa-book"></i> Total Arsip</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash3"></div>
                        </li>
                        <li class="text-right graph-three-ctn">
                            <i class="fa fa-level-up" aria-hidden="true"></i> 
                            <span class="counter text-info">
                                <?php 
                                $jumlah_arsip = mysqli_query($koneksi,"select * from arsip");
                                ?>
                                <span class="counter"><?php echo mysqli_num_rows($jumlah_arsip); ?></span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box analytics-info-cs res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                    <h3 class="box-title"><i class="fa fa-folder-open"></i> Kategori Arsip</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash4"></div>
                        </li>
                        <li class="text-right graph-four-ctn">
                            <i class="fa fa-level-down" aria-hidden="true"></i> 
                            <span class="text-danger">
                                <?php 
                                $jumlah_kategori = mysqli_query($koneksi,"select * from kategori");
                                ?>
                                <span class="counter"><?php echo mysqli_num_rows($jumlah_kategori); ?></span>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="product-sales-area mg-tb-30">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                <div class="product-sales-chart">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="caption pro-sl-hd">
                                    <span class="caption-subject"><b>Data Petugas Gudang</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
						<table id="table" class="table table-bordered table-striped table-hover table-datatable">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th width="5%">Foto</th>
									<th>Nama</th>
									<th>NIP</th>
									<th class="text-center" width="10%">OPSI</th>
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
										<td><?php echo $p['petugas_nama'] ?></td>
										<td><?php echo $p['petugas_nip'] ?></td>
										<td class="text-center">
											<div class="text-center">
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit_<?php echo $p['petugas_id']; ?>"><i class="fa fa-edit"></i></button>
											</div>
										</td>
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
															<form method="POST" action="petugas_aksi.php" enctype="multipart/form-data">
																<div class="form-group">
																	<label>NIP</label>														
																	<input type="hidden" name="id" value="<?php echo $p['petugas_id']; ?>">
																	<input type="hidden" class="form-control" name="nip" required="required" value="<?php echo $p['petugas_nip']; ?>">	
																	<input type="number" class="form-control" name="nip" required="required" value="<?php echo $p['petugas_nip']; ?>" disabled>
																</div>
																<div class="form-group">
																	<label>Nama</label>
																	<input type="text" class="form-control" name="nama" required="required" value="<?php echo $p['petugas_nama']; ?>">
																</div>
																<div class="form-group">
																	<label>Email</label>
																	<input type="email" class="form-control" name="email" required="required" value="<?php echo $p['petugas_email']; ?>">
																</div>
																<div class="form-group">
																	<label>No, Telp</label>
																	<input type="number" class="form-control" name="notelp" required="required" value="<?php echo $p['petugas_notelp']; ?>">
																</div>
																<div class="form-group">
																	<label>Alamat</label>
																	<textarea class="form-control" name="alamat" required="required"><?php echo $p['petugas_alamat']; ?>"</textarea>
																</div>
																<div class="form-group">
																	<label>Password</label>
																	<input type="password" class="form-control" placeholder="**********" name="password" required="required">
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
			
            <div class="col-lg-6 col-md-3 col-sm-3 col-xs-12">
				<div class="product-sales-chart">
					<div class="portlet-title">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
								<div class="caption pro-sl-hd">
									<span class="caption-subject"><b>Data Petugas Front Office</b></span>
								</div>
							</div>
						</div>
					</div>
					<div class="panel-body">
						<table id="table" class="table table-bordered table-striped table-hover table-datatable">
							<thead>
								<tr>
									<th width="1%">No</th>
									<th width="5%">Foto</th>
									<th>Nama</th>
									<th>NIP</th>
									<th class="text-center" width="10%">OPSI</th>
								</tr>
							</thead>
							<tbody>
								<?php 
								include '../koneksi.php';
								$no = 1;
								$user = mysqli_query($koneksi,"SELECT * FROM user ORDER BY user_id DESC");
								while($p = mysqli_fetch_array($user)){
									?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td>
											<?php 
												if($p['user_foto'] == ""){
											?>
												<img class="img-user" src="../gambar/sistem/user.png">
												<?php
											}else{
												?>
												<img class="img-user" src="../gambar/user/<?php echo $p['user_foto']; ?>">
											<?php
											}
											?>
										</td>
										<td><?php echo $p['user_nama'] ?></td>
										<td><?php echo $p['user_nip'] ?></td>
										<td class="text-center">
											<div class="text-center">
												<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit_<?php echo $p['user_id']; ?>"><i class="fa fa-edit"></i></button>
											</div>
										</td>
										<!-- Kode Modal Cetak-->
										<div class="modal fade" id="modalEdit_<?php echo $p['user_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered" role="document">
												<div class="modal-content">
													<div class="modal-header text-center">
														<h4 class="modal-title" id="exampleModalLabel">Edit Data Petugas</h4>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body" id="modalBody_<?php echo $p['user_id']; ?>">
														<!-- Konten yang ingin dicetak -->
														<div class="panel-body">
															<form method="POST" action="petugas_aksi.php" enctype="multipart/form-data">
																<div class="form-group">
																	<label>NIP</label>														
																	<input type="hidden" name="id" value="<?php echo $p['user_id']; ?>">
																	<input type="hidden" class="form-control" name="nip" required="required" value="<?php echo $p['user_nip']; ?>">
																	<input type="number" class="form-control" name="nip" required="required" value="<?php echo $p['user_nip']; ?>" disabled>
																</div>
																<div class="form-group">
																	<label>Nama</label>
																	<input type="text" class="form-control" name="nama" required="required" value="<?php echo $p['user_nama']; ?>">
																</div>
																<div class="form-group">
																	<label>Email</label>
																	<input type="email" class="form-control" name="email" required="required" value="<?php echo $p['user_email']; ?>">
																</div>
																<div class="form-group">
																	<label>No, Telp</label>
																	<input type="number" class="form-control" name="notelp" required="required" value="<?php echo $p['user_notelp']; ?>">
																</div>
																<div class="form-group">
																	<label>Alamat</label>
																	<textarea class="form-control" name="alamat" required="required"><?php echo $p['user_alamat']; ?>"</textarea>
																</div>
																<div class="form-group">
																	<label>Password</label>
																	<input type="password" class="form-control" placeholder="**********" name="password" required="required">
																</div>
																<div class="form-group">
																	<label>Foto</label>
																	<br>
																	<img class="img-user" alt="Foto KU" src="../gambar/petugas/<?php echo $p['user_foto']; ?>">
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
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>