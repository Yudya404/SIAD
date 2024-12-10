<div class="footer-copyright-area mg-t-30">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="footer-copy-right">
					<p>Copyright © <?php echo date('Y') ?>. Sistem Informasi Arsip Digital. All rights reserved.</p>
				</div>
			</div>
		</div>
	</div>
</div>
</div>

<script>
    // Tangkap semua tombol penghapusan dengan kelas .delete-button
    var deleteButtons = document.querySelectorAll('.delete-button');

    // Loop melalui setiap tombol dan tambahkan event listener
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Ambil ID dari tombol yang diklik
            var arsipId = button.getAttribute('data-id');

            // Tampilkan SweetAlert untuk konfirmasi penghapusan
            swal({
                title: "Apakah Anda yakin?",
                text: "Data akan dihapus permanen!",
                icon: "warning",
                buttons: {
                    ya: {
                        text: "Ya",
                        value: true,
                        className: "swal-yes-button"
                    },
                    tidak: {
                        text: "Tidak",
                        value: false,
                        className: "swal-no-button"
                    }
                },
                dangerMode: true,
                closeOnClickOutside: false, // Tetapkan true jika Anda ingin membatasi tombol "Tidak"
            })
            .then((willDelete) => {
                // Jika pengguna mengklik tombol Ya
                if (willDelete) {
                    // Panggil fungsi untuk menghapus data
                    hapusData(arsipId);
                } else {
                    // Jika pengguna mengklik tombol Tidak atau menutup SweetAlert
                    swal("Data tidak dihapus!", {
                        icon: "info",
                    });
                }
            });

            // Fungsi untuk menghapus data
            function hapusData(id) {
                // Lakukan panggilan AJAX untuk menghapus data
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "arsip_hapus.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Respon dari server (responseText) dapat digunakan untuk menampilkan pesan atau tindakan lain
                        swal("Data telah dihapus!", {
                            icon: "success",
						}).then(() => {
							// Memuat ulang halaman setelah penghapusan data
							window.location.reload();
                        });
                    }
                };
                xhr.send("id=" + id); // Kirim data yang ingin dihapus ke server (id arsip dalam contoh ini)
            }
        });
    });
</script>
<script>
    function cetakAntrian(modalId) {
    const modalBody = document.getElementById('modalBody_' + modalId).innerHTML;

    const printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
        <head>
            <title>Cetak Arsip</title>
            <style>
                /* Tambahkan gaya CSS Anda di sini */
                body {
                    font-family: Arial, sans-serif;
                }
                /* Contoh gaya CSS untuk tabel */
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 8px;
                    text-align: left;
                }
            </style>
        </head>
        <body>
            ${modalBody}
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}
</script>
<script>
$(document).ready( function () {
    $('#tableDasboard').DataTable({
		"language": {
                "zeroRecords": "Data yang Anda Cari Tidak tersedia pada Sistem"
                // Anda dapat menambahkan konfigurasi bahasa lainnya di sini
            },
        "pageLength": 5, // Menampilkan 5 data per halaman
        "order": [[0, "asc"]], // Mengurutkan berdasarkan kolom pertama (No) secara ascending
    });
});
</script>
<script>
	$(document).ready(function() {
        $('#tableCari').DataTable({
            "language": {
                "zeroRecords": "Data yang Anda Cari Tidak tersedia pada Sistem"
                // Anda dapat menambahkan konfigurasi bahasa lainnya di sini
            },
            "paging": true, // Menampilkan pagination
            "lengthChange": false, // Menonaktifkan kotak length halaman
            "searching": false, // Menonaktifkan kotak pencarian
            "pageLength": 5, // Menampilkan 5 data per halaman
            "order": [[0, "asc"]] // Mengurutkan berdasarkan kolom pertama (No) secara ascending
        });
    });
</script>
<script>
    // Menonaktifkan tombol Simpan saat form dikirim
    document.getElementById("arsipForm").addEventListener("submit", function() {
        document.getElementById("simpanButton").disabled = true;
    });
</script>
<script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/wow.min.js"></script>
<script src="../assets/js/jquery-price-slider.js"></script>
<script src="../assets/js/jquery.meanmenu.js"></script>
<script src="../assets/js/owl.carousel.min.js"></script>
<script src="../assets/js/jquery.sticky.js"></script>
<script src="../assets/js/jquery.scrollUp.min.js"></script>
<script src="../assets/js/counterup/jquery.counterup.min.js"></script>
<script src="../assets/js/counterup/waypoints.min.js"></script>
<script src="../assets/js/counterup/counterup-active.js"></script>
<script src="../assets/js/scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="../assets/js/scrollbar/mCustomScrollbar-active.js"></script>
<script src="../assets/js/metisMenu/metisMenu.min.js"></script>
<script src="../assets/js/metisMenu/metisMenu-active.js"></script>
<script src="../assets/js/morrisjs/raphael-min.js"></script>
<script src="../assets/js/morrisjs/morris.js"></script>
<script src="../assets/js/morrisjs/morris-active.js"></script>
<script src="../assets/js/sparkline/jquery.sparkline.min.js"></script>
<script src="../assets/js/sparkline/jquery.charts-sparkline.js"></script>
<script src="../assets/js/sparkline/sparkline-active.js"></script>
<script src="../assets/js/calendar/moment.min.js"></script>
<script src="../assets/js/calendar/fullcalendar.min.js"></script>
<script src="../assets/js/calendar/fullcalendar-active.js"></script>
<script src="../assets/js/cetak.js"></script>
<script src="../assets/js/plugins.js"></script>
<script src="../assets/js/main.js"></script>
<script src="../assets/js/DataTables/datatables.js"></script>
<script src="../assets/js/pdf/jquery.media.js"></script>
<script src="../assets/js/pdf/pdf-active.js"></script>
<script src="../assets/js/vendor/modernizr-2.8.3.min.js"></script>
<script type="text/javascript">
	$(document).ready( function () {
		$('.table-datatable').DataTable();
		Morris.Area({
			element: 'extra-area-chart',
			data: [
			<?php 
			$dateBegin = strtotime("first day of this month");  
			$dateEnd = strtotime("last day of this month");
			$awal = date("Y/m/d", $dateBegin);         
			$akhir = date("Y/m/d", $dateEnd);
			$arsip = mysqli_query($koneksi,"SELECT * FROM riwayat WHERE date(riwayat_waktu) >= '$awal' AND date(riwayat_waktu) <= '$akhir'");
			while($p = mysqli_fetch_array($arsip)){
				$tgl = date('Y/m/d',strtotime($p['riwayat_waktu']));
				$jumlah = mysqli_query($koneksi,"select * from riwayat where date(riwayat_waktu)='$tgl'");
				$j = mysqli_num_rows($jumlah);
				?>
				{
					period: '<?php echo date('Y-m-d',strtotime($p['riwayat_waktu'])) ?>',
					Unduh: <?php echo $j ?>,
				},
				<?php 
			}
			?>

			],
			xkey: 'period',
			ykeys: ['Unduh'],
			labels: ['Unduh'],
			xLabels: 'day',
			xLabelAngle: 45,
			pointSize: 3,
			fillOpacity: 0,
			pointStrokeColors:['#006DF0'],
			behaveLikeLine: true,
			gridLineColor: '#e0e0e0',
			lineWidth: 1,
			hideHover: 'auto',
			lineColors: ['#006DF0'],
			resize: true

		});
	});
</script>

</body>
</html>