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
			</br>
			</br>

            <?php
            // Proses pencarian jika ada parameter pencarian yang dikirim
            if (isset($_GET['search'])) {
                $keyword = $_GET['search'];
                // Definisikan URL API dengan parameter pencarian
                $urlA = 'http://localhost/rest_api.php?dataA=' . urlencode($keyword);
                $urlB = 'http://localhost/rest_api.php?dataB=' . urlencode($keyword);

                // Kirim permintaan GET ke API menggunakan cURL
                $chA = curl_init($urlA);
                $chB = curl_init($urlB);

                curl_setopt($chA, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($chB, CURLOPT_RETURNTRANSFER, true);

                $responseA = curl_exec($chA);
                $responseB = curl_exec($chB);

                // Periksa respons
                if ($responseA !== false && $responseB !== false) {
                    // Tampilkan data dari respons JSON
                    $dataA = json_decode($responseA, true);
                    $dataB = json_decode($responseB, true);

                    // Tampilkan data dalam bentuk tabel atau sesuai dengan kebutuhan Anda
                    if (!empty($dataA) || !empty($dataB)) {
                        // Tampilkan data dari database A
						echo '<table id="tableCari" class="table table-bordered table-striped table-hover table-datatable_dasboard">';
                        echo '<thead>
                                <tr>
                                    <th width="1%">No</th>
                                    <th width="25%">Kode Lokasi</th>
									<th width="25%">Nama Pemohon</th>
                                    <th width="15%">Waktu Pengarsipan </th>
                                    <th width="15%">Nomor Pemohon</th>
                                </tr>
                              </thead>';
                        echo '<tbody>';
						$no = 1;
                        foreach ($dataA as $rowA) {
                            // Tampilkan data sesuai dengan kriteria pencarian
                            if (stripos($rowA['nama_pemohon'], $keyword) !== false || stripos($rowA['pemohon_nomor'], $keyword) !== false || stripos($rowA['arsip_kode'], $keyword) !== false) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td> 
											<b>Kode Berkas</b> : ' . 	$rowA['arsip_kode'] . '<br>
									 </td>';
								echo '<td>' . $rowA['nama_pemohon'] . '</td>';
                                echo '<td>' . formatTanggalIndonesia($rowA['arsip_waktu_upload']) . '</td>';
								echo '<td>' . $rowA['pemohon_nomor'] . '</td>';
                                echo '</tr>';
                            }
                        }

                        // Tampilkan data dari database B
                        foreach ($dataB as $rowB) {
                            // Tampilkan data sesuai dengan kriteria pencarian
                            if (stripos($rowB['nama_pemohon'], $keyword) !== false || stripos($rowB['pemohon_nomor'], $keyword) !== false || stripos($rowB['arsip_kode'], $keyword) !== false) {
                                echo '<tr>';
                                echo '<td>' . $no++ . '</td>';
                                echo '<td> 
											<b>Kode Berkas</b> : ' . 	$rowB['arsip_kode'] . '<br>
									 </td>';
								echo '<td>' . $rowB['nama_pemohon'] . '</td>';
                                echo '<td>' . formatTanggalIndonesia($rowB['arsip_waktu_upload']) . '</td>';
								echo '<td>' . $rowB['pemohon_nomor'] . '</td>';
                                echo '</tr>';
                            }
                        }
						echo '</tbody></table>';
                    } else {
                        // Jika data tidak ditemukan, tampilkan pesan
                        echo "<div class='alert alert-danger' role='alert'>Data tidak ditemukan.</div>";
                    }
                } else {
                    // Jika gagal mengakses API, tampilkan pesan
                    echo "<div class='alert alert-danger' role='alert'>Gagal mengakses API.</div>";
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>