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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <div class="white-box analytics-info-cs res-mg-t-30 res-tablet-mg-t-30 dk-res-t-pro-30">
                    <h3 class="box-title"><i class="fa fa-book"></i> Total Data Arsip</h3>
                    <ul class="list-inline two-part-sp">
                        <li>
                            <div id="sparklinedash3"></div>
                        </li>
                        <li class="text-right graph-three-ctn">
                            <i class="fa fa-level-up" aria-hidden="true"></i> 
                            <span class="counter text-info">
                                <?php
                                // Fungsi untuk menghitung jumlah data dalam tabel
                                function countDataInTable($koneksi, $tableName) {
                                    $query = "SELECT COUNT(*) AS total FROM $tableName";
                                    $result = mysqli_query($koneksi, $query);
                                    if ($result) {
                                        $row = mysqli_fetch_assoc($result);
                                        return $row['total'];
                                    } else {
                                        return 0;
                                    }
                                }

                                // Query untuk mengambil semua tabel yang namanya dimulai dengan 'lemari_'
                                $query_tables = "SHOW TABLES LIKE 'lemari_%'";
                                $result_tables = mysqli_query($koneksi, $query_tables);

                                if (!$result_tables) {
                                    die("Query gagal: " . mysqli_error($koneksi));
                                }

                                $total_semua = 0;
                                $table_data = [];

                                // Hitung total data dari setiap tabel yang ditemukan
                                while ($row_table = mysqli_fetch_row($result_tables)) {
                                    $tableName = $row_table[0];
                                    $total = countDataInTable($koneksi, $tableName);
                                    $table_data[$tableName] = $total;
                                    $total_semua += $total;
                                }

                                // Tambahkan juga tabel arsip
                                $total_arsip = countDataInTable($koneksi, 'arsip');
                                $table_data['arsip'] = $total_arsip;
                                $total_semua += $total_arsip;

                                // Tampilkan total jumlah data dari semua tabel
                                echo $total_semua;
                                ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
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
                                $jumlah_kategori = mysqli_query($koneksi, "SELECT * FROM kategori");
                                if (!$jumlah_kategori) {
                                    die("Query gagal: " . mysqli_error($koneksi));
                                }
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

<?php include 'footer.php'; ?>