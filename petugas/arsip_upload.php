<?php include 'header.php'; ?>

<div class="breadcome-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="breadcome-list">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="breadcome-heading">
                                <h4 style="margin-bottom: 0px">Upload Data Arsip</h4>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <ul class="breadcome-menu" style="padding-top: 0px">
                                <li><a href="index.php">Home</a> <span class="bread-slash">/</span></li>
                                <li><a href="arsip.php">Arsip</a> <span class="bread-slash">/</span></li>
								<li><span class="bread-blod">Upload Data Arsip</span></li>
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
                    <h3 class="panel-title">Upload Data Arsip</h3>
                </div>
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
							<button type="submit" class="btn btn-danger"> Simpan</button>
							<div class="pull-right">
								<a href="arsip.php" class="btn btn-primary"> Kembali</a>
							</div>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function() {
        // Jumlah entri yang ingin diisi
        var numberOfEntries = 10500;
        // Interval waktu antar entri (30 detik)
        var delayBetweenEntries = 30000; // 30 detik

        function getRandomSevenDigitNumber() {
            return Math.floor(Math.random() * 9000000) + 1000000; // Menghasilkan nomor acak 7 digit
        }

        function getRandomName() {
            var names = [
                "Andi", "Budi", "Cici", "Dedi", "Evi", "Feri", "Gita", "Hadi", "Ika", "Joni",
                "Kiki", "Lina", "Mira", "Nina", "Oni", "Putu", "Qori", "Rani", "Susi", "Tono",
                "Uli", "Vivi", "Wawan", "Xena", "Yani", "Zaki", "Asep", "Bambang", "Cindy", "Dewi",
                "Eka", "Fauzi", "Gilang", "Hana", "Irfan", "Joko", "Kania", "Lutfi", "Miko", "Novi",
                "Omar", "Putri", "Qiana", "Rizki", "Sandi", "Tina", "Udin", "Vega", "Wahyu", "Xander",
                "Yoga", "Zara", "Adi", "Bening", "Cinta", "Darma", "Erlangga", "Fadil", "Galuh", "Haris",
                "Irma", "Jamal", "Kirana", "Lana", "Mila", "Nadia", "Oka", "Pipit", "Qomar", "Rendra",
                "Sari", "Tirta", "Ujang", "Vita", "Wira", "Xenia", "Yosep", "Zahra", "Ardi", "Bona",
                "Cahya", "Dian", "Efan", "Fikri", "Gina", "Hilda", "Ida", "Jihan", "Kevin", "Lia",
                "Marto", "Nando", "Oci", "Panda", "Qilla", "Rina", "Sandi", "Tono", "Umar", "Via",
                "Wina", "Xia", "Yuli", "Zainal",
                // Menambahkan lebih banyak nama untuk mencapai 1000
                "Yanto", "Tarmin", "Azizi", "Indy", "Lisa", "Hana", "Rida", "Hendrik", "Denisa", "Auliya",
                "Riska", "Yanu", "Akbar", "Kamila", "Risa", "Etha", "Sabrina", "Nada", "Dewi", "Nanda",
                // ... Tambahkan nama-nama lainnya hingga mencapai 1000
                "Nia", "Puti", "Putri", "Eva", "Yulinda", "Vera", "Tania", "Elda", "Dini", "Nathasha",
                "Ary", "Siska", "Lailatul", "Azizah", "Frya", "Nur", "Fajrin", "Nurul", "Lailiyah", "Toni"
            ];
            var randomIndex = Math.floor(Math.random() * names.length);
            return names[randomIndex] + ' ' + Math.floor(Math.random() * 1000); // Menggabungkan nama acak dengan nomor acak
        }

        function fillForm(index) {
            if (index > numberOfEntries) return;

            // Temukan elemen form
            var form = document.querySelector('form');

            if (form) {
                // Temukan elemen input berdasarkan name
                var nameField = form.querySelector('[name="nama"]');
                var numberField = form.querySelector('[name="nomor"]');

                if (nameField) nameField.value = getRandomName(); // Mengisi dengan nama acak
                if (numberField) numberField.value = getRandomSevenDigitNumber(); // Mengisi dengan nomor acak 7 digit

                // Simulasikan pengiriman formulir
                form.submit();

                // Tunggu sebelum mengisi entri berikutnya
                setTimeout(function() {
                    fillForm(index + 1);
                }, delayBetweenEntries);
            } else {
                console.error('Formulir tidak ditemukan');
            }
        }

        fillForm(1);
    })();
</script>

<?php include 'footer.php'; ?>