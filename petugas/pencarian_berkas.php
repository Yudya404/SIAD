<?php include 'header.php'; ?>

<div class="breadcome-area">
    <!-- Kode breadcome di sini -->
</div>
</br>
</br>
</br>

<div class="container-fluid">
    <div class="panel panel">
        <div class="panel-heading">
            <h3 class="panel-title">Pencarian Berkas</h3>
        </div>
        <div class="panel-body">
            <!-- Formulir pencarian -->
            <form method="GET" action="">
                <!-- Ubah action dari form untuk menyertakan pencarian -->
                <div class="form-group">
                    <input type="text" class="form-control" name="search" placeholder="Masukkan nama pemohon/nomor pemohon.." value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                </div>
                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Cari</button>
            </form>

            <?php
            // Proses pencarian jika ada parameter pencarian yang dikirim
            if (isset($_GET['search'])) {
                $keyword = $_GET['search'];
                // Definisikan URL API dengan parameter pencarian
                $url = 'http://localhost/rest_api.php?dataB=' . urlencode($keyword);

                // Kirim permintaan GET ke API
                $response = file_get_contents($url);

                // Periksa respons
                if ($response !== false) {
                    // Tampilkan data dari respons JSON
                    $data = json_decode($response, true);
                    // Tampilkan data dalam bentuk tabel atau sesuai dengan kebutuhan Anda
                    if (!empty($data)) {
                        echo '<table id="tableCari" class="table table-bordered table-striped table-hover table-datatable_dasboard">';
                        echo '<thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th width="40%">Data Berkas</th>
                                    <th>Waktu Pengarsipan</th>
                                    <th class="text-center" width="10%">OPSI</th>
                                </tr>
                              </thead>';
                        echo '<tbody>';
                        $no = 1;
                        foreach ($data as $row) {
                            // Filter data sesuai dengan kriteria pencarian
                            if (stripos($row['nama_pemohon'], $keyword) !== false || stripos($row['pemohon_nomor'], $keyword) !== false || stripos($row['arsip_kode'], $keyword) !== false) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td> 
											<b>Kode Berkas</b> : ' . 	$row['arsip_kode'] . '<br>
											<b>Nama Pemohon</b> :' .	$row['nama_pemohon'] . '<br>
											<b>Nomor Pemohon</b> :' .	$row['pemohon_nomor'] . '<br>
									 </td>';
                                echo '<td>' . formatTanggalIndonesia($row['arsip_waktu_upload']) . '</td>';
								echo '<td class="text-center">
										<div class="btn-group">
											<a href="arsip_edit.php?id=' . $row['arsip_id'] . '" class="btn btn-primary"><i class="fa fa-eye"></i></a>
										</div>
									  </td>';
                                echo '</tr>';
                            }
                        }
                        echo '</tbody></table>';
                    } else {
                        // Jika data tidak ditemukan, tampilkan SweetAlert
                        echo "<script> 
                                Swal.fire({
                                    title: 'Data Tidak Ditemukan',
                                    text: 'Maaf, data yang Anda cari tidak ditemukan.',
                                    icon: 'error',
                                    confirmButtonText: 'OK'
                                });
                              </script>";
                    }
                } else {
                    echo "Gagal mengakses API";
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
